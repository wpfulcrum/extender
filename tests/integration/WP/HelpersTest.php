<?php

namespace Fulcrum\Extender\Tests\Integration;

class HelpersTest extends IntegrationTestCase
{
    public function testShouldReturnNullWhenNoPostTypeSupports()
    {
        $this->assertEmpty(get_all_supports_for_post_type('foo'));
    }

    public function testShouldReturnPostTypeSupports()
    {
        register_post_type('foo');
        $this->assertEquals(['title', 'editor'], get_all_supports_for_post_type('foo'));
        unregister_post_type('foo');
    }

    public function testShouldReturnNoCustomPostTypes()
    {
        $this->assertEmpty(get_all_custom_post_types());
    }

    public function testShouldReturnAllCustomPostTypes()
    {
        $cpts = [
            'foo' => 'foo',
            'bar' => 'bar',
            'baz' => 'baz',
        ];
        foreach($cpts as $postName) {
            register_post_type($postName);
        }

        $this->assertEquals($cpts, get_all_custom_post_types());

        foreach($cpts as $postName) {
            unregister_post_type($postName);
        }
    }

    public function testShouldReturnCurrentWebPageId()
    {
        $this->go_to('/');
        $this->assertEquals(0, get_current_web_page_id());

        $this->go_to(get_permalink(self::$testPageId));
        $this->assertEquals(self::$testPageId, get_current_web_page_id());

        $this->go_to(get_permalink(self::$testPostId));
        $this->assertEquals(self::$testPostId, get_current_web_page_id());
    }

    public function testShouldReturnPostsWebPageId()
    {
        $postId = self::factory()->post->create(['post_title' => 'hello-world']);
        $this->go_to(get_permalink($postId));
        $this->assertEquals($postId, get_current_web_page_id());
    }

    public function testShouldReturnPathRelativeToHomeUrl()
    {
        $this->assertSame(trailingslashit(get_home_url()), get_url_relative_to_home_url());
        $this->assertSame(get_home_url(null, 'foo'), get_url_relative_to_home_url('foo'));
    }

    public function testShouldReturnPostIdWhenNotInAdmin()
    {
        $this->assertEquals(0, get_post_id_when_in_backend());
        $this->assertEquals(14, get_post_id_when_in_backend(14));
        $this->assertEquals('not an integer', get_post_id_when_in_backend('not an integer'));
    }

    public function testShouldReturnPostIdWhenInAdminButNotFound()
    {
        // This will make sure that WP_Query sets is_admin to true.
        set_current_screen( 'edit.php' );

        $this->assertEquals(0, get_post_id_when_in_backend());
        $this->assertEquals(14, get_post_id_when_in_backend(14));
        $this->assertEquals('not an integer', get_post_id_when_in_backend('not an integer'));

        set_current_screen( 'front' );
    }

    public function testShouldGetPostIdWhenInBackend()
    {
        // This will make sure that WP_Query sets is_admin to true.
        set_current_screen( 'edit.php' );

        $_REQUEST['post_ID'] = 10;
        $this->assertEquals(10, get_post_id_when_in_backend());
        unset($_REQUEST['post_ID']);
        $this->assertEquals(0, get_post_id_when_in_backend());

        $_REQUEST['post_id'] = 47;
        $this->assertEquals(47, get_post_id_when_in_backend());
        unset($_REQUEST['post_id']);
        $this->assertEquals(0, get_post_id_when_in_backend());

        $_REQUEST['post'] = 831;
        $this->assertEquals(831, get_post_id_when_in_backend());
        unset($_REQUEST['post']);
        $this->assertEquals(0, get_post_id_when_in_backend());

        $_REQUEST['post'] = '11';
        $this->assertEquals(11, get_post_id_when_in_backend());
        unset($_REQUEST['post']);
        $this->assertEquals(0, get_post_id_when_in_backend());

        set_current_screen( 'front' );
    }

    public function testShouldReturnGetTheIdWhenLessZero()
    {
        $this->go_to(get_permalink(self::$testPostId));

        $this->assertEquals(self::$testPostId, get_the_ID());
        $this->assertEquals(self::$testPostId, get_post_id());
        $this->assertEquals(self::$testPostId, get_post_id(-10));
        $this->assertEquals(self::$testPostId, get_post_id('not an integer'));
    }



    public function testShouldReturnPostIdWhenInBackend()
    {
        // This will make sure that WP_Query sets is_admin to true.
        set_current_screen( 'edit.php' );

        $_REQUEST['post_ID'] = 10;
        $this->assertEquals(10, get_post_id());
        unset($_REQUEST['post_ID']);
        $this->assertEquals(0, get_post_id());

        set_current_screen( 'front' );
    }
}
