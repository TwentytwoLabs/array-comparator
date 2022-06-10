<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * class DateTimeComparator.
 */
class DateTimeComparator implements ComparatorInterface
{
    public function support($expected): bool
    {
        return '<dateTime>' === $expected;
    }

    public function compare($expected, $value): void
    {
        if (0 === preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}\+[0-9]{2}:[0-9]{2}$#', $value)) {
            throw new \Exception(sprintf("The node value is '%s'", json_encode($value)));
        }
    }
}
