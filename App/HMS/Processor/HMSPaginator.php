<?php

namespace HMS\Processor;

use AshleyDawson\SimplePagination\Paginator;

use HMS\Processor\Input;

/**
 * Class HMSPaginator
 * @package HMS\Processor
 */
class HMSPaginator
{
	public $items;
	public $noOfItems;
	public $pagesInRange;
	public $paginator;
	public $pagination;

	/**
	 * HMSPaginator constructor.
	 * @param array $items
	 * @param int $noOfItems
	 * @param int $pagesInRange
	 */
	public function __construct(array $items, int $noOfItems = 10, int $pagesInRange = 5)
	{
		$this->items = $items;
		$this->noOfItems = $noOfItems;
		$this->pagesInRange = $pagesInRange;
		$this->paginator = new Paginator();
		if (Input::catch ('page') === ''): $_GET['page'] = 1;endif;

	}


	/**
	 * @return mixed
	 */
	public function getPagination()
	{

		$items = $this->items;
		$this->paginator
			->setItemsPerPage($this->noOfItems)
			->setPagesInRange($this->pagesInRange) // How many pages to display in navigation (e.g. if we have a lot of pages to get through)
		;
		// Pass our item total callback
		$this->paginator->setItemTotalCallback(function () use ($items) {
			return count($items);
		});

		$this->paginator->setSliceCallback(function ($offset, $length) use ($items) {
			return array_slice($items, $offset, $length);
		});

		return $this->paginator->paginate((int)$_GET['page']);

	}
}