<?php

class MockLyric
{
    public function __construct($lyric)
    {
        $this->lyric = $lyric;
    }

    public function getLyric()
    {
        return $this->lyric;
    }
}