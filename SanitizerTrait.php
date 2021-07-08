<?php


namespace App\SanitizeTrait;

use App\SanitizeTrait\SanitizeFilters\SanitizeFilterInterface;
use InvalidArgumentException;

trait SanitizerTrait
{
    private array $defaultFilters = [];

    /**
     * Add a filter to be used when there are no filters passed to sanitize().
     * Throws an InvalidArgumentException if the id already exists.
     *
     * @param SanitizeFilterInterface $filter Filter to be added
     * @param string|null $id (optional) ID for the filter to be able to remove it later.
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function addDefaultFilter(
        SanitizeFilterInterface $filter,
        ?string $id = null
    ): self
    {
        if (!isset($id)) {
            $this->defaultFilters[] = $filter;
            return $this;
        }

        if (array_key_exists($id, $this->defaultFilters))
            throw new InvalidArgumentException("Provided id already exists");

        $this->defaultFilters[$id] = $filter;

        return $this;
    }

    /**
     * Remove a filter by its id. Throws an InvalidArgumentException if the id does not exist.
     *
     * @param string $id
     *
     * @throws InvalidArgumentException
     *
     * @return $this
     */
    public function removeDefaultFilter(string $id): self
    {
        if (!array_key_exists($id, $this->defaultFilters))
            throw new InvalidArgumentException("Provided id is not associated with any filter");

        unset($this->defaultFilters[$id]);

        return $this;
    }

    /**
     * Removes all stored filters to start from a clean slate.
     *
     * @return $this
     */
    public function resetDefaultFilters(): self
    {
        $this->defaultFilters = [];

        return $this;
    }

    /**
     * Sanitize the provided string with the stored filters, or the provided filters.
     *
     * @param string $string
     * @param SanitizeFilterInterface[]|null $filters
     * @param string|null $replacementChar
     * @param int|null $replacementLength
     *
     * @throws InvalidArgumentException
     *
     * @return string
     */
    public function sanitize(
        string $string,
        ?array $filters = null,
        ?string $replacementChar = null,
        ?int $replacementLength = null
    ): string
    {
        if (!isset($filters)) {
            $filters = $this->defaultFilters;
        }

        foreach ($filters as $id => $filter) {
            if (!($filter instanceof SanitizeFilterInterface))
                throw new InvalidArgumentException(
                    sprintf(
                        "Expected all filters to implement SanitizeFilterInterface, but filter %s does not",
                        $id
                    )
                );
        }

        foreach ($filters as $filter)
            $string = $filter->sanitize($string, $replacementChar, $replacementLength);

        return $string;
    }
}