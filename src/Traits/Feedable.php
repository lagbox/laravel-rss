<?php

namespace lagbox\rss\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Config\Repository;

trait Feedable
{
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config->get('rss');
    }

    public function feed()
    {
        if ($this->config['cache']['enabled'] === true) {
            if ($this->config['cache']['time'] == 'forever') {
                $feed = Cache::rememberForever(
                    $this->config['cache']['key'],
                    function () {
                        return $this->buildFeed();
                    }
                );
            } else {
                $feed = Cache::remember(
                    $this->config['cache']['key'],
                    $this->config['cache']['time'],
                    function () {
                        return $this->buildFeed();
                    }
                );
            }
        } else {
            $feed = $this->buildFeed();
        }

        return Response::make(
            $feed,
            200,
            ['Content-Type' => 'application/xml;charset=UTF-8']
        );
    }

    protected function buildFeed()
    {
        return View::make(
            'rss::feed',
            Arr::except($this->config, 'cache') + [
                'entries' => $this->getEntities(),
                'updated' => Carbon::now(),
                'feedUrl' => Request::url(),
            ]
        )->render();
    }
}
