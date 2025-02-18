#!/usr/bin/env bash

cd "$(dirname "$0")" || exit

if [ -z "$1" ]; then
  ./drush.sh migrate:status
  echo "Please provide a migration ID to run, any additional values will be passed to the the migration import."
  exit 1
fi

migrate_id="$1"      # Store the first argument
shift                # Shift arguments to the left, removing $1
remaining_args="$*"  # Capture all remaining arguments as a single string

./drush.sh cr && ./drush.sh migrate:reset-status "$migrate_id" && ./drush.sh migrate:rollback "$migrate_id" && ./drush.sh migrate:import "$migrate_id" "$remaining_args"
