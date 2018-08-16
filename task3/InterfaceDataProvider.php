<?php
namespace src\Integration;

interface InterfaceDataProvider
{
    public function get(array $request);
}