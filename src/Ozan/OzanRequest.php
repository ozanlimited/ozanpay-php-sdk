<?php

namespace Ozan;

class OzanRequest extends BaseModel
{
    public function getJsonObject()
    {
        return JsonBuilder::create()->getObject();
    }

}