<?php

use PHPUnit\Framework\TestCase;

final class StringToulsTest extends TestCase
{
    public function testTrim()
    {
        $stringToul = new StringTouls(' string');
        $this->assertEquals('string', $stringToul->trim());
    }

    public function testToUpperCase()
    {
        $stringToul = new StringTouls('string');
        $this->assertEquals('STRING', $stringToul->toUpperCase());
    }

    public function testToLowerCase()
    {
        $stringToul = new StringTouls('STRING');
        $this->assertEquals('string', $stringToul->toLowerCase());
    }

    public function testMd5()
    {
        $stringToul = new StringTouls('teststring');
        $this->assertEquals('d67c5cbf5b01c9f91932e3b8def5e5f8', $stringToul->md5());
    }

    public function testSha512()
    {
        $stringToul = new StringTouls('teststring');
        $this->assertEquals('6253b39071e5df8b5098f59202d414c37a17d6a38a875ef5f8c7d89b0212b028692d3d2090ce03ae1de66c862fa8a561e57ed9eb7935ce627344f742c0931d72', $stringToul->sha512());
    }

    public function testConcat()
    {
        $this->assertEquals('string', StringTouls::concat('str', 'ing'));
    }

    public function testConcatenate()
    {
        $this->assertEquals('string', StringTouls::concatenate('st', 'ri', 'ng'));
    }

    public function testReplace()
    {
        $this->assertEquals('sporring', StringTouls::replace('t', 'por', 'string'));
    }
}