<?php

namespace Ozan;

class OzanRequest extends BaseModel
{
    public function fromJson()
    {
        return JsonBuilder::create()->getObject();
    }
}