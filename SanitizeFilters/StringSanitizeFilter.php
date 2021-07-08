<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Class StringSanitizeFilter
 *
 * Filters an array of strings out of a string
 */
class StringSanitizeFilter extends RegexSanitizeFilter
{
    /**
     * StringSanitizeFilter constructor.
     *
     * @param array $strings The prohibited strings
     * @param bool|null $caseSensitive Whether the filter should be case sensitive or not
     * @param string|null $defaultReplacementChar Character to replace prohibited character sequences with.
     * @param int|null $defaultReplacementLength Default max length of replacement character sequences.
     */
    public function __construct(
        array $strings,
        ?bool $caseSensitive = true,
        ?string $defaultReplacementChar = null,
        ?int $defaultReplacementLength = null
    )
    {
        $regexSafeStrings = [];

        foreach ($strings as $string) {
            $regexSafeStrings[] = '/'.preg_quote($string).($caseSensitive ? '/' : '/.');
        }

        parent::__construct($regexSafeStrings, $defaultReplacementChar, $defaultReplacementLength);
    }
}