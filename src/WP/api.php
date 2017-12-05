<?php
/**
 * WordPress Support API - a collection of functions to help
 * you get your work done faster with less code (and frustrations).
 *
 * @package     Fulcrum\Extender\WP
 * @since       3.1.0
 * @author      hellofromTonya
 * @link        https://github.com/wpfulcrum/extender
 * @license     GPL-2.0+
 */

use Fulcrum\Extender\WP\Conditionals;
use Fulcrum\Extender\WP\Database;

if (!function_exists('do_harder_rewrite_rules_flush')) {
    /**
     * Do a hard flush of the WordPress rewrite rules by first deleting
     * the `rewrite_rules` option from the database.  Then invoke the
     * `flush_rewrite_rules()` function to allow the normal processing.
     *
     * This method makes sure that the `rewrite_rules` are wiped before
     * processing the rewrite rules flush.
     *
     * @since 3.1.0
     *
     * @return void
     */
    function do_harder_rewrite_rules_flush()
    {
        Database::doHarderRewriteRulesFlush();
    }
}

if (!function_exists('do_hard_get_option')) {
    /**
     * Gets the option value from the `wp_options` database.  This is a hard
     * get, as it queries the database directly to avoid any caching.
     *
     * @since 3.1.0
     *
     * @param string $optionName Name of the option to go get out of the `wp_options` db
     * @param int $defaultValue Default value to return if the option does not
     *                          exist.  The default value is 0.
     *
     * @return int|null|string
     */
    function do_hard_get_option($optionName, $defaultValue = 0)
    {
        return Database::doHardGetOption($optionName, $defaultValue);
    }
}

if (!function_exists('get_current_web_page_id')) {
    /**
     * Get the current web page's ID.
     *
     * @since 3.1.0
     *
     * @return int
     */
    function get_current_web_page_id()
    {
        return (int) get_queried_object_id();
    }
}

if (!function_exists('is_posts_page')) {
    /**
     * Checks if the current web page request is for the Posts Page, i.e
     * the page that displays the posts.  This page is sometimes called
     * the "blog" page.
     *
     * @since 3.1.0
     *
     * @return bool
     */
    function is_posts_page()
    {
        return Conditionals::isPostsPage();
    }
}

if (!function_exists('is_root_web_page')) {
    /**
     * Checks if the current web page request is for the Posts Page, i.e
     * the page that displays the posts.  This page is sometimes called
     * the "blog" page.
     *
     * @since 3.1.0
     *
     * @return bool
     */
    function is_root_web_page()
    {
        return Conditionals::isRootPage();
    }
}

if (!function_exists('is_static_front_page')) {
    /**
     * Checks if the current web page request is for the Posts Page, i.e
     * the page that displays the posts.  This page is sometimes called
     * the "blog" page.
     *
     * @since 3.1.0
     *
     * @return bool
     */
    function is_static_front_page()
    {
        return Conditionals::isStaticFrontPage();
    }
}

if (!function_exists('get_url_relative_to_home_url')) {
    /**
     * Get the URL relative to the site's root (home url).
     *
     * Performance function.
     *
     * This function uses `get_home_url()` and caches it.  It allows us to speed up
     * building links and menus as we don't have to call `home_url( 'some-path' );`
     * over and over again.
     *
     * @since 3.1.0
     *
     * @param  string $path Optional. Path relative to the home URL. Default empty.
     * @param  string|null $scheme Optional. Scheme to give the home URL context. Accepts
     *                              'http', 'https', 'relative', 'rest', or null. Default null.
     *
     * @return string Home URL link with optional path appended.
     */
    function get_url_relative_to_home_url($path = '', $scheme = null)
    {
        static $homeUrl;

        if (!$homeUrl) {
            $homeUrl = get_home_url(null, '', $scheme);
        }

        if (!$homeUrl) {
            return '';
        }

        return sprintf('%s/%s', $homeUrl, ltrim($path, '/'));
    }
}
