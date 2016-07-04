<?php

namespace lagbox\rss;

interface Entriable
{
    public function rssTitle();

    public function rssSubTitle();

    public function rssLink();

    public function rssId();

    public function rssAuthor();

    public function rssSummary();

    public function rssUpdated();

    public function rssCategory();
}
