<?php

/*
 * This file is part of Raven.
 *
 * (c) Sentry Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Autoloads Raven classes.
 *
 * @package raven
 */
class PrintFriendly_Raven_Autoloader
{
    /**
     * Registers PrintFriendly_Raven_Autoloader as an SPL autoloader.
     */
    public static function register()
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array('PrintFriendly_Raven_Autoloader', 'autoload'));
    }

    /**
     * Handles autoloading of classes.
     *
     * @param string $class A class name.
     */
    public static function autoload($class)
    {
        if (substr($class, 0, 20) !== 'PrintFriendly_Raven_') {
            return;
        }

        $file = dirname(__FILE__).'/../../'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';
        if (is_file($file)) {
            /** @noinspection PhpIncludeInspection */
            require $file;
        }
    }
}
