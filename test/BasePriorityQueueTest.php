<?php

namespace Laz0r\PriorityQueueTest;

use Laminas\Stdlib\{SplPriorityQueue, PriorityQueue};
use Laz0r\PriorityQueue\BasePriorityQueue;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\PriorityQueue\BasePriorityQueue
 */
class BasePriorityQueueTest extends TestCase {

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$Stub = $this->createStub(SplPriorityQueue::class);
		$Sut = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Property = (new ReflectionClass(PriorityQueue::class))
			->getProperty("queue");

		$Sut->expects($this->once())
			->method("getQueue")
			->will($this->returnValue($Stub));

		$Property->setAccessible(true);
		$Sut->__construct();

		$this->assertSame($Stub, $Property->getValue($Sut));
	}

	/**
	 * @covers ::getQueue
	 *
	 * @return void
	 */
	public function testGetQueue(): void {
		$Stub = $this->createStub(SplPriorityQueue::class);
		$Sut = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->setMethodsExcept(["getQueue"])
			->getMock();
		$Property = (new ReflectionClass(PriorityQueue::class))
			->getProperty("queue");

		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);

		$Result = $Sut->getQueue();

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
