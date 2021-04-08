<?php

namespace Tests\Util;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

trait InteractsWithNonPublicMembers
{
    public function getNonPublicProperty(object $object, string $property)
    {
        $property = (new ReflectionClass($object))->getProperty($property);

        return tap($property)->setAccessible(true)->getValue($object);
    }

    public function setNonPublicProperty(object $object, string $property, $value)
    {
        $property = (new ReflectionClass($object))->getProperty($property);

        return tap($property)->setAccessible(true)->setValue($object, $value);
    }

    public function callNonPublicMethod(object $object, string $method, array $args = [])
    {
        $method = (new ReflectionClass($object))->getMethod($method);

        return tap($method)->setAccessible(true)->invokeArgs($object, $args);
    }
}
