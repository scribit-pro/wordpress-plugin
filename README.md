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

1. Run the "Release" GitHub Action with the new version (no `v` prefix). It creates a GitHub release with `scribit-pro.zip`:

   ```sh
   gh workflow run release.yml -f version=1.2.3
   ```

2. Test the release before publishing it. Download `scribit-pro.zip` from the GitHub release, install it on a test site
   (Plugins > Add New > Upload Plugin, or `wp plugin install scribit-pro.zip --force --activate`) and check that it
   works. Found a bug? Fix it and cut a new release, nothing has reached the plugin directory yet.

3. Push the zip to the WordPress.org plugin directory. Log in with your wordpress.org username and the SVN password
   from Profile > Account & Security:

   ```sh
   gh release download 1.2.3 -p scribit-pro.zip -D ~/wp-release && unzip -q ~/wp-release/scribit-pro.zip -d ~/wp-release
   svn co https://plugins.svn.wordpress.org/scribit-pro ~/svn/scribit-pro && cd ~/svn/scribit-pro
   rsync -a --delete ~/wp-release/scribit-pro/ trunk/
   svn add --force trunk && svn status | awk '/^!/{print $2}' | xargs -r svn rm
   svn cp trunk tags/1.2.3
   svn ci -m "Release 1.2.3" --username <wp.org-username>
   ```
