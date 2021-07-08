<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Class RegexSanitizeFilter
 *
 * A filter that will take an array of regular expressions and filter them out of any string
 * given to the sanitize function.
 */
class RegexSanitizeFilter extends AbstractSanitizeFilter
{
    /**
     * @var array The prohibited regular expressions
     */
    private array $regularExpressions;

    /**
     * RegexSanitizeFilter constructor.
     *
     * @param array $regularExpressions The prohibited regular expressions
     * @param string|null $defaultReplacementChar Character to replace prohibited character sequences with.
     * @param int|null $defaultReplacementLength Default max length of replacement character sequences.
     */
    public function __construct(
        array $regularExpressions,
        ?string $defaultReplacementChar = null,
        ?int $defaultReplacementLength = null
    )
    {
        parent::__construct($defaultReplacementChar, $defaultReplacementLength);
        $this->regularExpressions = $regularExpressions;
    }

    /**
     * @inheritDoc
     */
    public function sanitize(
        string $string,
        ?string $replacementChar,
        ?int $replacementLength
    ): string
    {
        $reChar = $replacementChar ?? $this->getDefaultReplacementChar();
        $maxReLen = $replacementLength ?? $this->getDefaultReplacementLength();

        foreach ($this->regularExpressions as $regex) {
            $matches = [];
            preg_match_all($regex, $string, $matches);

            foreach ($matches[0] ?? [] as $match) {
                $reLen = min(strlen($match), $maxReLen);

                $string = preg_replace(
                    $match,
                    str_repeat($reChar, $reLen),
                    $string
                );
            }
        }

        return $string;
    }
}