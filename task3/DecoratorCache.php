<?php
namespace src\Integration;
use Psr\Cache\CacheItemPoolInterface;


class DecoratorCache extends AbstractDataProviderDecorator
{
    private $cache;
    public function __construct(InterfaceDataProvider $component, CacheItemPoolInterface $cache)
    {
        parent::__construct($component);
        $this->cache = $cache;
    }

    public function get(array $input)
    {
        $cacheKey = $this->getCacheKey($input);
        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $result = $this->getComponent()->get($input);
        $cacheItem->set($result)->expiresAt((new DateTime())->modify('+1 day'));
        return $result;
    }


    private function getCacheKey(array $input)
    {
        return json_encode($input);
    }
}