<?php
// ==========================================================
// Plugins :: zeimoto :: Writer
// ==========================================================
//
// Provides an inline-only extension of Kirby Writer. Rejects
// block-content options while retaining native field behavior;
// blueprint usage and rendering are documented in README.md.
//
// ==========================================================

declare(strict_types=1);

use Zeimoto\Writer\WriterField;

load([
  WriterField::class => "src/WriterField.php",
], __DIR__);

Kirby::plugin("zeimoto/writer", [
  "fields" => [
    "zeimoto-writer" => WriterField::class,
  ],
]);
