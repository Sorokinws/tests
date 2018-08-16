<?php
namespace src\Integration;
abstract class AbstractDataProviderDecorator implements InterfaceDataProvider
{
    private $component;

    public function __construct(InterfaceDataProvider $component)
    {
        $this->component = $component;
    }

    protected function getComponent()
    {
        return $this->component;
    }
}