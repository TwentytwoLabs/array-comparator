<?php

declare(strict_types=1);

namespace TwentytwoLabs\ArrayComparator\Comparator\Tests;

use PHPUnit\Framework\TestCase;
use TwentytwoLabs\ArrayComparator\AsserterTrait;
use TwentytwoLabs\ArrayComparator\Comparator\ComparatorChain;
use TwentytwoLabs\ArrayComparator\Comparator\DateComparator;
use TwentytwoLabs\ArrayComparator\Comparator\DateTimeComparator;
use TwentytwoLabs\ArrayComparator\Comparator\IntegerComparator;
use TwentytwoLabs\ArrayComparator\Comparator\SameComparator;
use TwentytwoLabs\ArrayComparator\Comparator\StringComparator;
use TwentytwoLabs\ArrayComparator\Comparator\UuidComparator;

/**
 * class AsserterTest.
 *
 * @codingStandardsIgnoreFile
 *
 * @SuppressWarnings(PHPMD)
 */
class AsserterTest extends TestCase
{
    use AsserterTrait;

    protected function setUp(): void
    {
        $this->comparatorChain = new ComparatorChain();
        $this->comparatorChain
            ->addComparators(new DateComparator())
            ->addComparators(new DateTimeComparator())
            ->addComparators(new IntegerComparator())
            ->addComparators(new StringComparator())
            ->addComparators(new UuidComparator())
            ->addComparators(new SameComparator())
        ;
    }

    public function testShouldNotValidateArray()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Keys [bar] must not be present  in parent status and Keys [unblocked, email_valid, password_valid, unconfirmed] are missing  in parent status');

        $expected = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];
        $items = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'bar' => 'foo',
            ],
        ];

        $this->assertKeysOfJson(array_keys($expected), array_keys($items));
        $this->assertValuesOfJson($expected, $items);
    }

    public function testShouldNotValidateArray2()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The value 1 is different to 2');

        $expected = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];
        $items = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 2,
                'unconfirmed' => 1,
            ],
        ];

        $this->assertKeysOfJson(array_keys($expected), array_keys($items));
        $this->assertValuesOfJson($expected, $items);
    }

    public function testShouldValidateArray()
    {
        $expected = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];
        $items = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];

        $this->assertValuesOfJson($expected, $items);
        $this->assertTrue(true);
    }

    public function testShouldNotValidateKeyOfArrayBecauseThereAreAdditionnalKeys()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Keys [bar] must not be present');

        $expected = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];
        $items = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'bar' => 'baz',
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];

        $this->assertKeysOfJson(array_keys($expected), array_keys($items));
    }

    public function testShouldNotValidateKeyOfArrayBecauseThereAreMissingKeys()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Keys [bar] are missing ');

        $expected = ['foo' => 'bar', 'bar' => 'baz'];
        $items = ['foo' => 'bar'];

        $this->assertKeysOfJson(array_keys($expected), array_keys($items));
    }

    public function testShouldValidateKeyOfArray()
    {
        $expected = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];
        $items = [
            'avatar' => null,
            'familyName' => 'Doe',
            'givenName' => 'John',
            'username' => 'john.doe@example.com',
            'roles' => [
                'ROLE_SUPER_ADMIN',
            ],
            'status' => [
                'unblocked' => 1,
                'email_valid' => 1,
                'password_valid' => 1,
                'unconfirmed' => 1,
            ],
        ];

        $this->assertKeysOfJson(array_keys($expected), array_keys($items));
        $this->assertTrue(true);
    }
}
