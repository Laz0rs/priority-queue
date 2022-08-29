<?php

namespace Laz0r\PriorityQueue;

use Laminas\Stdlib\PriorityQueue;

class BasePriorityQueue extends PriorityQueue {

	public function __construct() {
		// prevent changing internal queue class and avoid a Psalm error
		$this->queue = $this->getQueue();
	}

	public function getQueue() {
		return parent::getQueue();
	}

}

/* vi:set ts=4 sw=4 noet: */
