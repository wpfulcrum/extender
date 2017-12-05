<?php

namespace Fulcrum\Extender\Tests\Integration;

class APITest extends TestCase
{
    public function testShouldReturnCurrentWebPageId()
    {
        $this->go_to('/');
        $this->assertEquals(0, get_current_web_page_id());

        $this->go_to(get_permalink(self::$testPageId));
        $this->assertEquals(self::$testPageId, get_current_web_page_id());

        $this->go_to(get_permalink(self::$testPostId));
        $this->assertEquals(self::$testPostId, get_current_web_page_id());
    }

    public function testShouldReturnStaticPageWebIds()
    {
        update_option('show_on_front', 'page');
        update_option('page_on_front', self::$pageOnFront);
        update_option('page_for_posts', self::$pageForPosts);

        $this->go_to('/');
        $this->assertEquals(self::$pageOnFront, get_current_web_page_id());

        $this->go_to(get_permalink(self::$pageForPosts));
        $this->assertEquals(self::$pageForPosts, get_current_web_page_id());
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
}
