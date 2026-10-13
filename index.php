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

$rejectBlockOption = function (string $option): never {
  throw new \Kirby\Exception\InvalidArgumentException(
    message: "The zeimoto-writer field is inline-only; `{$option}` only applies to block content. Remove it, or use Kirby's native `writer` field.",
  );
};

Kirby::plugin("zeimoto/writer", [
  "fields" => [
    "zeimoto-writer" => [
      "extends" => "writer",
      "props" => [
        "inline" => function (mixed $inline = true) use ($rejectBlockOption): bool {
          if ($inline === false) {
            $rejectBlockOption("inline: false");
          }

          return true;
        },
        "nodes" => function (mixed $nodes = null) use ($rejectBlockOption): null {
          if ($nodes !== null) {
            $rejectBlockOption("nodes");
          }

          return null;
        },
        "headings" => function (mixed $headings = null) use ($rejectBlockOption): null {
          if ($headings !== null) {
            $rejectBlockOption("headings");
          }

          return null;
        },
      ],
    ],
  ],
]);
