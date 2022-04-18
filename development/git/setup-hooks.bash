#!/bin/bash

APP_PATH=$(dirname $(dirname $(dirname "${BASH_SOURCE[0]}")))

cp -f "$(dirname "${BASH_SOURCE[0]}")/hooks/pre-commit" "$APP_PATH/.git/hooks/pre-commit"
chmod +x "$APP_PATH/.git/hooks/pre-commit"
