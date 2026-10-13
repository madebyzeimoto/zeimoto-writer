# zeimoto Writer

`zeimoto/writer` provides the `zeimoto-writer` Panel field: Kirby's native Writer
locked to inline rich text. It supports inline formatting and hard line breaks,
without paragraph, heading, or list editing. Use native `writer` for block content.

## Installation

Requires PHP 8.5 and Kirby 5.6.1 or later within Kirby 5.
The Composer package is `zeimoto/writer` and installs into
`site/plugins/zeimoto-writer`. Release versions come from Git tags.

Once published on Packagist:

```sh
composer require zeimoto/writer
```

For manual installation, copy this plugin into `site/plugins/zeimoto-writer`.
See the integration requirements below before using its public surfaces.
The plugin is distributed under the MIT license; see [LICENSE](LICENSE).

## Blueprint usage

```yaml
type: zeimoto-writer
label: Title
marks:
  - bold
  - italic
  - link
  - clear
toolbar:
  inline: false
```

The field inherits Kirby Writer's mark configuration, placeholder, toolbar,
character counter, and minimum/maximum length options. It also inherits native
Writer value sanitization and length validation.

Content mode is always inline. Omitting `inline` or setting `inline: true` is
valid. Explicit `inline: false`, or non-null `nodes` and `headings` options,
throws a configuration error; this includes `nodes: false`.

`toolbar.inline: false` is different: it places the toolbar at the top of the
field and does not enable block content. This is how the kit configures its
hero fields and quote text field.

## Rendering

Render with `kirbytextinline()` and let the consumer own the containing element:

```php
<h1><?= $page->heroTitle()->kirbytextinline() ?></h1>
```

The result is rendered markup, so do not HTML-escape it again. Inline mode uses
hard breaks instead of wrapping new lines in paragraphs. Choose a containing
element appropriate to the content, and account for line breaks in its styling.

The inline restriction governs editor configuration; it is not a migration or
guarantee that manually imported legacy content contains no block HTML.

## Integration and verification

Install and enable the plugin before using its field type. The PHP definition
extends Kirby's `writer` field, and `index.js` extends `k-writer-field` without
replacing its editor. There are no plugin options or separate build steps.

The kit uses the field for hero title, subtitle, intro, and quote text. After a
Kirby upgrade, check formatting, Enter/line breaks, pasted content, save/reload,
frontend rendering, and native required/length validation in the Panel. Confirm
that the toolbar remains usable and block-only options still report an error.

## Development environment

Open `kirby.code-workspace` while this plugin is installed under the zeimoto Kirby
Kit's `site/plugins/` directory. The workspace uses the kit's Composer and npm
dependencies, shared formatting rules, and Kirby classes for autocomplete. IDE
stubs are included; local editor settings, caches, private notes, and `.env` are
ignored. The formatter launcher currently requires Herd's PHP 8.5 on macOS.

Install Composer and npm dependencies at the kit root. From that root, check this
plugin with:

```sh
node tools/check-style.mjs --plugin site/plugins/zeimoto-writer
```
