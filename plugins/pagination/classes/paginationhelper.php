<?php
namespace Grav\Plugin;

use Grav\Common\Iterator;
use Grav\Common\Page\Collection;
use Grav\Common\Registry;

class PaginationHelper extends Iterator
{
    protected $current;
    protected $items_per_page;
    protected $page_count;

    /**
     * Create and initialize pagination.
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        require_once __DIR__ . '/paginationpage.php';

        $params = $collection->params();

        $uri = Registry::get('Uri');
        $this->current = $uri->currentPage();

        $this->items_per_page = $params['limit'];
        $this->page_count = ceil($collection->count() / $this->items_per_page);

        for ($x=1; $x <= $this->page_count; $x++) {
            $this->items[$x] = new PaginationPage($x, '/page:'.$x);
        }
    }

    /**
     * Returns true if current item has previous sibling.
     *
     * @return bool
     */
    public function hasPrev()
    {
        if (array_key_exists($this->current -1, $this->items)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns true if current item has next sibling.
     *
     * @return bool
     */
    public function hasNext()
    {
        if (array_key_exists($this->current +1, $this->items)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return previous url.
     *
     * @return string|null
     */
    public function prevUrl()
    {
        if (array_key_exists($this->current -1, $this->items)) {
            return $this->items[$this->current -1]->url;
        }

        return null;
    }

    /**
     * Return next url.
     *
     * @return string|null
     */
    public function nextUrl()
    {
        if (array_key_exists($this->current +1, $this->items)) {
            return $this->items[$this->current +1]->url;
        }

        return null;
    }
}
