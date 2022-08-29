<?php

namespace Laz0r\PriorityQueue;

use Laz0r\Util\AbstractConstructOnce;

class PriorityQueue extends AbstractConstructOnce implements PriorityQueueInterface {

	private BasePriorityQueue $PriorityQueue;

	public function __construct(?BasePriorityQueue $PriorityQueue = null) {
		parent::__construct();

		$PriorityQueue ??= new BasePriorityQueue();

		$this->PriorityQueue = $PriorityQueue;
	}

	public function getIterator() {
		return new class(
			$this->getPriorityQueue()->getQueue()
		) extends AbstractPriorityQueueIterator {};
	}

	public function insert($data, int $priority = 1): PriorityQueueInterface {
		$this->getPriorityQueue()->insert($data, 0 - $priority);

		return $this;
	}

	public function remove($datum): bool {
		return $this->getPriorityQueue()->remove($datum);
	}

	public function contains($datum): bool {
		return $this->getPriorityQueue()->contains($datum);
	}

	public function hasPriority(int $priority): bool {
		return $this->getPriorityQueue()->hasPriority(0 - intval($priority));
	}

	protected function getPriorityQueue(): BasePriorityQueue {
		return $this->PriorityQueue;
	}

}

/* vi:set ts=4 sw=4 noet: */
