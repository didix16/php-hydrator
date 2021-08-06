<?php


namespace didix16\Hydrator;


use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

/**
 * Class ReflectionHydrator
 * @package didix16\Hydrator
 */
class ReflectionHydrator implements HydratorInterface
{

    /**
     * Simple in-memory array cache of ReflectionProperties used.
     * Array key is the FQCN class name and value are all its class properties [propName => ReflectionProperty]
     * @var ReflectionProperty[][]
     */
    protected static $reflectedProperties = [];

    /**
     * Extract values from an instance of an object
     * @param object $instance
     * @return array
     * @throws ReflectionException
     */
    public function extract(object $instance): array
    {
        $data =  [];
        $properties = self::getReflectedProperties($instance);
        foreach ($properties as $property) {
            $data[$property->getName()] = $property->getValue($instance);
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
     * @throws ReflectionException
     */
    public function hydrate(array $data, object $instance): object
    {
        $reflProperties = self::getReflectedProperties($instance);
        foreach ($data as $key => $value) {

            if (isset($reflProperties[$key])) {
                $reflProperties[$key]->setValue($instance, $value);
            }
        }

        return $instance;
    }

    /**
     * Get reflection properties from in-memory cache and lazy-load it if
     * class has not been loaded.
     *
     * @param object $input
     * @return ReflectionProperty[]
     * @throws ReflectionException
     */
    protected static function getReflectedProperties(object $input) : array
    {
        $class = get_class($input);

        if (isset(static::$reflectedProperties[$class])) {
            return static::$reflectedProperties[$class];
        }

        static::$reflectedProperties[$class] = [];
        $reflClass                      = new ReflectionClass($class);
        $reflProperties                 = $reflClass->getProperties();

        foreach ($reflProperties as $property) {
            // Property only accessible from ReflectionProperty class -> https://www.php.net/manual/es/reflectionproperty.setaccessible.php#110414
            $property->setAccessible(true);
            static::$reflectedProperties[$class][$property->getName()] = $property;
        }

        return static::$reflectedProperties[$class];
    }
}