# BottomLine Communication — WordPress theme

A classic WordPress theme preserving the supplied website's design. Gutenberg is disabled. Page content, cards, galleries and panels render in PHP; JavaScript handles interactions and contact-form validation.

## Where to edit content

| Admin screen | Content |
| --- | --- |
| **BottomLine** | Shared logo, contact details, office addresses, social links, footer text and form notification recipient |
| **Appearance → Customize → Site Identity** | The same logo, synced with the global Logo image field |
| **Appearance → Menus** | Homepage and inner-page navigation |
| **Pages** | Page headings, introductory text, calls to action and homepage statistics |
| **Services** | Each service's title, excerpt, image URL, label and disciplines |
| **Work** | Each project's title, main description, excerpt, gallery and homepage display settings |
| **Work → Work Categories** | Branding, Events, Digital, Campaign, Activation and Retail; these drive the project filters |
| **Work → Scope of Work** | Reusable tags displayed in project detail panels |
| **Clients** | One post per sector, such as Hospitality or Retail & Fashion, with an ACF Pro logo gallery |
| **Form Submissions** | Saved contact briefs, email notification status and CSV export; administrators only |

Use **ACF Pro galleries** to add/remove images and drag to reorder. Other custom fields are text. WordPress's native editor handles Work descriptions, and native taxonomies handle categories and scope tags.

For a client sector, set **Display on** to `clients`, `home` or `both`. The original homepage logo selection is a separate **Homepage logos** post. The source includes some clients represented by text instead of images; these remain in **Clients without logo images**, using `position: name` entries separated by `|`. Replace those entries with gallery images whenever their actual logos are available.

For homepage Work cards, enter a positive **Homepage order**; leave it blank to omit the project. Use `wide` for a wide card. Native **Order** controls Services, Work listing and Clients sector ordering. Work homepage title/summary overrides are optional; the normal title and excerpt are used when blank. The category label preserves the source's display wording, while Work Categories controls filtering.

Global settings are grouped into **Branding, Contact, Offices, Social Media, Footer, and Form Delivery** tabs. The **Branding → Logo** image picker uploads or selects a Media Library image and shares WordPress's native `custom_logo` attachment. Changing or clearing either setting updates the other. With no custom logo, the original bundled logo is used in the header, footer and preloader.

## Theme structure

- `header.php`: document head, shared logo and native WordPress navigation.
- `footer.php`: shared footer and floating contact links.
- `template-home.php`: the entire homepage layout and PHP content loops, directly in this file.
- `front-page.php`: WordPress's front-page entry point; loads `template-home.php` once.
- `template-about.php`, `template-projects.php`, `template-clients.php`, `template-contact.php`: each page's complete layout.
- `inc/content-types.php`: Services, Work, Clients, taxonomies and their ACF fields.
- `inc/acf-fields.php` and `inc/section-fields.php`: page labels, section editors and repeaters.
- `inc/global-settings.php` and `inc/logo.php`: global settings and logo synchronization.
- `inc/contact.php` and `inc/submissions.php`: form handling, private storage and CSV export.
- `inc/default-content.php`, `inc/default-clients.php`, `inc/migrate.php`, `inc/legacy-fields.php`: one-time original-content import and preservation of previous field edits.
- `screenshot.png`: the actual homepage screenshot for Appearance → Themes.

There are no `content-home.php`, navigation template parts or nested template-part chains. Assets use native WordPress enqueue functions. Content remains in PHP and WordPress posts/meta rather than JavaScript datasets or JSON files.

## Install or update

1. Install and activate your licensed **ACF Pro** plugin; it is not bundled.
2. Upload the theme ZIP through **Appearance → Themes**, or deploy the `bottomline-communication` folder into `wp-content/themes/`.
3. Activate the theme. Missing standard pages and page-template assignments are created; existing page content and existing homepage settings are not overwritten.
4. On the first request, the theme imports the original 6 Services, 24 Work posts, 10 client sectors, Homepage logos, categories, scope tags and bundled gallery images. The uploads directory must be writable. Subsequent deployments do not overwrite these posts, recreate deliberately deleted content or reorder editor changes. Previous text-field edits are retained where they map to the new fields.
5. If matching pages already existed, assign their matching **BottomLine** templates. Set the intended homepage in **Settings → Reading**.
6. Set the notification recipient under **BottomLine** and configure the host's WordPress mail/SMTP service.

