# Simple Rss feed for your models

Atom RSS feed for your site. Provides caching of the entire feed for performance.

## Install

## Configuration

Publish the config

Publish the view if you want to adjust the feed xml

## Implement the Interface For Entries

`lagbox\rss\Interface\Entriable`:

```php
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
```

### Trait

The trait uses an array to map the fields used on your entity. If you want to use the trait to implement `rssTitle`, `rssSubTitle`, `rssSummary`, `rssUpdated` you should setup your `$rssFields` array:

```php
protected $rssFields = [
    'title' => 'title',
    'subtitle' => 'sub_title',
    'summary' => 'summary',
    'updated' => 'updated_at',
];
```

The trait does not provide the methods `rssLink`, `rssAuthor` or `rssCategory`. You will have to implement those methods yourself.

`rssLink` is for returning a full url to the current entity.

`rssAuthor` should return an array for the author (name, email) or an empty array.

```php
public function rssAuthor()
{
    return [
        'name' => $this->author->name,
        'email' => $this->author->email,
    ];
}
```

`rssCategory` should return the category name or an array of category names the entity belongs too. This could be categories or tags, how ever you have designed your categorizing.

```php
public function rssCategory()
{
    return $this->tags->pluck('name')->all();
}
```

## Controller

```php
use lagbox\rss\Traits\Feedable;

class YourController extends Controller
{
    use Feedable;

    /**
     * Returns a collection of entities of type Entriable.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getEntities()
    {
        return Post::latest('updated_at')->get();
    }
}
```

## Routes

```php
Route::get('feed', 'YourController@feed');
```