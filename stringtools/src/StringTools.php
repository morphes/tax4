<?php
declare(strict_types = 1);

/**
 * Class StringTools
 */
class StringTools
{
    /**
     * @var string
     */
    private $string;

    /**
     * StringTools constructor.
     *
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = (string)$string;
    }

    /**
     * @return StringTools
     */
    public function toUpperCase(): self
    {
        $this->string = strtoupper($this->string);
        return $this;
    }

    /**
     * @return StringTools
     */
    public function toLowerCase(): self
    {
        $this->string = strtolower($this->string);
        return $this;
    }

    /**
     * @param string $algorithm
     * @return string
     */
    public function hash(string $algorithm): string
    {
        return hash($algorithm, $this->string);
    }

    /**
     * @param array $parts
     * @return string
     */
    public static function concatenate(array $parts): string
    {
        return implode('', $parts);
    }

    /**
     * @param string $needle
     * @param string $replace
     * @param string $haystack
     * @return string
     */
    public static function replace(string $needle, string $replace, string $haystack): string
    {
        return str_replace($needle, $replace, $haystack);
    }

    /**
     * @return StringTools
     */
    public function trim(): self
    {
        $this->string = trim($this->string);
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}
