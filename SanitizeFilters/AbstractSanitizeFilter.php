<?php


namespace App\SanitizeTrait\SanitizeFilters;

/**
 * Class AbstractSanitizeFilter
 *
 * Filter for SanitizerTrait with a default replacement character, and default replacement length
 */
abstract class AbstractSanitizeFilter implements SanitizeFilterInterface
{
    /**
     * Character to replace prohibited character sequences with.
     *
     * @var string
     */
    private string $defaultReplacementChar;

    /**
     * Default max length of replacement character sequences.
     *
     * @var int
     */
    private int $defaultReplacementLength;

    /**
     * AbstractSanitizeFilter constructor.
     *
     * @param string|null $defaultReplacementChar Character to replace prohibited character sequences with.
     * @param int|null $defaultReplacementLength Default max length of replacement character sequences.
     */
    public function __construct(
        ?string $defaultReplacementChar = null,
        ?int $defaultReplacementLength = null
    ) {
        $this
            ->setDefaultReplacementChar($defaultReplacementChar ?? '*')
            ->setDefaultReplacementLength($defaultReplacementLength ?? 8)
        ;
    }

    /**
     * @inheritDoc
     */
    abstract public function sanitize(
        string $string,
        ?string $replacementChar,
        ?int $replacementLength
    ): string;

    /**
     * @return string
     */
    public function getDefaultReplacementChar(): string
    {
        return $this->defaultReplacementChar;
    }

    /**
     * @return int
     */
    public function getDefaultReplacementLength(): int
    {
        return $this->defaultReplacementLength;
    }

    /**
     * @param string $defaultReplacementChar
     */
    public function setDefaultReplacementChar(string $defaultReplacementChar): self
    {
        $this->defaultReplacementChar = $defaultReplacementChar;

        return $this;
    }

    /**
     * @param int $defaultReplacementLength
     */
    public function setDefaultReplacementLength(int $defaultReplacementLength): self
    {
        $this->defaultReplacementLength = $defaultReplacementLength;

        return $this;
    }
}