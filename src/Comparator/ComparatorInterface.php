<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator;

/**
 * Interface ComparatorInterface.
 */
interface ComparatorInterface
{
    public function support($expected): bool;

    public function compare($expected, $value): void;
}
