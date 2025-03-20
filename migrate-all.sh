#!/bin/bash

set -x

# Runs all the migration steps in the expected order

# 1. Remove content created by default content that will be imported by the
# scripts.
./drush.sh rcbm

# 2. Build the feed for s3files that are directly linked in markdown,
#    not with the asset short code
./drush.sh digitalgov:s3feed > web/sites/default/files/s3files.json

# 3. Run all the migrations.
./drush.sh cr
./drush.sh migrate:rollback --tag="digitalgov"
./drush.sh migrate:import --tag="digitalgov"

# 4. Clean up migrated content (shortcodes, media links, emoji).
./drush.sh digitalgov:update-nodes
./drush.sh digitalgov:update-paragraphs

#rm ./web/sites/default/files/s3files.json
