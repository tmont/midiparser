<?php

	/**
	 * \Midi\Parsing\EventParser
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */

	namespace Midi\Parsing;
	
	use Midi\Event;
	use Midi\Event\EventType;
	use Midi\Event\EventFactory;
	use Midi\Util\Util;
	use Midi\MidiException;

	/**
	 * Class for parsing MIDI events
	 *
	 * @package    Midi
	 * @subpackage Parsing
	 * @since      1.0
	 */
	class EventParser extends Parser {
		
		/**
		 * The current continuation event type
		 *
		 * @var int|null
		 */
		protected $continuationEvent;
		
		/**
		 * @var EventFactory
		 */
		private $eventFactory;
		
		/**
		 * @since 1.0
		 *
		 * @param EventFactory $eventFactory
		 */
		public function __construct(EventFactory $eventFactory = null) {
			parent::__construct();
			
			$this->continuationEvent = null;
			$this->eventFactory = $eventFactory ?: new EventFactory();
		}
		
		/**
		 * @since 1.0
		 * @uses  read()
		 * @uses  Util::unpack()
		 * @uses  parseChannelEvent()
		 * @uses  parseMetaEvent()
		 * @uses  parseSystemExclusiveEvent()
		 * 
		 * @throws {@link ParseException}
		 * @return Event
		 */
		public function parse() {
			$byte = $this->read(1, true);
			
			$eventType = Util::unpack($byte);
			$eventType = $eventType[0];
			$isContinuation = false;
			
			if ($eventType < 0x80) {
				if ($this->continuationEvent === null) {
					throw new ParseException('Invalid event: first byte must be greater than or equal to 0x80');
				} else {
					$eventType = $this->continuationEvent;
					$isContinuation = true;
					//rewind one byte so that parseChannelEvent() doesn't throw an exception
					//when it can't find two more bytes
					$this->file->fseek(-1, SEEK_CUR);
				}
			} else {
				$this->continuationEvent = $eventType;
			}
			
			if ($eventType < 0xF0) {
				return $this->parseChannelEvent($eventType, $isContinuation);
			} else if ($eventType === 0xFF) {
				return $this->parseMetaEvent();
			} else if ($eventType === 0xF0) {
				return $this->parseSystemExclusiveEvent();
			}
			
			throw new ParseException('Unsupported event type: 0x' . strtoupper(dechex($eventType)));
		}
		
		/**
		 * Parses the buffer stream for a channel event
		 *
		 * @since 1.0
		 * @uses  Util::unpack()
		 * @uses  getChannelEvent()
		 * @uses  ChannelEvent::setContinuation()
		 * @uses  EventFactory::createChannelEvent()
		 * 
		 * @param  int  $eventType      See {@link EventType}
		 * @param  bool $isContinuation Whether the event is a continuation of a previous event
		 * @return ChannelEvent
		 */
		protected function parseChannelEvent($eventType, $isContinuation) {
			$type = $eventType & 0xF0;
			if ($type === 0xC0 || $type === 0xD0) {
				$data = Util::unpack($this->read(1, true));
				$data[1] = null;
			} else {
				$data = Util::unpack($this->read(2, true));
			}
			
			$event = $this->eventFactory->createChannelEvent($eventType & 0xF0, $eventType & 0x0F, $data[0], $data[1]);
			if ($isContinuation) {
				$event->setContinuation(true);
			}
			
			return $event;
		}
		
		/**
		 * Parses the buffer stream for a meta event
		 *
		 * @since 1.0
		 * @uses  read()
		 * @uses  Util::unpack()
		 * @uses  getDelta()
		 * @uses  EventFactory::createMetaEvent()
		 * 
		 * @return MetaEvent
		 */
		protected function parseMetaEvent() {
			$metaEventType = Util::unpack($this->read(1, true));
			$metaEventType = $metaEventType[0];
			$length        = $this->getDelta();
			$data          = $this->read($length, true);
			
			return $this->eventFactory->createMetaEvent($metaEventType, $data);
		}
		
		/**
		 * Parses the buffer stream for a system exclusive event
		 *
		 * @since 1.0
		 * @uses  getDelta()
		 * @uses  read()
		 * @uses  EventFactory::createSystemExclusiveEvent()
		 * 
		 * @return SystemExclusiveEvent
		 */
		protected function parseSystemExclusiveEvent() {
			$length = $this->getDelta();
			$data   = $this->read($length, true);
			return $this->eventFactory->createSystemExclusiveEvent(str_split($data));
		}
		
	}

?>