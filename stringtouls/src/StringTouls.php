<?php

/**
 * Class StringTouls
 */
class StringTouls
{
    /**
     * @var string
     */
    private $string;

    /**
     * StringTouls constructor.
     *
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = (string)$string;
    }

    /**
     * @param string $a
     * @param string $b
     * @return string
     */
    public static function concat(string $a, string $b): string
    {
        return $a . $b;
    }

    /**
     * @return string
     */
    public function toUpperCase(): string
    {
        return strtoupper($this->string);
    }

    /**
     * @return string
     */
    public function toLowerCase(): string
    {
        return strtolower($this->string);
    }

    /**
     * @return string
     */
    public function hash(): string
    {
        return md5($this->string);
    }

    /**
     * @return string
     */
    public function md5(): string
    {
        return md5($this->string);
    }

    /**
     * @return string
     */
    public function sha512(): string
    {
        return hash('sha512', $this->string);
    }

    /**
     * @param string $a
     * @param string $b
     * @param string $c
     * @return string
     */
    public static function concatenate(string $a, string $b, string $c): string
    {
        return $a . $b . $c;
    }

    /**
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     * @return string
     */
    public static function replace(string $a, string $b, string $c): string
    {
        return str_replace($a, $b, $c);
    }

    /**
     * @return string
     */
    public function trim(): string
    {
        return trim($this->string);
    }
}
