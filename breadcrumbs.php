<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Registry;

class BreadcrumbsPlugin extends Plugin
{
    /**
     * Add current directory to twig lookup paths.
     */
    public function onAfterTwigTemplatesPaths()
    {
        Registry::get('Twig')->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Set needed variables to display breadcrumbs.
     */
    public function onAfterSiteTwigVars()
    {
        require_once __DIR__ . '/classes/breadcrumbs.php';

        $twig = Registry::get('Twig');
        $twig->twig_vars['breadcrumbs'] = new Breadcrumbs();

        if ($this->config->get('plugins.breadcrumbs.built_in_css')) {
            $twig->twig_vars['stylesheets'][] = 'user/plugins/breadcrumbs/breadcrumbs.css';
        }
    }
}
