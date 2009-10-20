<?php
	
	namespace Midi\Tests\Util;

	class TimerTest extends \PHPUnit_Framework_TestCase {
		
		private $obj;
		
		public function setUp() {
			$this->obj = new \Midi\Util\Timer(240);
		}
		
		public function tearDown() {
			$this->obj = null;
		}
		
		public function testSixtyFourthNote() {
			$this->assertEquals(15, $this->obj->sixtyFourthNote());
		}
		
		public function testThirtySecondNote() {
			$this->assertEquals(30, $this->obj->thirtySecondNote());
		}
		
		public function testSixteenthNote() {
			$this->assertEquals(60, $this->obj->sixteenthNote());
		}
		
		public function testEighthNote() {
			$this->assertEquals(120, $this->obj->eighthNote());
		}
		
		public function testQuarterNote() {
			$this->assertEquals(240, $this->obj->quarterNote());
		}
		
		public function testHalfNote() {
			$this->assertEquals(480, $this->obj->halfNote());
		}
		
		public function testWholeNote() {
			$this->assertEquals(960, $this->obj->wholeNote());
		}
		
		public function testDot() {
			$this->assertEquals(150, $this->obj->dot(100));
		}
		
		public function testStocatto() {
			$this->assertEquals(74, $this->obj->stoccato(99));
		}
		
		public function testUnstocatto() {
			$this->assertEquals(25, $this->obj->unstoccato(99));
		}
		
		public function testTriplet() {
			$this->assertEquals(33, $this->obj->triplet(100));
			$this->assertEquals(33, $this->obj->triplet(100));
			$this->assertEquals(34, $this->obj->triplet(100));
		}
		
		public function testGetTimeDivision() {
			$this->assertEquals(240, $this->obj->getTimeDivision());
		}
		
		public function testConstructorThrowsInvalidArgumentException() {
			$this->setExpectedException('InvalidArgumentException');
			new \Midi\Util\Timer('foo');
		}
		
		public function testConstructorThrowsDomainException() {
			$this->setExpectedException('DomainException');
			new \Midi\Util\Timer(0);
		}
		
		public function testResolveTripletThrowsRuntimeException() {
			$this->setExpectedException('RuntimeException');
			$this->obj->resolveTriplet(100);
		}
		
	}

?>