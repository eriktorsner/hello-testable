<?php
namespace helloTestable;

/**
 * Class Lyrics
 * A class to encapsulate lyrics for a song
 *
 * @package helloTestable
 */
class Lyrics
{
    /**
     * @var string
     */
    private $fullLyrics;

    /**
     * Lyrics constructor.
     */
    public function __construct($lyricsFile)
    {
        $this->fullLyrics = file_get_contents($lyricsFile);
    }

    /**
     * Get a single line from the lyrics
     *
     * @return string
     */
    function getLyric()
    {
        $lyrics = explode("\n", $this->fullLyrics);

        // And then randomly choose a line
        return wptexturize($lyrics[mt_rand(0, count($lyrics) - 1)]);

    }
}