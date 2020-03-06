<?php

defined('ABSPATH') || exit;

/*
    $frag = new WS_Fragment_Cache('unique-key', 3600); // Second param is TTL
    if (! $frag->output()) { // NOTE, testing for a return of false
        functions_that_do_stuff_live();
        these_should_echo();
        // IMPORTANT
        $frag->store();
        // YOU CANNOT FORGET THIS. If you do, the site will break.
    }
*/

if (! class_exists('WS_Fragment_Cache')) {
    class WS_Fragment_Cache
    {
        const GROUP = 'ws-fragments';
        protected $key;
        protected $ttl;

        public function __construct($key, $ttl = 0)
        {
            $this->key = $key;
            $this->ttl = $ttl;
        }

        public function output()
        {
            $output = wp_cache_get($this->key, self::GROUP);

            if (! empty($output)) {
                echo $output;

                return true;
            }

            ob_start();

            return false;
        }

        public function store()
        {
            $output = ob_get_flush();

            wp_cache_add($this->key, $output, self::GROUP, $this->ttl);
        }
    }
}
