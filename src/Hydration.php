<?php


namespace didix16\Hydrator;

/**
 * Interface Hydration
 * @package didix16\Hydrator
 */
interface Hydration
{
    /**
     * Hydrate $instance with the provided $data.
     * The source of $data must be any kind data such array or something that implements ArrayAccess and Traversable
     * Returns the given instance filled with given data
     * @param array $data
     * @param object $instance
     * @return object
     */
    public function hydrate(array $data, object $instance): object;
}