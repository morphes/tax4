<?php

use PHPUnit\Framework\TestCase;

final class StringToolsTest extends TestCase
{
    public function testTrim()
    {
        $stringTool = new StringTools(' string');
        $this->assertEquals('string', $stringTool->trim());
    }

    public function testToUpperCase()
    {
        $stringTool = new StringTools('string');
        $this->assertEquals('STRING', $stringTool->toUpperCase());
    }

    public function testToLowerCase()
    {
        $stringTool = new StringTools('STRING');
        $this->assertEquals('string', $stringTool->toLowerCase());
    }

    public function testMd5()
    {
        $stringTool = new StringTools('teststring');
        $this->assertEquals(
            'd67c5cbf5b01c9f91932e3b8def5e5f8', $stringTool->hash('md5')
        );
    }

    public function testSha512()
    {
        $stringTool = new StringTools('teststring');
        $this->assertEquals(
            '6253b39071e5df8b5098f59202d414c37a17d6a38a875ef5f8c7d89b0212b028692d3d2090ce03ae1de66c862fa8a561e57ed9eb7935ce627344f742c0931d72',
            $stringTool->hash('sha512')
        );
    }

    public function testConcat()
    {
        $this->assertEquals(
            'string', StringTools::concatenate(['str', 'ing'])
        );
    }

    public function testConcatenate()
    {
        $this->assertEquals(
            'string', StringTools::concatenate(['st', 'ri', 'ng'])
        );
    }

    public function testReplace()
    {
        $this->assertEquals(
            'sporring', StringTools::replace('t', 'por', 'string')
        );
    }

    public function testMixedLc()
    {
        $stringTool = new StringTools(' test');
        $this->assertEquals(
            '033bd94b1168d7e4f0d644c3c95e35bf',
            $stringTool->trim()->toUpperCase()->hash('md5')
        );
    }

    public function testMixedUc()
    {
        $stringTool = new StringTools('TEST ');
        $this->assertEquals(
            '7bfa95a688924c47c7d22381f20cc926f524beacb13f84e203d4bd8cb6ba2fce81c57a5f059bf3d509926487bde925b3bcee0635e4f7baeba054e5dba696b2bf',
            $stringTool->trim()->toUpperCase()->hash('sha512')
        );
    }
}