The form uses bundled **jQuery Validation** and independent server-side checks. Valid briefs are saved privately before the email notification is attempted. A failed notification remains visible in Form Submissions, and the visitor receives a receipt because the brief is stored. CSV export requires an administrator login and a valid nonce, and neutralizes spreadsheet formulas.

ACF Pro is required for the gallery editing interface and options page. Front-end gallery rendering uses stored attachment IDs and continues to work if ACF is temporarily inactive. Saved admin values override PHP fallback text. Old `.html` URLs redirect through WordPress; remove or redirect any physical static HTML files on the host so requests reach WordPress.

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
BL_WP_PATH=/path/to/disposable/wordpress python3 tests/check-http.py
```

Integration tests require a disposable **local** WordPress installation. They check native content imports, logo sync in both directions, galleries, taxonomies, PHP-rendered pages and all registered template fields. HTTP tests verify form validation, private submission storage, receipt handling, CSV contents, and export capability/nonce checks.

For HTTP tests, install `tests/local-mail-interceptor.php` in the disposable site's `wp-content/mu-plugins` directory. It intercepts all mail; never deploy it to production. Tests create local test submissions and a subscriber account. Wait at least one minute between complete HTTP runs for the form rate limit to expire.

The local test environment uses the shared ACF API; the licensed ACF Pro gallery/options UI and actual production mail delivery still need verification on the target WordPress installation.

## WordPress update notices

Version 2.0.1 adds the native WordPress update integration for this public GitHub repository. Upload this version once through Appearance → Themes → Add New → Upload Theme, then replace the installed theme. Older copies cannot discover this updater by themselves. Keep the installed directory named `bottomline-communication`.

After a push to main passes validation, GitHub publishes an installable release ZIP if the `Version` in `style.css` is new. Increment that three-part version for each release; existing releases are immutable. WordPress checks the latest stable release through its standard update system. Dashboard → Updates → Check again can request a fresh check. A newer version appears under Appearance → Themes and Dashboard → Updates; the installed latest version correctly shows no update. The active theme (or its child theme) must load this integration.

WordPress update checks and optional native automatic updates are scheduled, not instant. For unattended updates, enable auto-updates for this theme in WordPress, or configure the separate push deployment above. This release does not silently change the site's auto-update preference. GitHub API access must be available from the host. All page content remains in PHP/WordPress; the GitHub API supplies update metadata only.

Updater integration test: `BL_WP_PATH=/path/to/disposable/wordpress php tests/updates.php`.

The About page’s story paragraphs and quote use the default WordPress Classic Editor under Pages → About. Use the editor’s blockquote button for the highlighted quote. Existing story fields migrate once into empty page content; existing editor content is preserved.

About office cards use an Offices repeater with only Country, City and Address / description per row. The homepage CTA section uses one rich-text Content field (Heading 2, bold accent and paragraph) plus Primary button and Secondary button link controls. Existing values migrate once; saved edits and empty rows remain under editor control.

## Simplified page editing (2.1.0)

All five page templates use section-level content editors instead of fields for individual text fragments. Each inner-page hero has a section label and one editor for its full heading and introduction. Headings, quotes and CTA content stay together; link controls include both button text and destination. Homepage benefits, process steps, statistics, and About value cards use repeaters. Standard form labels and placeholders remain PHP interface text, retaining previously saved wording. Contact details remain in global settings.

In the Classic Editor or an ACF content editor, select words and choose **Formats → Gradient text** or **Accent text**. Use the regular Bold and Blockquote controls for emphasis and quotations. Formats appear in the editor’s second toolbar row (use Toolbar Toggle if hidden). The same class is styled in the editor and frontend; no separate gradient-text field is needed.

Existing values migrate once into the consolidated fields. Later editor changes, removed repeater rows and deliberately empty content are preserved. ACF Pro is required to edit repeaters and galleries.
