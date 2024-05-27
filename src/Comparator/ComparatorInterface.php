<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

interface ComparatorInterface
{
    public function support(mixed $expected): bool;

    public function compare(mixed $expected, mixed $value): void;
}
