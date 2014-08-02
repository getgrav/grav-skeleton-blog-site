<?php
namespace Grav\Plugin;

use Grav\Common\Data;
use Grav\Common\Page\Collection;
use Grav\Common\Plugin;
use Grav\Common\Registry;
use Grav\Common\Uri;
use Grav\Common\Page\Page;

class FeedPlugin extends Plugin
{
    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $feed_config;

    /**
     * @var array
     */
    protected $valid_types = array('rss','atom');

    /**
     * Activate feed plugin only if feed was requested for the current page.
     *
     * Also disables debugger.
     */
    public function onAfterInitPlugins()
    {
        /** @var Uri $uri */
        $uri = Registry::get('Uri');
        $this->type = $uri->extension();

        if ($this->type && in_array($this->type, $this->valid_types)) {
            $this->config->set('system.debugger.enabled', false);
            $this->active = true;
        }
    }

    /**
     * Initialize feed configuration.
     */
    public function onAfterGetPage()
    {
        if (!$this->active) {
            return;
        }

        $defaults = (array) $this->config->get('plugins.feed');

        /** @var Page $page */
        $page = Registry::get('Grav')->page;
        if (isset($page->header()->feed)) {
            $this->feed_config = array_merge($defaults, $page->header()->feed);
        } else {
            $this->feed_config = $defaults;
        }
    }

    /**
     * Feed consists of all sub-pages.
     *
     * @param Collection $collection
     */
    public function onAfterCollectionProcessed(Collection $collection)
    {
        if (!$this->active) {
            return;
        }

        $collection->setParams(array_merge($collection->params(), $this->feed_config));;
    }

    /**
     * Add current directory to twig lookup paths.
     */
    public function onAfterTwigTemplatesPaths()
    {
        if (!$this->active) {
            return;
        }

        Registry::get('Twig')->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Set needed variables to display the feed.
     */
    public function onAfterSiteTwigVars()
    {
        if ($this->active) {
            $twig = Registry::get('Twig');
            $twig->template = 'feed.'.$this->type.'.twig';
        }
    }

    /**
     * Extend page blueprints with feed configuration options.
     *
     * @param Data\Blueprint $blueprint
     */
    public function onCreateBlueprint(Data\Blueprint $blueprint)
    {
        static $inEvent = false;

        if (!$inEvent && $blueprint->name == 'blog_list') {
            $inEvent = true;
            $blueprints = new Data\Blueprints(__DIR__ . '/blueprints/');
            $extends = $blueprints->get('feed');
            $blueprint->extend($extends, true);
            $inEvent = false;
        }
    }
}
