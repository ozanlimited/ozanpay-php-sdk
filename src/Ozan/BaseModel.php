<?php

namespace Ozan;

abstract class BaseModel implements Jsonable
{
    public function toJson()
    {
        return JsonBuilder::jsonEncode($this->fromJson());
    }
}