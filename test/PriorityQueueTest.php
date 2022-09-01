<?php

namespace Laz0r\PriorityQueueTest;

use Laminas\Stdlib\SplPriorityQueue;
use Laz0r\PriorityQueue\{
	AbstractPriorityQueueIterator,
	BasePriorityQueue,
	PriorityQueue,
};
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\PriorityQueue\PriorityQueue
 */
class PriorityQueueTest extends TestCase {

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$Stub = (new ReflectionClass(BasePriorityQueue::class))
			->newInstanceWithoutConstructor();
		$RC = new ReflectionClass(PriorityQueue::class);
		$Sut = $RC->newInstanceWithoutConstructor();
		$Property = $RC->getProperty("PriorityQueue");

		$Sut->__construct($Stub);
		$Property->setAccessible(true);

		$this->assertSame($Stub, $Property->getValue($Sut));
	}

	/**
	 * @covers ::getIterator
	 * @uses \Laz0r\PriorityQueue\AbstractPriorityQueueIterator::__construct
	 *
	 * @return void
	 */
	public function testGetIterator(): void {
		$Stub = $this->createStub(SplPriorityQueue::class);
		$Mock = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Sut = $this->getMockBuilder(PriorityQueue::class)
			->disableOriginalConstructor()
			->onlyMethods(["getPriorityQueue"])
			->getMock();

		$Mock->expects($this->once())
			->method("getQueue")
			->will($this->returnValue($Stub));
		$Sut->expects($this->once())
			->method("getPriorityQueue")
			->will($this->returnValue($Mock));

		$Result = $Sut->getIterator();

		$this->assertInstanceOf(AbstractPriorityQueueIterator::class, $Result);
	}

	/**
	 * @covers ::insert
	 *
	 * @return void
	 */
	public function testInsertInvertsPrio(): void {
		$Stub = (object)[];
		$Mock = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Sut = $this->getMockBuilder(PriorityQueue::class)
			->disableOriginalConstructor()
			->onlyMethods(["getPriorityQueue"])
			->getMock();

		$Mock->expects($this->once())
			->method("insert")
			->with(
				$this->identicalTo($Stub),
				$this->identicalTo(-42),
			);
		$Sut->expects($this->once())
			->method("getPriorityQueue")
			->will($this->returnValue($Mock));

		$Sut->insert($Stub, 42);
	}

	/**
	 * @covers ::insert
	 *
	 * @return void
	 */
	public function testInsertReturnsThis(): void {
		$Mock = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Sut = $this->getMockBuilder(PriorityQueue::class)
			->disableOriginalConstructor()
			->onlyMethods(["getPriorityQueue"])
			->getMock();

		$Sut->expects($this->any())
			->method("getPriorityQueue")
			->will($this->returnValue($Mock));

		$Result = $Sut->insert(null);

		$this->assertSame($Sut, $Result);
	}

	/**
	 * @covers ::remove
	 *
	 * @return void
	 */
	public function testRemove(): void {
		$Stub = (object)[];
		$Mock = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Sut = $this->getMockBuilder(PriorityQueue::class)
			->disableOriginalConstructor()
			->onlyMethods(["getPriorityQueue"])
			->getMock();

		$Mock->expects($this->once())
			->method("remove")
			->with($this->identicalTo($Stub))
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getPriorityQueue")
			->will($this->returnValue($Mock));

		$result = $Sut->remove($Stub);

		$this->assertTrue($result);
	}

	/**
	 * @covers ::contains
	 *
	 * @return void
	 */
	public function testContains(): void {
		$Stub = (object)[];
		$Mock = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Sut = $this->getMockBuilder(PriorityQueue::class)
			->disableOriginalConstructor()
			->onlyMethods(["getPriorityQueue"])
			->getMock();

		$Mock->expects($this->once())
			->method("contains")
			->with($this->identicalTo($Stub))
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getPriorityQueue")
			->will($this->returnValue($Mock));

		$result = $Sut->contains($Stub);

		$this->assertTrue($result);
	}

	/**
	 * @covers ::hasPriority
	 *
	 * @return void
	 */
	public function testHasPriority(): void {
		$Mock = $this->getMockBuilder(BasePriorityQueue::class)
			->disableOriginalConstructor()
			->getMock();
		$Sut = $this->getMockBuilder(PriorityQueue::class)
			->disableOriginalConstructor()
			->onlyMethods(["getPriorityQueue"])
			->getMock();

		$Mock->expects($this->once())
			->method("hasPriority")
			->with($this->identicalTo(-42))
			->will($this->returnValue(true));
		$Sut->expects($this->once())
			->method("getPriorityQueue")
			->will($this->returnValue($Mock));

		$result = $Sut->hasPriority(42);

		$this->assertTrue($result);
	}

	/**
	 * @covers ::getPriorityQueue
	 *
	 * @return void
	 */
	public function testGetPriorityQueue(): void {
		$Stub = (new ReflectionClass(BasePriorityQueue::class))
			->newInstanceWithoutConstructor();
		$RC = new ReflectionClass(PriorityQueue::class);
		$Sut = $RC->newInstanceWithoutConstructor();
		$Property = $RC->getProperty("PriorityQueue");
		$Method = $RC->getMethod("getPriorityQueue");

		$Property->setAccessible(true);
		$Property->setValue($Sut, $Stub);
		$Method->setAccessible(true);

		$Result = $Method->invokeArgs($Sut, []);

		$this->assertSame($Stub, $Result);
	}

}

/* vi:set ts=4 sw=4 noet: */
