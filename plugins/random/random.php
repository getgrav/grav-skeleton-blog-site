<?php
namespace Grav\Plugin;

use Grav\Common\Page\Collection;
use \Grav\Common\Plugin;
use \Grav\Common\Registry;
use \Grav\Common\Uri;
use \Grav\Common\Taxonomy;

class RandomPlugin extends Plugin
{
    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @var Uri
     */
    protected $uri;

    /**
     * @var array
     */
    protected $filters = array();

    /**
     * Activate plugin if path matches to the configured one.
     */
    public function onAfterInitPlugins()
    {
        $this->uri = Registry::get('Uri');
        $route = $this->config->get('plugins.random.route');

        if ($route && $route == $this->uri->path()) {
            $this->active = true;
        }
    }

    /**
     * Display random page.
     */
    public function onAfterGetPage()
    {
        if ($this->active) {
            /** @var Taxonomy $taxonomy_map */
            $taxonomy_map = Registry::get('Taxonomy');

            $filters = (array) $this->config->get('plugins.random.filters');

            if (count($filters) > 0) {
                $collection = new Collection();
                foreach ($filters as $taxonomy => $items) {
                    if (isset($items)) {
                        $collection->append($taxonomy_map->findTaxonomy([$taxonomy => $items])->toArray());
                    }
                }

                $grav = Registry::get('Grav');
                $grav->page = $collection->random()->current();
            }
        }
    }
}
