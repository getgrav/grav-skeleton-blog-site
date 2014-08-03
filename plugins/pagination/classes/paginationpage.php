<?php
namespace Grav\Plugin;

use \Grav\Common\Registry;

class PaginationPage
{
    /**
     * @var int
     */
    public $number;

    /**
     * @var string
     */
    public $url;

    /**
     * Constructor
     *
     * @param int $number
     * @param string $url
     */
    public function __construct($number, $url)
    {
        $this->number = $number;
        $this->url = $url;
    }

    /**
     * Returns true if the page is the current one.
     *
     * @return bool
     */
    public function isCurrent()
    {
        if (Registry::get('Uri')->currentPage() == $this->number) {
            return true;
        } else {
            return false;
        }
    }
}
