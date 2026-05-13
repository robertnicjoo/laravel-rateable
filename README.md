# Laravel Rateable

[![Latest Stable Version](https://poser.pugx.org/nicxonsolutions/laravel-rateable/v/stable.svg)](https://packagist.org/packages/nicxonsolutions/laravel-rateable) [![License](https://poser.pugx.org/nicxonsolutions/laravel-rateable/license.svg)](https://packagist.org/packages/nicxonsolutions/laravel-rateable)

[![Total Downloads](https://poser.pugx.org/nicxonsolutions/laravel-rateable/downloads.svg)](https://packagist.org/packages/nicxonsolutions/laravel-rateable) [![Monthly Downloads](https://poser.pugx.org/nicxonsolutions/laravel-rateable/d/monthly.png)](https://packagist.org/packages/nicxonsolutions/laravel-rateable) [![Daily Downloads](https://poser.pugx.org/nicxonsolutions/laravel-rateable/d/daily.png)](https://packagist.org/packages/nicxonsolutions/laravel-rateable)

Provides a trait to allow rating of any Eloquent models within your app for Laravel versions 8 and higher.

Ratings could be fivestar style, or simple +1/-1 style.


## Compatability

Laravel versions >= 8.x are supported, including Laravel 13.

## Installation

You can install the package via composer:

```bash
composer require nicxonsolutions/laravel-rateable
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="nicxonsolutions\Rateable\RateableServiceProvider" --tag="migrations"
php artisan migrate
```
The package will be auto-discovered by Laravel.

## Usage

In order to mark a model as "rateable", import the `Rateable` trait.

````php
<?php namespace App;

use nicxonsolutions\Rateable\Rateable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Rateable;

}
````

Now, your model has access to a few additional methods.

First, to add a rating to your model:

````php
$post = Post::first();

// Add a rating of 5, from the currently authenticated user
$post->rate(5);
dd(Post::first()->ratings);
````

Or perhaps you want to enforce that users can only rate each model one time,
and if they submit a new value, it will _update_ their existing rating.

In that case, you'll want to use `rateOnce()` instead:
```php
$post = Post::first();

// Add a rating of 3, or change the user's existing rating _to_ 3.
$post->rateOnce(3);
dd(Post::first()->ratings);
````

Once a model has some ratings, you can fetch the average rating:
````php
$post = Post::first();

dd($post->averageRating);
// $post->averageRating() also works for this.
````

Also, you can fetch the rating percentage. This is also how you enforce a maximum rating value.

````php
$post = Post::first();

dd($post->ratingPercent(10)); // Ten star rating system
// Note: The value passed in is treated as the maximum allowed value.
// This defaults to 5 so it can be called without passing a value as well.

// $post->ratingPercent(5) -- Five star rating system totally equivilent to:
// $post->ratingPercent()
````

You can also fetch the sum or average of ratings for the given rateable item the current (authorized) has voted/rated.
````php
$post = Post::first();

// These values depend on the user being logged in,
// they use the Auth facade to fetch the current user's id.


dd($post->userAverageRating); 

dd($post->userSumRating);
````

Want to know how many ratings a model has?
```php
dd($post->timesRated());

// Or if you specifically want the number of unique users that have rated the model:
dd($post->usersRated());
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Robert Nicjoo](https://github.com/robertnicjoo)
- [All Contributors](https://github.com/robertnicjoo/laravel-rateable/graphs/contributors)
- [Nicxon Solutions](https://nicxonsolutions.com)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
