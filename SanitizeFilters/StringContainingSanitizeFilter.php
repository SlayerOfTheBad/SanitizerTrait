<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Class StringContainingSanitizeFilter
 *
 * Filters an array of strings out of a string, or any word containing one of the strings
 * e.g. 'apple' would filter 'applepie'
 */
class StringContainingSanitizeFilter extends RegexSanitizeFilter
{
    public function __construct(
        array $strings,
        ?string $defaultReplacementChar = null,
        ?int $defaultReplacementLength = null
    )
    {
        $regexSafeStrings = [];

        foreach ($strings as $string) {
            $regexSafeStrings[] = '/[\S]*'.preg_quote($string).'[\S]*/i';
        }

        parent::__construct($regexSafeStrings, $defaultReplacementChar, $defaultReplacementLength);
    }
}