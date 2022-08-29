<?php

namespace Laz0r\PriorityQueue;

use Laminas\Stdlib\SplPriorityQueue;
use Laz0r\Util\AbstractIteratorIterator;
use Iterator;

/**
 * @template-implements \Iterator<int, mixed>
 */
abstract class AbstractPriorityQueueIterator extends AbstractIteratorIterator implements Iterator {

	public function __construct(SplPriorityQueue $Queue) {
		$Queue = clone $Queue;

		$Queue->setExtractFlags(SplPriorityQueue::EXTR_BOTH);

		parent::__construct($Queue);
	}

	public function current() {
		/** @var array $item */
		$item = parent::current();

		assert(array_key_exists("data", $item));

		return $item["data"];
	}

	public function key() {
		/** @var array $item */
		$item = parent::current();

		assert(array_key_exists("priority", $item));

		/** @var array $priority */
		$priority = $item["priority"];

		assert(array_key_exists(0, $priority));

		$priority = (int)$priority[0];

		return 0 - $priority;
	}

}

/* vi:set ts=4 sw=4 noet: */
