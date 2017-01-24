# Place Photo Response

When you have requested your photo, the returned object is a `StreamInterface` coming from PSR-7. It represents the 
body of the http response representing your photo.

``` php
$content = (string) $response;
```
