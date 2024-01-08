<?php

namespace App\Http\Responses;


class BaseResp
{
    public function toArray()
    {
        return $this->__objectToArray($this);
    }

    private function __objectToArray($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }

        if (is_object($object)) {
            $object = get_object_vars($object);
        }

        return array_map(array($this, '__objectToArray'), $object);
    }
}
