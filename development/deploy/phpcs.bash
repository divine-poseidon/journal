#!/usr/bin/env bash

FILES=`git diff --name-only --diff-filter=ACM $CI_COMMIT_BEFORE_SHA $CI_COMMIT_SHA`
echo "$FILES"
if [[ $FILES ]]; then
    phpcs --error-severity=1 --warning-severity=8 --extensions=php "$FILES";
fi;
