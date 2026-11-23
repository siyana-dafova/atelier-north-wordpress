# Atelier North

Custom boutique WordPress site for an architecture & interior design studio.

Built from scratch with a custom theme (`atelier-north`) and a custom plugin (`atelier-north-core`). No third-party themes or plugins.

> Work in progress.

## Repository layout

Only the custom code is versioned. WordPress core, uploads and `wp-config.php` are not.

```
wp-content/
  themes/atelier-north/          Custom theme (templates, design system, assets)
  plugins/atelier-north-core/    Content types, project meta, galleries, settings, REST API, demo seeder
```

## Tech stack

- WordPress, PHP 8.3
- nginx 1.26, MySQL 8.4 (via [LocalWP](https://localwp.com/))
- WP-CLI

## Local setup

1. Install [LocalWP](https://localwp.com/) and create a site (PHP 8.3, nginx, MySQL 8.4).
2. Clone this repository into the site's `app/public` folder:
   ```bash
   cd path/to/site/app/public
   git init
   git remote add origin https://github.com/siyana-dafova/atelier-north-wordpress.git
   git fetch origin
   git checkout -t origin/main
   ```
3. In WP Admin, activate the `Atelier North` theme and the `Atelier North Core` plugin.
4. Settings > Permalinks: `Post name`.
