<?php

namespace Core\Database\Traits;

trait HasAttributes
{
    private function setAttributes(array $array, $object = null)
    {
        if (!$object) {
            $className = get_called_class();
            $object = new $className;
        }
        foreach ($array as $attribute => $value) {
            $object->$attribute = $value;
        }
        return $object;
    }

    protected function setObject(array $array): void
    {
        $collection = [];
        foreach ($array as $value) {
            $object = $this->setAttributes($value);
            $collection[] = $object;
        }
        $this->collection = $collection;
    }
}