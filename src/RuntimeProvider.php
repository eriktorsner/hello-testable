<?php
namespace helloTestable;

use helloTestable\Pimple\ServiceProviderInterface;
use helloTestable\Pimple\Container;

/**
 * Class RuntimeProvider
 *
 * Use Pimple as dependency injection container
 *
 */
class RuntimeProvider implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $slug = 'hello-testable';
        $lyricsFile = dirname(__DIR__) . '/assets/hello-dolly.txt';

        $pimple['lyrics'] = function ($pimple) use($lyricsFile) {
            return new \helloTestable\Lyrics($lyricsFile);
        };

        $pimple['helloTestable'] = function ($pimple) {
            return new \helloTestable\helloTestable($pimple['lyrics']);
        };
    }
}