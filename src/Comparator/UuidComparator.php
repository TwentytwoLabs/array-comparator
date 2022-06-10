<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class UuidComparator.
 */
class UuidComparator implements ComparatorInterface
{
    public function support($expected): bool
    {
        return '<uuid>' === $expected;
    }

    public function compare($expected, $value): void
    {
        if (true !== \is_string($value)) {
            throw new \Exception(sprintf('The value %s is not an uuid', $value));
        }

        if (empty($value)) {
            throw new \Exception(sprintf('The value %s is empty', $value));
        }
    }
}
