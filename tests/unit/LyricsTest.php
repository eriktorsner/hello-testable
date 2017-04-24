<?php
namespace helloTestable;

class LyricsTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testGetLyric()
    {
        $file = dirname(__DIR__) . '/fixtures/lyrics.txt';
        $lyrics = new Lyrics($file);

        \WP_Mock::userFunction('wptexturize', array(
            'return' => function($s) {
                return $s . ' wptexturize';
            }
        ));

        $line = $lyrics->getLyric();
        $parts = explode(' ', $line);
        $this->assertEquals('line', $parts[0]);
        $this->assertEquals('wptexturize', $parts[2]);

    }
}