# Table of Contents


## How do I install and setup this project?


1. install php 8 or greater
2. install lando from https://docs.lando.dev/
3. install docker from https://www.docker.com/get-started/
4. install composer from https://getcomposer.org/ or with `brew install composer` if on mac or 
5. cd into project root
6. run composer install
7. /robo.sh lando init
8. run `lando rebuild -y && lando si`
9. run `lando drush uli` to get a link to visit on your local
10. follow https://github.com/GSA/digital-gov-drupal/blob/develop/CONTRIBUTING.md

### How do I run the site locally?

1. run `lando rebuild -y && lando si`
2. run `lando drush uli` to get a link to visit on your local

Every time you switch branches run `lando rebuild -y && lando si`.

Run `lando drush cr` to clear out the cache.

When things are really messed up, run `lando destroy -y` then `lando rebuild -y && lando si` to rebuild site from scratch.

When making any back-end changes (content type fields, permissions, or adding test data) you will need to export the configuration changes.


### How to view the static site?

Make sure you have exported the content before running the next command.

run `./robo.sh export-content` then `./robo static` to generate the static `html` directory


### What should I do when things aren’t working?

If not seeing the url paths, build issues occur, or lando command failing then run `lando poweroff` and `lando start`.




### How do I export content?

When making any backend changes (content type fields, permissions, or adding test data), pretty much anything from the CMS admin side of things, you'll need to export the content.

`lando drush cex` will export the configuration files, typically yaml.

`lando drush cim` will import the config, use this when switching to a new branch and have run `lando rebuild -y`.


### How do templates work in general?

See `web/themes/custom/digital_gov/templates` for the below files.


1. Pre-process node/hooks (web/themes/custom/digital_gov/digital_gov.theme) will build the data structure for each content type to be available to the templates. If you update a content type then check here if you don't see listed.

2. Views return html markup and provide a way to format the data, they are then called from a template. They use a machine name convention and the CMS will list a view that should have a corresponding file in `web/themes/custom/digital_gov/templates/views`.
See docs here https://api.drupal.org/api/drupal/core%21modules%21views%21views.theme.inc/group/views_templates/11.x

3. Partials and templates follows a similar convention to the old hugo site to render the data.


### What about HCD guides?

HCD guides uses the Guide Landing Page content types and is different than all other landing pages.

### How are taxonomies used?

For the resources page, there are 6 "meta-topics" that are created as a taxonomy.
The HCD guides glossary too.


### How do I debug the page data?

Use `dump()` or pass a variable to inspect: `dump($authors_data)`.

## What is embedded content?

There are 3 types.

- Embedded shortcodes
- Media entities
- Block styles

See `Drupal Engineering Meeting - 2025/03/11 12:30 EDT` for a walkthrough. Located on digital.gov gDrive at `Engineering/CMS Migration/Drupal Documentation`.


### How do I toggle the sitewide alert?




### How do I test user roles and permission in the UI?

Go to the permissions tab and masquerade as a different user to test permission changes for a user.


### Misc/Follow up

Add robo.sh command to base readme from backend.md to readme.md
Drupal 8 was rewritten in symphony, Drupal 7 or earlier code suggestions will not work.
