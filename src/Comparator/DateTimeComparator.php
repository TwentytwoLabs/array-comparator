<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

final class DateTimeComparator implements ComparatorInterface
{
    public function support(mixed $expected): bool
    {
        return '<dateTime>' === $expected;
    }

    public function compare(mixed $expected, mixed $value): void
    {
        if (0 === preg_match('#^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}\+[0-9]{2}:[0-9]{2}$#', $value)) {
            throw new \Exception(sprintf("The node value is '%s'", json_encode($value)));
        }
    }
}
