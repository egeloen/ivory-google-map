# Review

A review represents a vote done by a user.

## Author name

The author name is the name of the user who submitted the review.

``` php
$authorName = $review->getAuthorName();
```

## Author url

The author url is the URL to the users Google+ profile, if available.

``` php
$authorUrl = $review->getAuthorUrl();
```

## Text

The text is the user textual review.

``` php
$text = $review->getText();
```

## Rating

The rating is the user's overall rating for this place. This is a number, ranging from 1 to 5.

``` php
$rating = $review->getRating();
```

## Time

The time that the review was submitted as `DateTime`.

``` php
$time = $review->getTime();
```

## Aspects

The aspects is an array of specific ratings.

``` php
$aspects = $review->getAspects();
```

If you want to learn more about aspects, you can read this [documentation](/doc/service/place/base/aspect_rating.md).

## Language

The language is an IETF language code indicating the language used in the user's review.

``` php
$language = $review->getLanguage();
```
