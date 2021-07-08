<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Interface SanitizeFilterInterface
 */
interface SanitizeFilterInterface
{
    /**
     * Sanitizes the passed string.
     *
     * @param string $string The string to be sanitized
     * @param string|null $replacementChar The character to replace prohibited character sequences with
     * @param int|null $replacementLength Max length of replacementChar sequences
     *
     * @return string
     */
    public function sanitize(
        string $string,
        ?string $replacementChar = null,
        ?int $replacementLength = null
    ): string;
}