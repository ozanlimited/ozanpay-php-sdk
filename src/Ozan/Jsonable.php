<?php

namespace Ozan;

interface Jsonable
{
    public function fromJson();

    public function toJson();
}