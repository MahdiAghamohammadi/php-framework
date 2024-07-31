<?php

namespace Core\Database\Traits;

trait HasAttributes
{
    private function setAttributes(array $array, $object = null)
    {
        if (!$object) {
            $class = get_called_class();
            $object = new $class;
        }
        foreach ($array as $attribute => $value) {
            $object->$attribute = $value;
        }
        return $object;
    }

    protected function setObject(array $array): void
    {
        $collection = [];
        foreach ($array as $key => $value) {
            $object = $this->setAttributes($array, $value);
            $collection[] = $object;
        }
        $this->collection = $collection;
    }
}