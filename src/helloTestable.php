<?php
namespace helloTestable;

/**
 * Class helloTestable
 * The main plugin class
 *
 * @package helloTestable
 */
class helloTestable
{
    /**
     * An object that we can call getLyric on
     *
     * @var Lyrics
     */
    private $lyrics;

    /**
     * helloTestable constructor.
     *
     * @param Lyrics $lyrics
     */
    public function __construct($lyrics)
    {
        $this->lyrics = $lyrics;
    }

    /**
     * Hook up our plugin with WordPress
     */
    public function init()
    {
        add_action('admin_notices', array($this, 'echoLyric'));
        add_action('admin_head', array($this, 'echoCss'));
    }

    /**
     * Output the lyric string
     */
    public function echoLyric()
    {
        $lyricString =  $this->lyrics->getLyric();
        echo "<p id='dolly'>$lyricString</p>";
    }

    /**
     * Output plugin css
     */
    public function echoCss()
    {
        // This makes sure that the positioning is also good for right-to-left languages
        $x = is_rtl() ? 'left' : 'right';

        echo "\n<style type='text/css'>
	        #dolly {
		        float: $x;
		        padding-$x: 15px;
		        padding-top: 5px;		
		        margin: 0;
		        font-size: 11px;
	        }
	        </style>\n";
    }
}