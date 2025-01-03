# Digital.gov (Drupal)

Welcome to the Digital.gov Drupal site.

See our [CONTRIBUTING.md](CONTRIBUTING.md) for Git configuration and working with validation.

### Contents

- [Software requirements](#software-requirements)
- [QuickStart installation](#quickstart-installation)
- [Working with the codebase](#working-with-the-codebase)
- [Basic command reference](#basic-command-reference)
- [Additional developer documentation](#additional-developer-documentation)

## Software requirements

* PHP 8.3: Used to run `./robo.sh` / `./composer.sh` tasks
* Composer Version 2: https://getcomposer.org/, much faster to run composer locally than through docker
* Lando: https://lando.dev/download/

See our [Install Help documentation](docs/install-help.md) for help with installing the PHP and Composer
requirements locally.

## QuickStart installation

The local environment is configured to use
the [Lando Drupal Plugin](https://docs.lando.dev/plugins/drupal/getting-started.html). However, you cannot
just `lando start` the first time you start the site.

Once you have confirmed that you have PHP 8.3 and Composer 2 installed locally run the follows CLI commands to get your
site running locally.

```
composer install
./robo.sh lando:init
# Installing a Drupal site from config (no DB needed).
lando si
```

Following that, you can interact with the environment like a normal Lando site using standard `lando` commands.

## Working with the codebase

There is some custom functionality apart from what's in the base Lando installation.

* See a list of shortcuts (Drush, Composer, etc.): `./robo.sh common:shortcuts-help`
* When switching to a new branch, always: `lando rebuild -y && lando si` to start off completely fresh.
* Export content as configuration `./robo.sh drupal-project:export-content`.
  See [Exporting Content as Configuration](docs/backend#exporting-content-as-configuration).

## Compiling theme assets

See our [Frontend documentation](docs/frontend.md) for working with the `digital_gov` custom theme.

## Basic command reference

### Composer commands
Instead of using `lando composer` we use `./composer.sh` which generate entries in `composer.log` so we can replay composer commands on conflicts.

| **Command**                                  | **Use case**                |
|----------------------------------------------|-----------------------------|
| `./composer.sh require drupal/<MODULE_NAME>` | Download a drupal module    |
| `./composer.sh remove drupal/<MODULE_NAME>`  | Remove a drupal module      |
| `./composer.sh update --lock`                | Import Drupal configuration |

### Drush commands

| **Command**       | **Use case**                 |
|-------------------|------------------------------|
| `lando drush cr`  | Clearing Drupal cache        |
| `lando drush uli` | Log into Drupal as superuser |
| `lando drush cim` | Import Drupal configuration  |
| `lando drush cex` | Export Drupal configuration  |

### Lando commands

| **Command**     | **Use case**                                         |
|-----------------|------------------------------------------------------|
| `lando start`   | Start the container                                  |
| `lando stop`    | Stop the container                                   |
| `lando rebuild` | Rebuild the container (retains your db)              |
| `lando destroy` | Destroys container and your db (when all else fails) |

### Custom Lando commands

| **Command**            | **Use case**                                    |
|------------------------|-------------------------------------------------|
| `lando si`             | Install a fresh Drupal site from configuration. |
| `lando export-content` | Export content as configuration.                |

## Additional developer documentation

Please take a look at the `./docs` directory for more information.
