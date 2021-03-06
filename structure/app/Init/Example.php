<?php
/**
 * @package     Parable
 * @license     MIT
 * @author      Robin de Graaf <hello@devvoh.com>
 * @copyright   2015-2016, Robin de Graaf, devvoh webdevelopment
 */

namespace Init;

class Example
{
    public function __construct()
    {
        /*
         * Init scripts function very simply: They need to be in Init namespace, their filename should match their
         * classname, and the location of these scripts needs to be set in a Config file, using the root key
         * 'initLocations'. See app/Config/App.php.
         *
         * They need to have a __construct() method, which will be called automatically BEFORE routing/dispatching is
         * done. Init scripts are the perfect place to hook into events before anything else is done. This allows,
         * for example, the following:
         *
         * $hook->into('parable_dispatch_before', function() use ($response, $view) {
         *    $response->prependContent($view->partial('app/View/Layout/header.phtml'));
         * });
         *
         * You can do anything at all here. It can be very handy for events you want to be able to capture from the
         * absolute beginning (such as 'parable_dispatch_before' mentioned above), but you can also define new events
         * that you trigger later on. It's all up to you :)
         *
         * Init scripts are DI'd, so you can use the same constructor-based DI as in other classes.
         *
         * If you don't want or plan to use Init scripts, you can safely remove this directory. It won't complain if
         * there's no init scripts available. You can also remove the key from the Config.
         */
    }
}
