# Scribit.Pro WordPress Plugin

> Online video from your WordPress site accessible to all.

## Overview

We're making it even easier to publish accessible videos on your WordPress site! With the Scribit.Pro WordPress plugin 
you'll be able to add Audio Descriptions and Text Alternatives to your YouTube and Vimeo videos without any coding.

## Requirements and Compatibility

### Requirements

The plugin runs with the following versions:

* [WordPress](https://wordpress.org) 5.9+
* [PHP](https://php.net/) 8.2+

## Hints for developers working on the plugin

- We require tools like `composer`, `git`, `mysql` and `wp cli` for developing this plugin. Make sure they are installed an available in your $PATH.
- Autoloading classes and files is done via composer. Make sure to run `composer install` when doing an initial setup.
- Lint your files with `composer run lint`
- PHPUnit tests require a dummy WordPress installation. Use `composer run setup-tests` to setup and `composer run tests` to run the tests
- Once you've updated any translations, regenerate the .pot file with `composer run generate-pot`

## Releasing

Releases are fully done by GitHub Actions, no local tooling needed. Go to Actions > "Release" > "Run workflow" and enter
the new version (e.g. `1.2.3`, no `v` prefix), or run:

```sh
gh workflow run release.yml -f version=1.2.3
```

The workflow bumps the version in `plugin.php` and `readme.txt`, regenerates the .pot file, commits and tags on `main`,
builds `scribit-pro.zip` (excluding everything in `.distignore`) and publishes a GitHub release with the zip attached.
Edit the release title and notes on GitHub afterwards if you like.
