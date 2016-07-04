<?php

namespace lagbox\rss;

use lagbox\rss\Listeners\ClearFeed;
use Illuminate\Support\ServiceProvider;
use lagbox\rss\Events\FeedNeedsClearing;


class RssServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'rss');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/rss'),
        ]);

        $this->publishes([
            __DIR__.'/config/rss.php' => config_path('rss.php'),
        ]);

        $this->app['events']->listen(FeedNeedsClearing::class, ClearFeed::class);
    }

    public function register()
    {

    }
}
