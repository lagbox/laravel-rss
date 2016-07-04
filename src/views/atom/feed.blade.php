<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <id>{{ $id }}</id>
    <title>{{ $title }}</title>
    <subtitle>{{ $subtitle }}</subtitle>
    <link href="{{ $feedUrl }}" rel="self" />
    <link href="{{ $url }}" />
    <updated>{{ $updated }}</updated>

    @foreach($entries as $entry)
    <entry>
        <title>{{ $entry->rssTitle() }}</title>
        <link href="{{ $entry->rssLink() }}" />
        <id>{{ $entry->rssId() }}</id>
        @foreach ($entry->rssAuthor() as $author)
        <author>
            <name>{{ $author['name'] }}</name>
            @if (isset($author['email']))
            <email>{{ $author['email'] }}</email>
            @endif
            @if (isset($author['uri']))
            <uri>{{ $author['uri'] }}</uri>
            @endif
        </author>
        @endforeach
        <summary>
            {{ $entry->rssSummary() }}
        </summary>
        <updated>{{ $entry->rssUpdated()->toAtomString() }}</updated>
        @foreach ($entry->rssCategory() as $category)
        <category term="{{ $category }}" label="{{ $category }}" />
        @endforeach
    </entry>
    @endforeach
</feed>
