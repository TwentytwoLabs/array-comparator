<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class StringComparator.
 */
class StringComparator implements ComparatorInterface
{

    public function support($expected): bool
    {
        return '<string>' === $expected;
    }

    public function compare($expected, $value): void
    {
        if (true !== \is_string($value)) {
            throw new \Exception(sprintf('The value %s is not a string', $value));
        }

        if (empty($value)) {
            throw new \Exception(sprintf('The value %s is empty', $value));
        }
    }
}
