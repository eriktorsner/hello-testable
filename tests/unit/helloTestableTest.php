<?php
namespace helloTestable;

class helloTestableTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \WP_Mock::setUp();
    }

    public function tearDown()
    {
        \WP_Mock::tearDown();
    }

    public function testInit()
    {
        $dummy = new \stdClass();
        $hello = new helloTestable($dummy);

        \WP_Mock::expectActionAdded('admin_notices', array($hello, 'echoLyric'));
        \WP_Mock::expectActionAdded('admin_head', array($hello, 'echoCss'));

        $hello->init();
    }

    public function testEchoLyric()
    {
        $mockLyric = new \MockLyric('foobar');
        $hello = new helloTestable($mockLyric);

        $this->expectOutputRegex('/.*foobar*./');
        $hello->echoLyric();
    }

    public function testEchoCss()
    {
        \WP_Mock::userFunction('is_rtl', array(
            'return_in_order' => array(true, false),
        ));

        $dummy = new \stdClass();
        $hello = new helloTestable($dummy);

        $this->expectOutputRegex('/.*float: left*./');
        $hello->echoCss();

        $this->expectOutputRegex('/.*float: right*./');
        $hello->echoCss();
    }
}