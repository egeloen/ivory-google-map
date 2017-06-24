#!/usr/bin/env bash

set -e

GROUP_ID=${GROUP_ID-1000}
USER_ID=${USER_ID-1000}

# Permissions
groupmod -g ${GROUP_ID} seluser
usermod -u ${USER_ID} seluser

# Start bash or forward command
if [ "$1" = "bash" ]; then
    su seluser
else
    su seluser -c "/opt/bin/entry_point.sh $*"
fi
