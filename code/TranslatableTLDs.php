<?php

/**
 * Convenience class for handling the Translatable TLD module.
 */
class TranslatableTLDs {

    /**
     * Returns the addresses TLD.
     *
     * @return string
     */
    public static function get_tld($part == 'tld') {
        
        return ($part == 'tld')?(pathinfo($_SERVER['SERVER_NAME'], PATHINFO_EXTENSION)):array_shift((explode(".",$_SERVER['HTTP_HOST'])));
    }

    /**
     * Looks for TLD-Locale matching rule.
     *
     * @return string|null The matched Locale or null if there was none.
     */
    public static function lookup_tld_rule() {
        $rules = Config::inst()->get(self::class, 'rules');
        $part = Config::inst()->get(self::class, 'part');

        return isset($rules[self::get_tld()]) ? $rules[self::get_tld($part)] : null;
    }
}
