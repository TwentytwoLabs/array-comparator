<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class ArrayComparator.
 */
class ArrayComparator implements ComparatorInterface
{
    public function support($expected): bool
    {
        return '<array>' === $expected;
    }

    public function compare($expected, $value): void
    {
        if (true !== \is_array($value)) {
            throw new \Exception(sprintf('The value %s is not an array', $value));
        }

        if (empty($value)) {
            throw new \Exception('Array is empty');
        }
    }
}
