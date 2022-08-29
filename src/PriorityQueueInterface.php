<?php

namespace Laz0r\PriorityQueue;

use IteratorAggregate;

/**
 * @extends \IteratorAggregate<int, mixed>
 */
interface PriorityQueueInterface extends IteratorAggregate {

	/**
	 * Insert an item into the queue.
	 *
	 * Priority defaults to 1 (low priority) if none provided.
	 *
	 * @param mixed $data
	 * @param int   $priority
	 *
	 * @return self
	 */
	public function insert($data, int $priority = 1): self;

	/**
	 * Remove an item from the queue.
	 *
	 * @param mixed $datum
	 *
	 * @return bool False if the item was not found, true otherwise.
	 */
	public function remove($datum): bool;

	/**
	 * Does the queue contain the given datum?
	 *
	 * @param mixed $datum
	 *
	 * @return bool
	 */
	public function contains($datum): bool;

	/**
	 * Does the queue have an item with the given priority?
	 *
	 * @param int $priority
	 *
	 * @return bool
	 */
	public function hasPriority(int $priority): bool;

}

/* vi:set ts=4 sw=4 noet: */
