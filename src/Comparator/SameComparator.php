<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class SameComparator.
 */
class SameComparator implements ComparatorInterface
{
    public function support($expected): bool
    {
        return true;
    }

    public function compare($expected, $value): void
    {
        if ($expected !== $value) {
            throw new \Exception(sprintf('The value %s is different to %s', $expected, $value));
        }
    }
}
