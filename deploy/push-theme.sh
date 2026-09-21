#!/usr/bin/env bash
set -euo pipefail
: "${WP_SSH_HOST:?Set WP_SSH_HOST}"
: "${WP_SSH_USER:?Set WP_SSH_USER}"
: "${WP_PATH:?Set WP_PATH to the WordPress installation}"
: "${WP_THEME_PATH:?Set WP_THEME_PATH to the installed bottomline-communication theme directory}"
WP_SSH_PORT="${WP_SSH_PORT:-22}"
# Keep the transport arguments unambiguous; deliberately reject shell metacharacters.
[[ "$WP_SSH_HOST" =~ ^[a-zA-Z0-9.-]+$ && "$WP_SSH_USER" =~ ^[a-zA-Z0-9_-]+$ && "$WP_SSH_PORT" =~ ^[0-9]+$ ]]
[[ "$WP_PATH" =~ ^/[a-zA-Z0-9_./-]+$ && "$WP_THEME_PATH" =~ ^/[a-zA-Z0-9_./-]+/bottomline-communication$ ]]
[[ "$WP_PATH" != *'/../'* && "$WP_THEME_PATH" != *'/../'* ]]
[[ -z "${WP_CACHE_HOOK:-}" || "$WP_CACHE_HOOK" =~ ^/[a-zA-Z0-9_./-]+$ ]]
remote="${WP_SSH_USER}@${WP_SSH_HOST}"
ssh_args=(-p "$WP_SSH_PORT" -o BatchMode=yes -o StrictHostKeyChecking=yes)
# Confirm the destination is an installed copy of this theme before syncing/deleting anything.
ssh "${ssh_args[@]}" "$remote" "test -f '$WP_PATH/wp-load.php' && test -f '$WP_THEME_PATH/style.css' && grep -q 'Theme Name: BottomLine Communication' '$WP_THEME_PATH/style.css' && wp --path='$WP_PATH' core is-installed"
# Only the named theme directory is synced. Database, uploads, plugins and wp-config.php are untouched.
rsync -az --checksum --delay-updates --delete-delay \
  -e "ssh -p $WP_SSH_PORT -o BatchMode=yes -o StrictHostKeyChecking=yes" \
  bottomline-communication/ "$remote:$WP_THEME_PATH/"
ssh "${ssh_args[@]}" "$remote" bash -s -- "$WP_PATH" "${WP_CACHE_HOOK:-}" <<'REMOTE'
set -euo pipefail
wp --path="$1" cache flush
# Standard WordPress hooks for common full-page cache plugins when installed.
wp --path="$1" eval 'if (function_exists("rocket_clean_domain")) rocket_clean_domain(); if (function_exists("wp_cache_clear_cache")) wp_cache_clear_cache(); if (function_exists("w3tc_flush_all")) w3tc_flush_all(); if (has_action("litespeed_purge_all")) do_action("litespeed_purge_all");'
# Optional administrator-owned executable handles host/CDN/FPM cache purges.
if [ -n "$2" ]; then test -x "$2"; "$2"; fi
REMOTE
