<?php
namespace Grav\Plugin;

use \Grav\Common\Data;
use \Grav\Common\Plugin;
use \Grav\Common\Registry;
use \Grav\Common\Uri;
use \Grav\Common\Page\Pages;

class SitemapPlugin extends Plugin
{
    /**
     * @var bool
     */
    protected $active = false;

    /**
     * @var array
     */
    protected $sitemap = array();

    /**
     * Enable sitemap only if url matches to the configuration.
     */
    public function onAfterInitPlugins()
    {
        /** @var Uri $uri */
        $uri = Registry::get('Uri');
        $route = $this->config->get('plugins.sitemap.route');

        if ($route && $route == $uri->path()) {
            $this->active = true;

            // Turn off debugger if its on
            $this->config->set('system.debugger.enabled', false);
        }
    }

    /**
     * Generate data for the sitemap.
     */
    public function onAfterGetPages()
    {
        if (!$this->active) {
            return;
        }

        require_once __DIR__ . '/classes/sitemapentry.php';

        /** @var Pages $pages */
        $pages = Registry::get('Pages');
        $routes = $pages->routes();
        ksort($routes);

        foreach ($routes as $route => $path) {
            $page = $pages->get($path);

            if ($page->routable()) {

                $entry = new SitemapEntry();
                $entry->location = $page->permaLink();
                $entry->lastmod = date('Y-m-d', $page->modified());

                // optional changefreq & priority that you can set in the page header
                $header = $page->header();
                if (isset($header->sitemap['changefreq'])) {
                    $entry->changefreq = $header->sitemap['changefreq'];
                }
                if (isset($header->sitemap['priority'])) {
                    $entry->priority = $header->sitemap['priority'];
                }

                $this->sitemap[$route] = $entry;
            }
        }
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
     * Set needed variables to display the sitemap.
     */
    public function onAfterSiteTwigVars()
    {
        if (!$this->active) {
            return;
        }

        $twig = Registry::get('Twig');
        $twig->template = 'sitemap.xml.twig';
        $twig->twig_vars['sitemap'] = $this->sitemap;
    }

    /**
     * Extend page blueprints with feed configuration options.
     *
     * @param Data\Blueprint $blueprint
     */
    public function onCreateBlueprint(Data\Blueprint $blueprint)
    {
        static $inEvent = false;

        if (!$inEvent && $blueprint->get('form.fields.tabs')) {
            $inEvent = true;
            $blueprints = new Data\Blueprints(__DIR__ . '/blueprints/');
            $extends = $blueprints->get('sitemap');
            $blueprint->extend($extends, true);
            $inEvent = false;
        }
    }
}
