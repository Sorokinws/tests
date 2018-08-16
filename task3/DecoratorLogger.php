<?php
namespace src\Integration;
use Psr\Log\LoggerInterface;


class DecoratorLogger extends AbstractDataProviderDecorator
{
    private $logger;
    public function __construct(InterfaceDataProvider $component, LoggerInterface $logger)
    {
        parent::__construct($component);
        $this->logger = $logger;
    }

    public function get(array $input)
    {
        try
        {
            $result = $this->getComponent()->get($input);
            return $result;
        } catch (Exception $e) {
            $this->logger->critical('Error');
        }
        return [];
    }
}