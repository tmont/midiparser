<?php

	class RecordIterator implements Iterator {
		
		private $result;
		private $current;
		private $index;
		
		public function __construct($result) {
			$this->result = $result;
			$this->current = mysql_fetch_assoc($result);
			$this->index = 0;
		}
		
		public function current() {
			return $this->current;
		}
		
		public function next() {
			$this->current = mysql_fetch_assoc($this->result);
			$this->index++;
			return $this->current;
		}
		
		public function rewind() {
			
		}
		
		public function valid() {
			return $this->current !== false;
		}
		
		public function key() {
			return $this->index;
		}
		
	}

?>