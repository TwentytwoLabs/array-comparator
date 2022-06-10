<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class IntegerComparator.
 */
class IntegerComparator implements ComparatorInterface
{
    public function support($expected): bool
    {
        return '<int>' === $expected;
    }

    public function compare($expected, $value): void
    {
        if (true !== \is_int($value)) {
            throw new \Exception(sprintf('The value %s is not an integer', $value));
        }
    }
}
