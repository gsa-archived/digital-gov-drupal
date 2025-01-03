# Digital.gov (Drupal)

Welcome to the Digital.gov Drupal site.

See our [CONTRIBUTING.md](CONTRIBUTING.md) for Git configuration and working with validation.

### Contents

- [Software Requirements](#software-requirements)
- [Getting Starting](#getting-started)
- [Additional Reading](#additional-reading)

## Software Requirements

* PHP 8.3: Used to run `./robo.sh` / `./composer.sh` tasks
* Composer Version 2: https://getcomposer.org/, much faster to run composer locally than through docker
* Lando: https://lando.dev/download/

## Getting Started

The local environment is configured to use the [Lando Drupal Plugin](https://docs.lando.dev/plugins/drupal/getting-started.html). However, you cannot just `lando start` the first time you start the site. Instead, please `./robo.sh lando:init`. Following that, you can interact with the environment like a normal Lando site.

There is some custom functionality apart from what's in the base Lando installation.
* Installing a Drupal site from config (no DB needed): `lando si`
* If switching to a new branch, always: `lando rebuild -y && lando si` to start off completely fresh.
* See a list of shortcuts (Drush, Composer, etc.): `./robo.sh common:shortcuts-help`
* Use `./composer.sh` instead of `composer` or `lando composer`. `./composer.sh` will cause entries `composer.log` to be made so we can replay composer commands on conflicts.
* Sign in as admin: `./drush.sh uli`.
* Export content as configuration `./robo.sh drupal-project:export-content`. See [Exporting Content as Configuration](#exporting-content-as-configuration).

## Additional Reading

Please take a look at the `./docs` directory for more information.
