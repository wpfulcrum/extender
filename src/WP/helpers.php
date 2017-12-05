<?php

use Fulcrum\Extender\WP\Conditionals;
use Fulcrum\Extender\WP\Database;
use Fulcrum\Extender\WP\ParentChild;

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

if (!function_exists('get_post_id')) {
    /**
     * Get the Post ID
     *
     * If in the back-end, it will use $_REQUEST;
     * else it uses either the incoming post ID or $post->ID
     *
     * @since 3.0.0
     *
     * @param int $postId (optional)
     *
     * @return int Returns the post ID, if one is found; else 0.
     */
    function get_post_id($postId = 0)
    {
        if (is_admin()) {
            return get_post_id_when_in_backend($postId);
        }

        return $postId < 1 ? get_the_ID() : $postId;
    }
}

if (!function_exists('get_post_id_when_in_backend')) {
    /**
     * Get the Post ID
     *
     * If in the back-end, it will use $_REQUEST;
     * else it uses either the incoming post ID or $post->ID
     *
     * @since 3.0.0
     *
     * @param int $postId (optional)
     *
     * @return int Returns the post ID, if one is found; else 0.
     */
    function get_post_id_when_in_backend($postId = 0)
    {
        if (!is_admin()) {
            return $postId;
        }

        $possibleRequestKeys = [
            'post_ID',
            'post_id',
            'post',
        ];

        foreach ($possibleRequestKeys as $key) {
            if (!isset($_REQUEST[$key])) {
                continue;
            }

            if (is_numeric($_REQUEST[$key])) {
                return (int) $_REQUEST[$key];
            }
        }

        return $postId;
    }
}

if (!function_exists('fulcrum_declare_plugin_constants')) {
    /**
     * Get the plugin's URL, obtained from the plugin's root file.
     *
     * @since 3.1.3
     *
     * @param string $prefix Constant prefix
     * @param string $rootPath Plugin's root file
     *
     * @returns string Returns the plugin URL
     */
    function fulcrum_declare_plugin_constants($prefix, $rootPath)
    {
        if (!defined($prefix . '_PLUGIN_DIR')) {
            define($prefix . '_PLUGIN_DIR', plugin_dir_path($rootPath));
        }

        if (!defined($prefix . '_PLUGIN_URL')) {
            define($prefix . '_PLUGIN_URL', fulcrum_get_plugin_url($rootPath));
        }
    }
}

if (!function_exists('fulcrum_get_plugin_url')) {
    /**
     * Get the plugin's URL, obtained from the plugin's root file.
     *
     * @since 3.1.3
     *
     * @param string $rootPath Plugin's root file
     *
     * @returns string Returns the plugin URL
     */
    function fulcrum_get_plugin_url($rootPath)
    {
        $pluginUrl = plugin_dir_url($rootPath);
        if (!is_ssl()) {
            return $pluginUrl;
        }
        return str_replace('http://', 'https://', $pluginUrl);
    }
}
