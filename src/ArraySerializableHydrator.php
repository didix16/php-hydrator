<?php


namespace didix16\Hydrator;

/**
 * Class ArraySerializableHydrator
 * @package didix16\Hydrator
 */
class ArraySerializableHydrator implements HydratorInterface
{

    /**
     * Extract values from an instance of an object.
     * The object will be treat as array. So implicity all public properties will be accesed.
     * For full access, the object should implement ArrayAccess to access all desired properties
     * @param object $instance
     * @return array
     */
    public function extract(object $instance): array
    {
        $data = [];

        foreach ($instance as $property => $value){

            $data[$property] = $value;
        }

        return $data;
    }

    /**
     * Hydrate $instance with the provided $data.
     * The source of $data must be any kind data such array or something that implements ArrayAccess and Traversable
     * Returns the given instance filled with given data
     * @param array $data
     * @param object $instance
     * @return object
     * @throws HydrationException
     */
    public function hydrate(array $data, object $instance): object
    {
        if ( !($instance instanceof \ArrayAccess)){
            throw new HydrationException("The given instance must implements ArrayAccess interface");
        }

        foreach ($data as $property => $value){

            $instance[$property] = $value;
        }

        return $instance;
    }
}