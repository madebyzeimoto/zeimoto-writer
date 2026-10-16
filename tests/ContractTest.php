<?php
// ==========================================================
// Tests :: Writer Contracts
// ==========================================================
//
// Exercises the plugin public behavior with disposable Kirby fixtures.
//
// ==========================================================

declare(strict_types=1);

namespace Zeimoto\Writer\Tests;

use Kirby\Form\Field;
use PHPUnit\Framework\Attributes\DataProvider;

final class ContractTest extends PluginTestCase
{
  public function testInlineWriterPreservesNativeValue(): void
  {
    $app = $this->app();
    $field = new Field("zeimoto-writer", ["name" => "title", "model" => $app->site(), "value" => "<strong>Hello</strong>"]);
    self::assertTrue($field->inline());
    self::assertStringContainsString("Hello", $field->value());
  }

  public static function blockOptions(): array
  {
    return [["inline", false], ["nodes", ["heading"]], ["headings", ["h1"]]];
  }

  #[DataProvider("blockOptions")]
  public function testBlockConfigurationIsRejected(string $option, mixed $value): void
  {
    $app = $this->app();
    $this->expectException(\Kirby\Exception\InvalidArgumentException::class);
    new Field("zeimoto-writer", ["name" => "title", "model" => $app->site(), $option => $value]);
  }
}
