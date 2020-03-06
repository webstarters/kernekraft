<?php

if (! function_exists('is_page_child_of')) {
    function is_page_child_of($page) {
        global $post;

        return (is_page() && $post->post_parent == $page);
    }
}

if (! function_exists('is_page_child')) {
    function is_page_child() {
        global $post;

        return (is_page() && $post->post_parent);
    }
}

if (! function_exists('custom_taxonomy_has_parent')) {
    function custom_taxonomy_has_parent($parent_term_id, $taxonomy = null, $term_id = null) {

        if (is_null($taxonomy)) {
            $taxonomy = get_queried_object()->taxonomy;
        }

        if (is_null($term_id)) {
            $term_id = get_queried_object_id();
        }

        $term = get_term($term_id, $taxonomy);

        if (is_wp_error($term) || !$term) {
            return null;
        }

        $parents = get_ancestors($term_id, $taxonomy, 'taxonomy');

        foreach ($parents as $parent) {
            if ($parent == $parent_term_id) {
                return true;
            }
        }

        return false;
    }
}

if (! function_exists('load_template_part')) {
    /**
     * return template as executed PHP in string
     *
     * @param  [type] $template_name [description]
     * @param  [type] $part_name     [description]
     * @return [type]                [description]
     */
    function load_template_part($template_name, $part_name = null) {
        $var = '';

        ob_start();
            get_template_part($template_name, $part_name);
            $var = ob_get_contents();
        ob_end_clean();

        return $var;
    }
}


if (! function_exists('nl_implode')) {
    /**
     * Join a string with a natural language conjunction at the end.
     * https://gist.github.com/angry-dan/e01b8712d6538510dd9c
     *
     * @param  array  $list
     * @param  string  $conjunction 'and'
     * @return string
     */
    function nl_implode(array $list, $conjunction = 'and')
    {
        $last = array_pop($list);

        if ($list) {
            return implode(', ', $list) . ' ' . $conjunction . ' ' . $last;
        }

        return $last;
    }
}

if (! function_exists('random_str')) {
    /**
     * Generate a random string, using a cryptographically secure
     * pseudorandom number generator (random_int)
     *
     * For PHP 7, random_int is a PHP core function
     * For PHP 5.x, depends on https://github.com/paragonie/random_compat
     *
     * @param int $length      How many characters do we want?
     * @param string $keyspace A string of all possible characters
     *                         to select from
     * @return string
     */
    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $pieces = [];

        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $pieces[] = $keyspace[random_int(0, $max)];
        }

        return implode('', $pieces);
    }
}

/**
 * Custom excerpt
 *
 * @param $limit
 *
 * @return array|mixed|string|void
 */
function ws_excerpt($limit, $excerpt = null) {

    if (is_null($excerpt)) {
        $excerpt = get_the_excerpt();
    }

    $excerpt = explode(' ', $excerpt, $limit);

    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }

    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

    return '<p>' . wp_strip_all_tags($excerpt) . '</p>';
}

/**
 * Check up on if we're using an old version of Internet Explorer
 *
 * @return bool
 */
function ws_is_old_ie($version_no = 11) {
    global $is_IE;

    return ($is_IE && ws_get_ie_version() < $version_no);
}

function ws_get_ie_version() {
    preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $version_no);

    return $version_no;
}
