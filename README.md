Tank Cookies
===========

Managing Cookies for PSR-7 Requests and Responses.

Installation
------------

```bash
$> composer require tank/cookies
```


Concepts
--------

tank Cookies tackles two problems, managing **Cookie** *Request* headers and
managing **Set-Cookie** *Response* headers. It does this by way of introducing
a `Cookies` class to manage collections of `Cookie` instances and a
`SetCookies` class to manage collections of `SetCookie` instances.

Instantiating these collections looks like this:

```php
// Get a collection representing the cookies in the Cookie headers
// of a PSR-7 Request.
$cookies = Tank\Cookies\Cookies::fromRequest($request);

// Get a collection representing the cookies in the Set-Cookie headers
// of a PSR-7 Response
$setCookies = Tank\Cookies\SetCookies::fromResponse($response);
```

After modifying these collections in some way, they are rendered into a
PSR-7 Request or PSR-7 Response like this:

```php
// Render the Cookie headers and add them to the headers of a
// PSR-7 Request.
$request = $cookies->renderIntoCookieHeader($request);

// Render the Set-Cookie headers and add them to the headers of a
// PSR-7 Response.
$response = $setCookies->renderIntoSetCookieHeader($response);
```

Like PSR-7 Messages, `Cookie`, `Cookies`, `SetCookie`, and `SetCookies`
are all represented as immutable value objects and all mutators will
return new instances of the original with the requested changes.

While this style of design has many benefits it can become fairly
verbose very quickly. In order to get around that, Tank Cookies provides
two facades in an attempt to help simply things and make the whole process
less verbose.


Basic Usage
-----------

The easiest way to start working with Tank Cookies is by using the
`RequestCookies` and `ResponseCookies` classes. They are facades to the
primitive Tank Cookies classes. Their jobs are to make common cookie related
tasks easier and less verbose than working with the primitive classes directly.

There is overhead on creating `Cookies` and `SetCookies` and rebuilding
requests and responses. Each of the `Cookies` methods will go through this
process so be wary of using too many of these calls in the same section of
code. In some cases it may be better to work with the primitive Tank Cookies
classes directly rather than using the facades.


### Request Cookies

Requests include cookie information in the **Cookie** request header. The
cookies in this header are represented by the `Cookie` class.

```php
use Tank\Cookies\Cookie;

$cookie = Cookie::create('theme', 'blue');
```

To easily work with request cookies, use the `RequestCookies` facade.

#### Get a Request Cookie

The `get` method will return a `Cookie` instance. If no cookie by the specified
name exists, the returned `Cookie` instance will have a `null` value.

The optional third parameter to `get` sets the value that should be used if a
cookie does not exist.

```php
use Tank\Cookies\RequestCookies;

$cookie = RequestCookies::get($request, 'theme');
$cookie = RequestCookies::get($request, 'theme', 'default-theme');
```

#### Set a Request Cookie

The `set` method will either add a cookie or replace an existing cookie.

The `Cookie` primitive is used as the second argument.

```php
use Tank\Cookies\RequestCookies;

$request = RequestCookies::set($request, Cookie::create('theme', 'blue'));
```

#### Modify a Request Cookie

The `modify` method allows for replacing the contents of a cookie based on the
current cookie with the specified name. The third argument is a `callable` that
takes a `Cookie` instance as its first argument and is expected to return a
`Cookie` instance.

If no cookie by the specified name exists, a new `Cookie` instance with a
`null` value will be passed to the callable.

```php
use Tank\Cookies\RequestCookies;

$modify = function (Cookie $cookie) {
    $value = $cookie->getValue();

    // ... inspect current $value and determine if $value should
    // change or if it can stay the same. in all cases, a cookie
    // should be returned from this callback...

    return $cookie->withValue($value);
}

$request = RequestCookies::modify($request, 'theme', $modify);
```

#### Remove a Request Cookie

The `remove` method removes a cookie if it exists.

```php
use Tank\Cookies\RequestCookies;

$request = RequestCookies::remove($request, 'theme');
```

Note that this does not cause the client to remove the cookie. Take a look at
`ResponseCookies::expire` to do that.

### Response Cookies

Responses include cookie information in the **Set-Cookie** response header. The
cookies in these headers are represented by the `SetCookie` class.

```php
use Tank\Cookies\Modifier\SameSite;
use Tank\Cookies\SetCookie;

$setCookie = SetCookie::create('lu')
    ->withValue('Rg3vHJZnehYLjVg7qi3bZjzg')
    ->withExpires('Tue, 15-Jan-2013 21:47:38 GMT')
    ->withMaxAge(500)
    ->rememberForever()
    ->withPath('/')
    ->withDomain('.example.com')
    ->withSecure(true)
    ->withHttpOnly(true)
    ->withSameSite(SameSite::lax())
;
```

To easily work with response cookies, use the `ResponseCookies` facade.

#### Get a Response Cookie

The `get` method will return a `SetCookie` instance. If no cookie by the
specified name exists, the returned `SetCookie` instance will have a `null`
value.

The optional third parameter to `get` sets the value that should be used if a
cookie does not exist.

```php
use Tank\Cookies\ResponseCookies;

$setCookie = ResponseCookies::get($response, 'theme');
$setCookie = ResponseCookies::get($response, 'theme', 'simple');
```

#### Set a Response Cookie

The `set` method will either add a cookie or replace an existing cookie.

The `SetCookie` primitive is used as the second argument.

```php
use Tank\Cookies\ResponseCookies;

$response = ResponseCookies::set($response, SetCookie::create('token')
    ->withValue('a9s87dfz978a9')
    ->withDomain('example.com')
    ->withPath('/firewall')
);
```

#### Modify a Response Cookie

The `modify` method allows for replacing the contents of a cookie based on the
current cookie with the specified name. The third argument is a `callable` that
takes a `SetCookie` instance as its first argument and is expected to return a
`SetCookie` instance.

If no cookie by the specified name exists, a new `SetCookie` instance with a
`null` value will be passed to the callable.

```php
use Tank\Cookies\ResponseCookies;

$modify = function (SetCookie $setCookie) {
    $value = $setCookie->getValue();

    // ... inspect current $value and determine if $value should
    // change or if it can stay the same. in all cases, a cookie
    // should be returned from this callback...

    return $setCookie
        ->withValue($newValue)
        ->withExpires($newExpires)
    ;
}

$response = ResponseCookies::modify($response, 'theme', $modify);
```

#### Remove a Response Cookie

The `remove` method removes a cookie from the response if it exists.

```php
use Tank\Cookies\ResponseCookies;

$response = ResponseCookies::remove($response, 'theme');
```

#### Expire a Response Cookie

The `expire` method sets a cookie with an expiry date in the far past. This
causes the client to remove the cookie.

```php
use Tank\Cookies\ResponseCookies;

$response = ResponseCookies::expire($response, 'session_cookie');
```


FAQ
---

### Do you call `setcookies`?

No.

Delivery of the rendered `SetCookie` instances is the responsibility of the
PSR-7 client implementation.


### Do you do anything with sessions?

No.

It would be possible to build session handling using cookies on top of Tank
Cookies but it is out of scope for this package.


### Do you read from `$_COOKIES`?

No.

Tank Cookies only pays attention to the `Cookie` headers on
[PSR-7](https://packagist.org/packages/psr/http-message) Request
instances. In the case of `ServerRequestInterface` instances, PSR-7
implementations should be including `$_COOKIES` values in the headers
so in that case Tank Cookies may be interacting with `$_COOKIES`
indirectly.


License
-------

MIT, see LICENSE.