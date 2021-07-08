<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Class PhoneNumberSanitizeFilter
 *
 * SanitizeFilter for removing phone numbers
 */
class PhoneNumberSanitizeFilter extends RegexSanitizeFilter
{
    /**
     * PhoneNumberSanitizeFilter constructor.
     *
     * @param string|null $defaultReplacementChar Character to replace prohibited character sequences with.
     * @param int|null $defaultReplacementLength Default max length of replacement character sequences.
     */
    public function __construct(
        ?string $defaultReplacementChar = null,
        ?int $defaultReplacementLength = null
    )
    {
        parent::__construct(
        // Phone number regex found at https://ihateregex.io/expr/phone/
            ['/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/i'],
            $defaultReplacementChar,
            $defaultReplacementLength
        );
    }
}