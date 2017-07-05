<?php

/*
  |--------------------------------------------------------------------------
  | Utils APP
  |--------------------------------------------------------------------------
  |
  | all functions for entire project
  |
 */

if (!defined('API')):
    die('Nothing to do here ._.');
endif;

/**
 * Print preformatted
 * @param mixed $var -> Variable to print
 * @param boolean $exit -> Exit when print
 */
function __P($var, $exit = true) {
    echo '<pre>';
    print_r($var);

    if ($exit) {
        die('</pre>');
    }

    echo '</pre>';
}