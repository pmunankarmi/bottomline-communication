# BottomLine Communication — WordPress theme

Classic WordPress conversion of the five pages in the supplied ZIP. The reference homepage was compared with the source: its only additional code was hosting analytics. Original page layouts, Bootstrap 5.3.3 styling, images, fonts, copy, project order and interactions are retained.

## Install

1. Install and activate your licensed **ACF Pro** plugin. It is not bundled in this repository.
2. Upload the `bottomline-communication` directory to `wp-content/themes/`, or install the supplied theme ZIP in **Appearance → Themes → Add New → Upload Theme**.
3. Activate **BottomLine Communication**. Missing Home, About, Selected Work, Clients and Start a Project pages are created automatically, with native page templates. A homepage is selected only if one is not already configured.
4. If these page slugs already exist, assign their matching **BottomLine** templates in the page editor. Select the intended Home page in **Settings → Reading**. Existing content and homepage settings are not overwritten.
5. Configure **BottomLine → Contact form delivery** and your host's WordPress mail/SMTP service. Test delivery to your real inbox before launch.

## Edit in WordPress admin

- **Pages → Edit:** page headings, descriptions, labels, links, image URL text and homepage statistics.
- **BottomLine:** navigation fallback text, shared footer, contact links, individual social URLs and the brief recipient.
- **BottomLine → project abbreviation:** each project's card/detail copy, category, metadata, scope items and gallery image URLs. Homepage-specific source copy remains separate where the original differs.
- **Appearance → Menus:** optionally assign native WordPress menus to Homepage navigation or Inner-page navigation. Until assigned, the original navigation appears exactly as supplied.
- Upload replacement images in **Media**, copy their file URL, and paste it into the corresponding ACF **text** field.

All ACF fields are registered in PHP and use only `type => text`. No WYSIWYG, image, repeater, flexible-content or JSON fields. Labels identify the original content. Text that originally contains emphasis is split around the markup; the markup stays in PHP. All original content is also embedded directly in PHP template parts as fallback values. The site renders even without ACF, but editing requires ACF Pro.

Saving a blank text field deliberately hides that text. Saved admin content takes precedence over PHP defaults on subsequent Git deployments. To change an already edited value, edit that field in WordPress; changing its PHP fallback does not overwrite the database. Layout changes, additional project slots and gallery slots belong in the PHP templates and matching PHP field definitions.

## Implementation

- Standard `functions.php`, `header.php`, `footer.php`, `front-page.php`, `page.php`, `index.php`, `404.php` and named page templates.
- Reusable navigation, footer, homepage sections, project cards and project detail template parts.
- Styles and scripts loaded with `wp_enqueue_style()` / `wp_enqueue_script()`; content fingerprints invalidate asset URLs when files change.
- Every project card, description, scope item and gallery image renders on the server. There is no JavaScript content dataset, `innerHTML` generation, JSON content or fetch-based rendering.
- JavaScript only enhances the original preloader, animation, counters, filters, budget selection, mobile navigation and PHP-rendered project panels. Removing all JavaScript would remove these interactive behaviors. A no-JavaScript stylesheet keeps the content and project details readable.
- The original form only simulated success. It now submits through WordPress `admin-post.php` and `wp_mail()`, with nonce checks, validation, a honeypot, a brief rate limit, and error handling. Success means the configured mail transport accepted the message; actual inbox delivery depends on the mail provider.
- Old `/index.html`, `/about.html`, `/projects.html`, `/clients.html` and `/contact.html` URLs redirect through WordPress to the corresponding pages. Existing physical HTML files on the host must be removed or redirected by the host so those requests reach WordPress.
- The original social links were `#`; replace them in admin when the final social URLs are available. Original contact copy, including the email address and copyright year, is preserved.

## Automatic deployment after Git pushes

The repository includes `.github/workflows/deploy.yml`. Every push to **main** validates the theme and, once configured, deploys directly to the installed theme over SSH/rsync. No WordPress update button, version polling, cron visit, or manual workflow dispatch is involved. Other branches and pull requests are validated without deployment.

One-time host configuration is required:

| Repository secret | Value |
| --- | --- |
| `WP_SSH_HOST` | WordPress server hostname |
| `WP_SSH_USER` | SSH deployment user with write access to this theme only where feasible |
| `WP_SSH_PORT` | SSH port, normally `22` |
| `WP_SSH_PRIVATE_KEY` | Dedicated deployment private key |
| `WP_SSH_KNOWN_HOSTS` | Host key verified through the hosting provider; strict host verification is enforced |
| `WP_PATH` | Absolute WordPress installation path |
| `WP_THEME_PATH` | Absolute installed theme path, ending in `/bottomline-communication` |
| `WP_CACHE_HOOK` | Optional absolute path to a server-managed executable for host/CDN/PHP-FPM cache invalidation |

The host needs PHP, SSH, rsync and WP-CLI. Paths in this workflow must not contain spaces. Install and activate the theme once before deployment. Then set repository variable **`WP_DEPLOY_ENABLED` to `true`**. Use a GitHub `production` environment without required reviewers if deployment must run unattended. Keep credentials in GitHub secrets, never in the theme.

Deployment validates the target before syncing. It only synchronizes the named theme directory; it does not replace uploads, plugins, WordPress core, `wp-config.php`, or database content. Theme-directory files removed from Git are removed from that installed theme. It flushes WordPress object cache and supported page caches; other host/CDN caches need the optional hook or provider configuration. Configure PHP OPcache to detect changed files, or have the host refresh PHP-FPM in its deployment hook. Exclude `/contact/` and receipt query URLs from host/CDN full-page caching.

**Automatic is not literally instantaneous.** GitHub runner scheduling, validation, upload and cache purges take time. Already-open visitor tabs require a reload to see new PHP/HTML. This workflow does not inject a live-refresh client. The rsync update is not an atomic release switch; hosts requiring zero mixed-file exposure should use their atomic deployment integration.

Live deployment has not been enabled or tested: hosting details and secrets were not supplied. ACF Pro's licensed options-page UI and production email delivery must also be verified on the actual installation.

## Validation

```sh
find bottomline-communication -name '*.php' -exec php -l {} \;
for file in bottomline-communication/assets/js/*.js; do node --check "$file"; done
python3 tests/check-theme.py
BL_WP_PATH=/path/to/disposable/wordpress php tests/wordpress.php
```

`tests/wordpress.php` requires the active theme and ACF. It verifies PHP rendering, field registration, saved/blank/default behavior, pages/templates and image paths on a disposable WordPress installation. It temporarily changes one text field and restores it.

`tests/check-http.py` is restricted to localhost and tests page responses, old URL redirects, nonce/validation failures, simulated mail failure, receipt rendering and rate limiting. Install `tests/local-mail-interceptor.php` **only in the disposable site's `wp-content/mu-plugins`** first; never deploy it to production. It intercepts all mail without sending it. Wait at least one minute between complete test runs to allow the rate limit to expire.
