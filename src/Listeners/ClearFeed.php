<?php

namespace lagbox\rss\Listeners;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Cache\Repository as Cache;

class ClearFeed
{
    public function __construct(Config $config, Cache $cache)
    {
        $this->config = $config->get('rss');
        $this->cache = $cache;
    }

    public function handle(FeedNeedsClearing $event)
    {
        $this->cache->forget($this->config['cache']['key']);
    }
}
