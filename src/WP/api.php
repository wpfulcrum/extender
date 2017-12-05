<?php
/**
 * WordPress Support API - a collection of functions to help
 * you get your work done faster with less code (and frustrations).
 *
 * @package     Fulcrum\Extender\WP
 * @since       3.1.0
 * @author      hellofromTonya
 * @link        https://github.com/wpfulcrum/extender
 * @license    MIT
 */

use Fulcrum\Extender\WP\Conditionals;
use Fulcrum\Extender\WP\Database;
use Fulcrum\Extender\WP\ParentChild;

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

/****************************
 * Parent-Child Functions
 ***************************/

if (!function_exists('is_child_post')) {
    /**
     * Checks if the given post is a child.
     *
     * @since 3.1.3
     *
     * @param int|WP_Post|null $postOrPostId Post Instance or Post ID to check
     *
     * @return boolean
     */
    function is_child_post($postOrPostId = null)
    {
        return ParentChild::isChildPost($postOrPostId);
    }
}

if (!function_exists('is_parent_post')) {
    /**
     * Checks if the given post is a parent.
     *
     * @since 3.1.3
     *
     * @param int|WP_Post|null $postOrPostId Post Instance or Post ID to check
     *
     * @return boolean
     */
    function is_parent_post($postOrPostId = null)
    {
        return ParentChild::isParentPost($postOrPostId);
    }
}

if (!function_exists('post_has_children')) {
    /**
     * Checks if the given post has children
     *
     * @since 3.1.3
     *
     * @param int|WP_Post|null $postOrPostId Post Instance or Post ID to check
     *
     * @return boolean
     */
    function post_has_children($postOrPostId = null)
    {
        return ParentChild::postHasChildren($postOrPostId);
    }
}

if (!function_exists('get_number_of_children_for_post')) {
    /**
     * Fetches the number of children for a given post or post ID.
     * If no post/post ID is passed in, then it uses the current post.
     *
     * @since 3.1.3
     *
     * @param int|WP_Post|null $postOrPostId Post Instance or Post ID to check
     *
     * @return int|false
     */
    function get_number_of_children_for_post($postOrPostId = null)
    {
        return ParentChild::getNumberOfPostChildren($postOrPostId);
    }
}

if (!function_exists('get_next_parent_post')) {
    /**
     * Get the next adjacent parent post.
     *
     * This function extends the SQL WHERE query of the WordPress get_adjacent_post()
     * function. It registers a callback to the `get_next_post_where` event filter,
     * which then adds a new WHERE parameter.
     *
     * @uses get_next_post()
     * @uses `get_next_post_where` filter
     * @uses fulcrum_add_parent_post_to_adjacent_sql()
     *
     * @since 3.1.3
     *
     * @param bool $inSameTerm Optional. Whether post should be in a same taxonomy term. Default false.
     * @param array|string $excludedTerms Optional. Array or comma-separated list of excluded term IDs. Default empty.
     * @param string $taxonomy Optional. Taxonomy, if $inSameTerm is true. Default 'category'.
     *
     * @return null|string|WP_Post Post object if successful. Null if global $post is not set. Empty string if no
     *                             corresponding post exists.
     */
    function get_next_parent_post($inSameTerm = false, $excludedTerms = '', $taxonomy = 'category')
    {
        return ParentChild::getNextParentPost($inSameTerm, $excludedTerms, $taxonomy);
    }
}

if (!function_exists('get_previous_parent_post')) {
    /**
     * Get the previous adjacent parent post.
     *
     * This function extends the SQL WHERE query of the WordPress get_adjacent_post()
     * function. It registers a callback to the `get_previous_post_where` event filter,
     * which then adds a new WHERE parameter.
     *
     * @uses get_previous_post()
     * @uses `get_previous_post_where` filter
     * @uses fulcrum_add_parent_post_to_adjacent_sql()
     *
     * @since 3.1.3
     *
     * @param bool $inSameTerm Optional. Whether post should be in a same taxonomy term. Default false.
     * @param array|string $excludedTerms Optional. Array or comma-separated list of excluded term IDs. Default empty.
     * @param string $taxonomy Optional. Taxonomy, if $inSameTerm is true. Default 'category'.
     *
     * @return null|string|WP_Post Post object if successful. Null if global $post is not set. Empty string if no
     *                             corresponding post exists.
     */
    function get_previous_parent_post($inSameTerm = false, $excludedTerms = '', $taxonomy = 'category')
    {
        return ParentChild::getPreviousParentPost($inSameTerm, $excludedTerms, $taxonomy);
    }
}

if (!function_exists('extract_post_id')) {
    /**
     * Get the post ID from the given post or post ID.
     * If none is passed in, then it grabs the current ID.
     *
     * @since 3.1.3
     *
     * @param WP_Post|int|null $postOrPostId Given post or post ID
     *
     * @return int
     */
    function extract_post_id($postOrPostId = null)
    {
        return ParentChild::extractPostId($postOrPostId);
    }
}

/****************************
 * Plugin Functions
 ***************************/

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
