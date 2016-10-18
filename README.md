# Translatable Top-Level-Domains for SilverStripe
This modules enables having duplicate URLSegments for different TLDs on one host, e.g. lvl51.de/about and lvl51.com/about. Since this is intended to be used alongside the Translatable module there will be entries in the `SiteTree` table for each of pages/URLSegments.

## Dependencies
- SilverStripe Framework ~3.1
- SilverStripe CMS ~3.1
- Translatable ~2.1

## Installation
```
composer require level51/translatable-tlds
```

If you don't like composer you can just download and unpack it to the root of your SilverStripe project.

Be sure to run `dev/build?flush=all` after you have added the module.

## Features
- Locale-sensitive delivery of `SiteTree` records.
- Helper methods for working with TLDs:
```php
// Fetches the current TLD and looks for a rule in the config
$locale = TranslatableTLDs::lookup_tld_rule();

// Apply the rule (if not null)
if($locale)
    Translatable::set_current_locale($locale);
```

## Configuration
You can add rules via Config API:

```yml
TranslatableTLDs:
  rules:
    'com': 'en_US'
    'de': 'de_DE'
    'net': 'de_AT'
```

## Maintainers
- Julian Scheuchenzuber <js@lvl51.de>
