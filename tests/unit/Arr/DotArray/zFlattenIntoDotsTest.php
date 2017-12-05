<?php

namespace Fulcrum\Tests\Unit\Extender\Arr\DotArray;

use PHPUnit\Framework\TestCase;
use Fulcrum\Extender\Arr\DotArray;

class ZFlattenIntoDotsTest extends TestCase
{
    public function testSingleLevel()
    {
        $data = [
            'user_id' => 504,
            'name'    => 'Bob Jones',
        ];

        $this->assertEquals($data, DotArray::flattenIntoDots($data));
        $this->assertEquals($data, array_flatten_into_dots($data));
    }

    public function test2Levels()
    {
        $data     = [
            'user_id' => 504,
            'name'    => 'Bob Jones',
            'social'  => [
                'twitter' => '@bobjones',
            ],
        ];
        $expected = [
            'user_id'        => 504,
            'name'           => 'Bob Jones',
            'social.twitter' => '@bobjones',
        ];

        $this->assertEquals($expected, DotArray::flattenIntoDots($data));
        $this->assertEquals($expected, array_flatten_into_dots($data));

        $data     = [
            'user_id' => 504,
            'name'    => 'Bob Jones',
            'social'  => [
                'twitter' => '@bobjones',
                'website' => 'https://bobjones.com',
            ],
        ];
        $expected = [
            'user_id'        => 504,
            'name'           => 'Bob Jones',
            'social.twitter' => '@bobjones',
            'social.website' => 'https://bobjones.com',
        ];

        $this->assertEquals($expected, DotArray::flattenIntoDots($data));
        $this->assertEquals($expected, array_flatten_into_dots($data));
    }

    public function testMultiLevels()
    {
        $data     = [
            'user_id' => 504,
            'name'    => 'Bob Jones',
            'social'  => [
                'twitter' => '@bobjones',
                'website' => [
                    'personal' => 'https://bobjones.com',
                    'business' => 'https://foo.com',
                ],
            ],
        ];
        $expected = [
            'user_id'                 => 504,
            'name'                    => 'Bob Jones',
            'social.twitter'          => '@bobjones',
            'social.website.personal' => 'https://bobjones.com',
            'social.website.business' => 'https://foo.com',
        ];

        $this->assertEquals($expected, DotArray::flattenIntoDots($data));
        $this->assertEquals($expected, array_flatten_into_dots($data));

        $data     = [
            'user_id'   => 504,
            'name'      => 'Bob Jones',
            'social'    => [
                'twitter' => '@bobjones',
                'website' => [
                    'personal' => 'https://bobjones.com',
                    'business' => 'https://foo.com',
                ],
            ],
            'languages' => [
                'php'        => [
                    'procedural' => true,
                    'oop'        => false,
                ],
                'javascript' => true,
                'ruby'       => false,
            ],
        ];
        $expected = [
            'user_id'                  => 504,
            'name'                     => 'Bob Jones',
            'social.twitter'           => '@bobjones',
            'social.website.personal'  => 'https://bobjones.com',
            'social.website.business'  => 'https://foo.com',
            'languages.php.procedural' => true,
            'languages.php.oop'        => false,
            'languages.javascript'     => true,
            'languages.ruby'           => false,
        ];

        $this->assertEquals($expected, DotArray::flattenIntoDots($data));
        $this->assertEquals($expected, array_flatten_into_dots($data));
    }

    public function testPrefix()
    {
        $data     = [
            'user_id' => 504,
            'name'    => 'Bob Jones',
            'social'  => [
                'twitter' => '@bobjones',
            ],
        ];
        $expected = [
            'wpmaker_user_id'        => 504,
            'wpmaker_name'           => 'Bob Jones',
            'wpmaker_social.twitter' => '@bobjones',
        ];

        $this->assertEquals($expected, DotArray::flattenIntoDots($data, 'wpmaker_'));
        $this->assertEquals($expected, array_flatten_into_dots($data, 'wpmaker_'));
    }
}
