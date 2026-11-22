<?php
// ==========================================================
// Plugins :: zeimoto :: Writer :: WriterField
// ==========================================================
//
// Provides an inline-only extension of Kirby Writer.
//
// ==========================================================

declare(strict_types=1);

namespace Zeimoto\Writer;

use Kirby\Exception\InvalidArgumentException;
use Kirby\Form\Field\WriterField as KirbyWriterField;
use Kirby\Reflection\Attributes\Prop;

final class WriterField extends KirbyWriterField
{
  #[Prop]
  protected bool $inline = true;

  public function __construct(mixed ...$args)
  {
    if (array_key_exists("inline", $args) && $args["inline"] === false) {
      $this->reject("inline: false");
    }
    if (array_key_exists("nodes", $args) && $args["nodes"] !== null) {
      $this->reject("nodes");
    }
    if (array_key_exists("headings", $args) && $args["headings"] !== null) {
      $this->reject("headings");
    }

    parent::__construct(...$args);
  }

  private function reject(string $option): never
  {
    throw new InvalidArgumentException(
      message: "The zeimoto-writer field is inline-only; `{$option}` only applies to block content. Remove it, or use Kirby's native `writer` field.",
    );
  }
}
