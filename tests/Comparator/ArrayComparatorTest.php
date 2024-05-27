<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\Comparator\ArrayComparator;

final class ArrayComparatorTest extends TestCase
{
    public function testShouldNotSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertFalse($comparator->support('<foo>'));
    }

    public function testShouldSupportComparator(): void
    {
        $comparator = $this->getComparator();
        $this->assertTrue($comparator->support('<array>'));
    }

    #[DataProvider('getBadValues')]
    public function testShouldNotCompareValidDataBecauseItIsNotAnArray(mixed $value): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(sprintf('The value %s is not an array', $value));

        $comparator = $this->getComparator();
        $comparator->compare('<array>', $value);
    }

    /**
     * @return array<int, mixed>
     */
    public static function getBadValues(): array
    {
        return [
            ['foo'],
            [true],
            [false],
            [813],
        ];
    }

    public function testShouldNotCompareValidDataBecauseArrayIsEmpty(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Array is empty');

        $comparator = $this->getComparator();
        $comparator->compare('<array>', []);
    }

    public function testShouldCompareValidData(): void
    {
        $comparator = $this->getComparator();
        $comparator->compare('<array>', ['foo' => 'bar']);
        $this->assertTrue(true);
    }

    private function getComparator(): ArrayComparator
    {
        return new ArrayComparator();
    }
}
