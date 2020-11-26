# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 2.0.0 - 2018-07-11

### Added

- [#32](https://github.com/dflydev/dflydev-fig-cookies/pull/32) all public API of the
  project now has extensive parameter and return type declarations.
  If you are using the library with `declare(strict_types=1);` in your codebase, you
  will need to run static analysis against your code to find possible type incompatibilities
  in method calls.
  If you are inheriting any of your code from this library, you will need to check
  that your type signatures respect variance and covariance with the symbols you are
  inheriting from. Here is a full list of the changes:
    ```
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookie#__construct() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Tank\Cookies\Cookie#__construct() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookie#__construct() changed from no type to string
    [BC] CHANGED: The parameter $value of Tank\Cookies\Cookie#__construct() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie#getName() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie#getValue() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie#withValue() changed from no type to Tank\Cookies\Cookie
    [BC] CHANGED: The parameter $value of Tank\Cookies\Cookie#withValue() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $value of Tank\Cookies\Cookie#withValue() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie#__toString() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie::create() changed from no type to Tank\Cookies\Cookie
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookie::create() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Tank\Cookies\Cookie::create() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookie::create() changed from no type to string
    [BC] CHANGED: The parameter $value of Tank\Cookies\Cookie::create() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie::listFromCookieString() changed from no type to array
    [BC] CHANGED: The parameter $string of Tank\Cookies\Cookie::listFromCookieString() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Tank\Cookies\Cookie::listFromCookieString() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookie::oneFromCookiePair() changed from no type to Tank\Cookies\Cookie
    [BC] CHANGED: The parameter $string of Tank\Cookies\Cookie::oneFromCookiePair() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Tank\Cookies\Cookie::oneFromCookiePair() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\FigRequestCookies::get() changed from no type to Tank\Cookies\Cookie
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigRequestCookies::get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Tank\Cookies\FigRequestCookies::get() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigRequestCookies::get() changed from no type to string
    [BC] CHANGED: The parameter $value of Tank\Cookies\FigRequestCookies::get() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\FigRequestCookies::set() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The return type of Tank\Cookies\FigRequestCookies::modify() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigRequestCookies::modify() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $modify of Tank\Cookies\FigRequestCookies::modify() changed from no type to a non-contravariant callable
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigRequestCookies::modify() changed from no type to string
    [BC] CHANGED: The parameter $modify of Tank\Cookies\FigRequestCookies::modify() changed from no type to callable
    [BC] CHANGED: The return type of Tank\Cookies\FigRequestCookies::remove() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigRequestCookies::remove() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigRequestCookies::remove() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies#has() changed from no type to bool
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookies#has() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookies#has() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies#get() changed from no type to ?Tank\Cookies\SetCookie
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookies#get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookies#get() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies#getAll() changed from no type to array
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies#with() changed from no type to Tank\Cookies\SetCookies
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies#without() changed from no type to Tank\Cookies\SetCookies
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookies#without() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookies#without() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies#renderIntoSetCookieHeader() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies::fromSetCookieStrings() changed from no type to self
    [BC] CHANGED: The parameter $setCookieStrings of Tank\Cookies\SetCookies::fromSetCookieStrings() changed from no type to a non-contravariant array
    [BC] CHANGED: The parameter $setCookieStrings of Tank\Cookies\SetCookies::fromSetCookieStrings() changed from no type to array
    [BC] CHANGED: The return type of Tank\Cookies\SetCookies::fromResponse() changed from no type to Tank\Cookies\SetCookies
    [BC] CHANGED: The return type of Tank\Cookies\StringUtil::splitOnAttributeDelimiter() changed from no type to array
    [BC] CHANGED: The parameter $string of Tank\Cookies\StringUtil::splitOnAttributeDelimiter() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Tank\Cookies\StringUtil::splitOnAttributeDelimiter() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\StringUtil::splitCookiePair() changed from no type to array
    [BC] CHANGED: The parameter $string of Tank\Cookies\StringUtil::splitCookiePair() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Tank\Cookies\StringUtil::splitCookiePair() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getName() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getValue() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getExpires() changed from no type to int
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getMaxAge() changed from no type to int
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getPath() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getDomain() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getSecure() changed from no type to bool
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#getHttpOnly() changed from no type to bool
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withValue() changed from no type to self
    [BC] CHANGED: The parameter $value of Tank\Cookies\SetCookie#withValue() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $value of Tank\Cookies\SetCookie#withValue() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withExpires() changed from no type to self
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#rememberForever() changed from no type to self
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#expire() changed from no type to self
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withMaxAge() changed from no type to self
    [BC] CHANGED: The parameter $maxAge of Tank\Cookies\SetCookie#withMaxAge() changed from no type to a non-contravariant ?int
    [BC] CHANGED: The parameter $maxAge of Tank\Cookies\SetCookie#withMaxAge() changed from no type to ?int
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withPath() changed from no type to self
    [BC] CHANGED: The parameter $path of Tank\Cookies\SetCookie#withPath() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $path of Tank\Cookies\SetCookie#withPath() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withDomain() changed from no type to self
    [BC] CHANGED: The parameter $domain of Tank\Cookies\SetCookie#withDomain() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $domain of Tank\Cookies\SetCookie#withDomain() changed from no type to ?string
    [BC] CHANGED: Default parameter value for for parameter $secure of Tank\Cookies\SetCookie#withSecure() changed from NULL to true
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withSecure() changed from no type to self
    [BC] CHANGED: The parameter $secure of Tank\Cookies\SetCookie#withSecure() changed from no type to a non-contravariant bool
    [BC] CHANGED: The parameter $secure of Tank\Cookies\SetCookie#withSecure() changed from no type to bool
    [BC] CHANGED: Default parameter value for for parameter $httpOnly of Tank\Cookies\SetCookie#withHttpOnly() changed from NULL to true
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#withHttpOnly() changed from no type to self
    [BC] CHANGED: The parameter $httpOnly of Tank\Cookies\SetCookie#withHttpOnly() changed from no type to a non-contravariant bool
    [BC] CHANGED: The parameter $httpOnly of Tank\Cookies\SetCookie#withHttpOnly() changed from no type to bool
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie#__toString() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie::create() changed from no type to self
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookie::create() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Tank\Cookies\SetCookie::create() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookie::create() changed from no type to string
    [BC] CHANGED: The parameter $value of Tank\Cookies\SetCookie::create() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie::createRememberedForever() changed from no type to self
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookie::createRememberedForever() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Tank\Cookies\SetCookie::createRememberedForever() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookie::createRememberedForever() changed from no type to string
    [BC] CHANGED: The parameter $value of Tank\Cookies\SetCookie::createRememberedForever() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie::createExpired() changed from no type to self
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookie::createExpired() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\SetCookie::createExpired() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\SetCookie::fromSetCookieString() changed from no type to self
    [BC] CHANGED: The parameter $string of Tank\Cookies\SetCookie::fromSetCookieString() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Tank\Cookies\SetCookie::fromSetCookieString() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\FigResponseCookies::get() changed from no type to Tank\Cookies\SetCookie
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigResponseCookies::get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Tank\Cookies\FigResponseCookies::get() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigResponseCookies::get() changed from no type to string
    [BC] CHANGED: The parameter $value of Tank\Cookies\FigResponseCookies::get() changed from no type to ?string
    [BC] CHANGED: The return type of Tank\Cookies\FigResponseCookies::set() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The return type of Tank\Cookies\FigResponseCookies::expire() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The parameter $cookieName of Tank\Cookies\FigResponseCookies::expire() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $cookieName of Tank\Cookies\FigResponseCookies::expire() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\FigResponseCookies::modify() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigResponseCookies::modify() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $modify of Tank\Cookies\FigResponseCookies::modify() changed from no type to a non-contravariant callable
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigResponseCookies::modify() changed from no type to string
    [BC] CHANGED: The parameter $modify of Tank\Cookies\FigResponseCookies::modify() changed from no type to callable
    [BC] CHANGED: The return type of Tank\Cookies\FigResponseCookies::remove() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigResponseCookies::remove() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\FigResponseCookies::remove() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookies#has() changed from no type to bool
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookies#has() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookies#has() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookies#get() changed from no type to ?Tank\Cookies\Cookie
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookies#get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookies#get() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookies#getAll() changed from no type to array
    [BC] CHANGED: The return type of Tank\Cookies\Cookies#with() changed from no type to Tank\Cookies\Cookies
    [BC] CHANGED: The return type of Tank\Cookies\Cookies#without() changed from no type to Tank\Cookies\Cookies
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookies#without() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Tank\Cookies\Cookies#without() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookies#renderIntoCookieHeader() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The return type of Tank\Cookies\Cookies::fromCookieString() changed from no type to self
    [BC] CHANGED: The parameter $string of Tank\Cookies\Cookies::fromCookieString() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Tank\Cookies\Cookies::fromCookieString() changed from no type to string
    [BC] CHANGED: The return type of Tank\Cookies\Cookies::fromRequest() changed from no type to Tank\Cookies\Cookies
    ```
    
- [#31](https://github.com/dflydev/dflydev-fig-cookies/pull/31) A new abstraction was
  introduced to support `SameSite=Lax` and `SameSite=Strict` `Set-Cookie` header modifiers.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#32](https://github.com/dflydev/dflydev-fig-cookies/pull/32) `SetCookie#withExpires()`
  will now reject any expiry time that cannot be parsed into a timestamp.
- [#32](https://github.com/dflydev/dflydev-fig-cookies/pull/32) A `SetCookie` can no longer
  be constructed via `Tank\Cookies\SetCookie::fromSetCookieString('')`: an empty string
  will now be rejected.
