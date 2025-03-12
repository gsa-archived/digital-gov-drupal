#!/bin/bash

mv manifest.yml manifest.tmp

# Convert to uppercase
CF_SPACE_UPPER=${CF_SPACE^^}

DRUSH_OPTIONS_URI_VAR_NAME="${CF_SPACE_UPPER}_CMS_URL"
export DRUSH_OPTIONS_URI="${!DRUSH_OPTIONS_URI_VAR_NAME}"

STATIC_URI_VAR_NAME="${CF_SPACE_UPPER}_STATIC_URL"
export STATIC_URI="${!DRUSH_OPTIONS_URI_VAR_NAME}"

envsubst < manifest.tmp > manifest.yml

cf push --strategy rolling

cf add-network-policy "${PROJECT}-${APP_NAME}-${CF_SPACE}" "${PROJECT}-${WAF_NAME}-${CF_SPACE}" -s "${CF_SPACE}" --protocol tcp --port ${BUILDPACK_PORT}
cf add-network-policy "${PROJECT}-${WAF_NAME}-${CF_SPACE}" "${PROJECT}-${APP_NAME}-${CF_SPACE}" -s "${CF_SPACE}" --protocol tcp --port ${BUILDPACK_PORT}
