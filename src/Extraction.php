<?php


namespace didix16\Hydrator;

/**
 * Interface Extraction
 * @package didix16\Hydrator
 */
interface Extraction
{
    /**
     * Extract values from an instance of an object
     * @param object $instance
     * @return array
     */
    public function extract(object $instance): array;
}