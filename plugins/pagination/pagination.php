<?php
namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Registry;

class PaginationPlugin extends Plugin
{
    /**
     * @var PaginationHelper
     */
    protected $pagination;

    /**
     * @var bool
     */
    protected $active = false;

    /**
     * Add current directory to twig lookup paths.
     */
    public function onAfterTwigTemplatesPaths()
    {
        Registry::get('Twig')->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Enable pagination if page has params.pagination = true.
     */
    public function onAfterGetPage()
    {
        /** @var Grav $grav */
        $grav = Registry::get('Grav');

        if ($grav->page) {
            $this->active = $grav->page->value('header.pagination');
        }
    }

    /**
     * Create pagination object for the page.
     *
     * @param Collection $collection
     */
    public function onAfterCollectionProcessed(Collection $collection)
    {
        $params = $collection->params();

        // Only add pagination if it has been enabled for the collection.
        if (!$this->active || empty($params['pagination'])) {
            return;
        }

        if (!empty($params['limit']) && $collection->count() > $params['limit']) {
            require_once __DIR__ . '/classes/paginationhelper.php';
            $this->pagination = new PaginationHelper($collection);
            $collection->setParams(['pagination' => $this->pagination]);
        }
    }

    /**
     * Set needed variables to display pagination.
     */
    public function onAfterSiteTwigVars()
    {
        if (!$this->active) {
            return;
        }

        $twig = Registry::get('Twig');

        if ($this->config->get('plugins.pagination.built_in_css')) {
            $twig->twig_vars['stylesheets'][] = 'user/plugins/pagination/pagination.css';
        }
    }
}
