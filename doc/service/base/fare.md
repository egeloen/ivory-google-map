## Fare

A fare represents a required tax. It contains a text, a value and a currency. 

## Text

The total fare amount, formatted in the requested language.

``` php
$text = $fare->getText();
```

## Value

The total fare amount, in the currency specified above.

``` php
$value = $fare->getValue();
```

## Currency

An [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) currency code indicating the currency that the amount is 
expressed in.

``` php
$currency = $fare->getCurrency();
```
