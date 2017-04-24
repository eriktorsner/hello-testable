<?php
namespace helloTestable;

class RuntimeProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $container = new Pimple\Container();
        $provider = new RuntimeProvider();
        $provider->register($container);

        $this->assertInstanceOf('helloTestable\Lyrics', $container['lyrics']);
        $this->assertInstanceOf('helloTestable\helloTestable', $container['helloTestable']);
    }
}