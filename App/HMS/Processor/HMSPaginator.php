<?php

namespace HMS\Processor;

use AshleyDawson\SimplePagination\Paginator as Pagination;
use JasonGrimes\Paginator as PageUrl;


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
	public $urlPattern;
	public $pageUrl;

	/**
	 * HMSPaginator constructor.
	 * @param array $items
	 * @param int $noOfItems
	 * @param int $pagesInRange
	 * @param string $urlPattern
	 */
	public function __construct(array $items, string $urlPattern, int $noOfItems = 10, int $pagesInRange = 5)
	{
		/**
		 * For Paginator
		 */
		$this->items = $items;
		$this->noOfItems = $noOfItems;
		$this->pagesInRange = $pagesInRange;
		$this->paginator = new Pagination();
		if (Input::catch ('page') === ''): $_GET['page'] = 1;endif;

		/**
		 * For PageUrl
		 */
		$this->urlPattern = "?$urlPattern&page=(:num)";
		$this->pageUrl = new PageUrl(count($items), $noOfItems, $_GET['page'], $this->urlPattern);



	}


	/**
	 * Create Pagination
	 *
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

	/**
	 * @return string
	 */
	public function getPageUrl()
	{
		return "<div class=\"row pagination_block\">{$this->pageUrl}</div>";
	}
}