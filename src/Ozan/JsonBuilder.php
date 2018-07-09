<?php

namespace Ozan;

class JsonBuilder
{
    private $json;

    function __construct($json)
    {
        $this->json = $json;
    }

    /**
     * A factory for creating empty JsonBuilder.
     *
     * @return JsonBuilder
     */
    public static function create()
    {
        return new JsonBuilder(array());
    }

    public static function fromJsonObject($json)
    {
        return new JsonBuilder($json);
    }

    /**
     * Adds value with key
     * @param string $key The key with which the specified value is to be associated
     * @param $value The value to be associated with the specified key
     * @return JsonBuilder
     */
    public function add($key, $value = null)
    {
        if (isset($value)) {
            if ($value instanceof Jsonable) {
                $this->json[$key] = $value->fromJson();
            } else {
                $this->json[$key] = $value;
            }
        }
        return $this;
    }

    /**
     * Adds array value with key
     * @param string $key The key with which the specified value is to be associated
     * @param array $array The array value to be associated with the specified key
     * @return JsonBuilder
     */
    public function addArray($key, array $array = null)
    {
        if (isset($array)) {
            foreach ($array as $index => $value) {
                if ($value instanceof Jsonable) {
                    $this->json[$key][$index] = $value->fromJson();
                } else {
                    $this->json[$key][$index] = $value;
                }
            }
        }
        return $this;
    }

    public function getObject()
    {
        return $this->json;
    }

    /**
     * Returns the JSON representation of a value
     * @param $jsonObject
     * @return string
     */
    public static function jsonEncode($jsonObject)
    {
        return json_encode($jsonObject);
    }

    /**
     * Decodes a JSON string
     * @param $rawResult
     * @return mixed
     */
    public static function jsonDecode($rawResult)
    {
        return json_decode($rawResult);
    }
}
