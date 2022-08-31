<?php

namespace Laz0r\PriorityQueue;

use Laminas\Stdlib\{PriorityQueue, SplPriorityQueue};

class BasePriorityQueue extends PriorityQueue {

	public function __construct() {
		/** @psalm-var \SplPriorityQueue<int, mixed> $Queue */
		$Queue = $this->getQueue();

		$this->queue = $Queue;
	}

	/**
	 * @return \Laminas\Stdlib\SplPriorityQueue
	 */
	public function getQueue() {
		$Ret = parent::getQueue();

		assert($Ret instanceof SplPriorityQueue);

		return $Ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
