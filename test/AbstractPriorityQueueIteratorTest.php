<?php

namespace Laz0r\PriorityQueueTest;

use Laminas\Stdlib\SplPriorityQueue;
use Laz0r\PriorityQueue\AbstractPriorityQueueIterator;
use Laz0r\Util\AbstractIteratorIterator;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \Laz0r\PriorityQueue\AbstractPriorityQueueIterator
 */
class AbstractPriorityQueueIteratorTest extends TestCase {

	/**
	 * @covers ::__construct
	 *
	 * @return void
	 */
	public function testConstructor(): void {
		$Param = (object)[
			"cloned" => false,
			"extract_flags" => null,
		];

		$Mock = new class($Param) extends SplPriorityQueue {

			private object $Param;

			/**
			 * @return void
			 */
			public function __clone() {
				$this->Param->cloned = true;
			}

			/**
			 * @param object $Obj
			 */
			public function __construct(object $Obj) {
				$this->Param = $Obj;
			}

			public function setExtractFlags($flags): int {
				$this->Param->extract_flags = $flags;

				return $flags;
			}

		};

		$Sut = $this->getMockBuilder(AbstractPriorityQueueIterator::class)
			->disableOriginalConstructor()
			->getMock();

		$Sut->__construct($Mock);
		$this->assertTrue($Param->cloned);
		$this->assertSame(3, $Param->extract_flags);
	}

	/**
	 * @covers ::current
	 *
	 * @return void
	 */
	public function testCurrent(): void {
		$Stub = (object)[];
		$Sut = $this->getMockBuilder(AbstractPriorityQueueIterator::class)
			->disableOriginalConstructor()
			->setMethodsExcept(["current"])
			->getMock();
		$Property = (new ReflectionClass(AbstractIteratorIterator::class))
			->getProperty("current");

		$Property->setAccessible(true);
		$Property->setValue($Sut, ["data" => $Stub]);

		$Result = $Sut->current();

		$this->assertSame($Stub, $Result);
	}

	/**
	 * @covers ::key
	 *
	 * @return void
	 */
	public function testKey(): void {
		$Sut = $this->getMockBuilder(AbstractPriorityQueueIterator::class)
			->disableOriginalConstructor()
			->setMethodsExcept(["current", "key"])
			->getMock();
		$Property = (new ReflectionClass(AbstractIteratorIterator::class))
			->getProperty("current");

		$Property->setAccessible(true);
		$Property->setValue($Sut, ["priority" => [-42]]);

		$result = $Sut->key();

		$this->assertSame(42, $result);
	}

}

/* vi:set ts=4 sw=4 noet: */
