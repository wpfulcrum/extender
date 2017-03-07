<?php

namespace Fulcrum\Tests\Extender\Arr;

use PHPUnit\Framework\TestCase;

class ArrayLastMatchTest extends TestCase
{
    protected $users;
    protected $dataSet;

    public function setUp()
    {
        $this->users   = require __DIR__ . '/test-data/user-data.php';
        $this->dataSet = [
            'i' => 1,
            'j' => 2,
            'k' => 3,
            'l' => 4,
            'm' => 5,
            'n' => 6,
            'o' => 7,
            'p' => 8,
        ];
    }

    public function testDefaultValue()
    {
        $this->assertNull(array_get_last_match($this->dataSet, function ($key, $value) {
            $threshold = 0;
            return $value < $threshold;
        }));

        $callback = function ($key, $value) {
            $threshold = 10;
            return $value > $threshold;
        };

        $this->assertFalse(array_get_last_match($this->dataSet, $callback, false));

        $this->assertEquals([], array_get_last_match($this->dataSet, function ($key, $value) {
            return $value % 10 === 0;
        }, []));
    }

    public function testClosure()
    {
        $expected = 8;
        $this->assertEquals($expected, array_get_last_match($this->dataSet, function ($key, $value) {
            return $value % 2 === 0;
        }));
        $expected = 6;
        $this->assertEquals($expected, array_get_last_match($this->dataSet, function ($key, $value) {
            return $value % 3 === 0;
        }));

        $callback = function ($key, $value) {
            $min = 600;
            return $key > $min;
        };
        $expected = [
            'user_id'    => 601,
            'name'       => 'Bob Jones',
            'has_access' => false,
        ];
        $this->assertEquals($expected, array_get_last_match($this->users, $callback));

        $callback = function ($key, $value) {
            if (!isset($value['has_access'])) {
                return false;
            }

            return !$value['has_access'];
        };
        $expected = [
            'user_id'    => 601,
            'name'       => 'Bob Jones',
            'has_access' => false,
        ];
        $this->assertEquals($expected, array_get_last_match($this->users, $callback));
    }

    public function testCallback()
    {
        $expected = 8;
        $this->assertEquals(
            $expected,
            array_get_last_match(
                $this->dataSet,
                'Fulcrum\Tests\Extender\Arr\isEvenCallback'
            )
        );
        $expected = 6;
        $this->assertEquals(
            $expected,
            array_get_last_match(
                $this->dataSet,
                'Fulcrum\Tests\Extender\Arr\isDivisibleBy3Callback'
            )
        );
        $expected = [
            'user_id'    => 601,
            'name'       => 'Bob Jones',
            'has_access' => false,
        ];
        $this->assertEquals(
            $expected,
            array_get_last_match(
                $this->users,
                'Fulcrum\Tests\Extender\Arr\doesNotHaveAccess'
            )
        );
    }

    public function testObjectCallback()
    {
        $callback = new CallbackStub();
        $expected = 8;
        $this->assertEquals($expected, array_get_last_match($this->dataSet, [$callback, 'isEven']));

        $data = [
            ['apple', 'pear', 'peach'],
            'Sally',
            'foo'    => ['bar', 'baz'],
            'sports' => ['baseball', 'football', 'basketball'],
            'dog', 'cat',
            'computer',
        ];
        $this->assertEquals(
            ['baseball', 'football', 'basketball'],
            array_get_last_match($data, [$callback, 'isAssociative'])
        );

        $this->assertEquals(
            [
                'user_id'    => 103,
                'name'       => 'Rose',
                'has_access' => true,
            ],
            array_get_last_match($this->users, [$callback, 'hasAccess'])
        );
    }

    public function testStaticCallback()
    {
        $callback = new CallbackStub();
        $expected = 8;
        $this->assertEquals($expected, array_get_last_match($this->dataSet, [$callback, 'isEvenStatic']));
        $this->assertEquals(
            $expected,
            array_get_last_match(
                $this->dataSet,
                ['Fulcrum\Tests\Extender\Arr\CallbackStub', 'isEvenStatic']
            )
        );

        $this->assertEquals(
            [
                'user_id'    => 103,
                'name'       => 'Rose',
                'has_access' => true,
            ],
            array_get_last_match(
                $this->users,
                'Fulcrum\Tests\Extender\Arr\CallbackStub::hasAccessStatic'
            )
        );
    }
}
