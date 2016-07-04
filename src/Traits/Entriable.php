<?php

namespace lagbox\rss;

trait Entriable
{
    protected $rssFields = [
        'title' => 'title',
        'subtitle' => 'sub_title',
        'summary' => 'summary',
        'updated' => 'updated_at',
    ];

    public function rssTitle()
    {
        return $this->{$this->rssFields['title']};
    }

    public function rssSubTitle()
    {
        return $this->{$this->rssFields['subtitle']};
    }

    public function rssId()
    {
        return $this->rssLink();
    }

    public function rssSummary()
    {
        return $this->{$this->rssFields['summary']};
    }

    public function rssUpdated()
    {
        return $this->{$this->rssFields['updated']};
    }
}
