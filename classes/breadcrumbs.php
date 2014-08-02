<?php
namespace Grav\Plugin;

use \Grav\Common\Registry;
use \Grav\Common\Grav;

class Breadcrumbs
{
    /**
     * @var array
     */
    protected $breadcrumbs;

    /**
     * Get all items in breadcrumbs.
     *
     * @return array
     */
    public function get()
    {
        if (!$this->breadcrumbs) {
            $this->build();
        }
        return $this->breadcrumbs;
    }

    /**
     * Build breadcrumbs.
     *
     * @internal
     */
    protected function build()
    {
        /** @var Grav $grav */
        $grav = Registry::get('Grav');
        $hierarchy = array();

        $current = $grav->page;

        while ($current && !$current->root()) {
            $hierarchy[$current->url()] = $current;
            $current = $current->parent();
        }

        // Page cannot be routed.
        if (!$current) {
            $this->breadcrumbs = array();
            return;
        }

        $home = $grav->pages->dispatch('/');
        if ($home && !array_key_exists($home->url(), $hierarchy)) {
            $hierarchy[] = $home;
        }

        $this->breadcrumbs = array_reverse($hierarchy);
    }
}
