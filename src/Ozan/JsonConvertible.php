<?php

namespace Ozan;

interface JsonConvertible
{
    public function getJsonObject();

    public function toJsonString();
}