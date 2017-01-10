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
    public static function get_tld() {
        return pathinfo($_SERVER['SERVER_NAME'], PATHINFO_EXTENSION);
    }

    /**
     * Looks for TLD-Locale matching rule.
     *
     * @return string|null The matched Locale or null if there was none.
     */
    public static function lookup_tld_rule() {
        $rules = Config::inst()->get(self::class, 'rules');

        return isset($rules[self::get_tld()]) ? $rules[self::get_tld()] : null;
    }

    /**
     * Looks for the TLD of a given locale within the rules.
     *
     * @param string $locale The locale in en_US format.
     *
     * @return int|null|string The matched TDL for the given locale or null if there was none.
     */
    public static function get_tld_for_locale($locale) {
        $rules = Config::inst()->get(self::class, 'rules');

        foreach ($rules as $tld => $loc) {
            if ($loc == $locale)
                return $tld;
        }

        return null;
    }
}