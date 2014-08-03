<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Registry;
use \Grav\Plugin\Taxonomylist;

class TaxonomylistPlugin extends Plugin
{
    /**
     * Add current directory to twig lookup paths.
     */
    public function onAfterTwigTemplatesPaths()
    {
        Registry::get('Twig')->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Set needed variables to display the taxonomy list.
     */
    public function onAfterSiteTwigVars()
    {
        require_once __DIR__ . '/classes/taxonomylist.php';

        $twig = Registry::get('Twig');
        $twig->twig_vars['taxonomylist'] = new Taxonomylist();
        $twig->twig_vars['list_url'] = $this->config->get(
            'site.blog.route',
            $this->config->get('plugins.taxonomylist.route')
        );
    }
}
