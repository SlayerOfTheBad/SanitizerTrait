<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Class EmailSanitizeFilter
 *
 * SanitizeFilter for removing emails
 */
class EmailSanitizeFilter extends RegexSanitizeFilter
{
    private const PATTERN_HTML5 = '/^[a-zA-Z0-9.!#$%&\'*+\\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/';
    private const PATTERN_LOOSE = '/^.+\@\S+\.\S+$/';

    /**
     * PhoneNumberSanitizeFilter constructor.
     *
     * @param bool $strict Use HTML 5 definition of an email if true, else use a more more general email filter
     * @param string|null $defaultReplacementChar Character to replace prohibited character sequences with.
     * @param int|null $defaultReplacementLength Default max length of replacement character sequences.
     */
    public function __construct(
        bool $strict = null,
        ?string $defaultReplacementChar = null,
        ?int $defaultReplacementLength = null
    )
    {
        parent::__construct(
            [$strict ? self::PATTERN_HTML5 : self::PATTERN_LOOSE],
            $defaultReplacementChar,
            $defaultReplacementLength
        );
    }
}