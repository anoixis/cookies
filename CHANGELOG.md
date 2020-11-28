# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 2.1.0 - 2020-11-27

### Updated
- PHPUnit configuration
- Switched to Github Actions

### Replaced
- All namespaces have been changed to `Anoixis\Cookies`

### Removed
- Support for PHP 7.2

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
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookie#__construct() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\Cookie#__construct() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookie#__construct() changed from no type to string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\Cookie#__construct() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie#getName() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie#getValue() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie#withValue() changed from no type to Anoixis\Cookies\Cookie
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\Cookie#withValue() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\Cookie#withValue() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie#__toString() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie::create() changed from no type to Anoixis\Cookies\Cookie
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookie::create() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\Cookie::create() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookie::create() changed from no type to string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\Cookie::create() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie::listFromCookieString() changed from no type to array
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\Cookie::listFromCookieString() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\Cookie::listFromCookieString() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookie::oneFromCookiePair() changed from no type to Anoixis\Cookies\Cookie
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\Cookie::oneFromCookiePair() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\Cookie::oneFromCookiePair() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\FigRequestCookies::get() changed from no type to Anoixis\Cookies\Cookie
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigRequestCookies::get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\FigRequestCookies::get() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigRequestCookies::get() changed from no type to string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\FigRequestCookies::get() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\FigRequestCookies::set() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The return type of Anoixis\Cookies\FigRequestCookies::modify() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigRequestCookies::modify() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $modify of Anoixis\Cookies\FigRequestCookies::modify() changed from no type to a non-contravariant callable
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigRequestCookies::modify() changed from no type to string
    [BC] CHANGED: The parameter $modify of Anoixis\Cookies\FigRequestCookies::modify() changed from no type to callable
    [BC] CHANGED: The return type of Anoixis\Cookies\FigRequestCookies::remove() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigRequestCookies::remove() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigRequestCookies::remove() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies#has() changed from no type to bool
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookies#has() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookies#has() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies#get() changed from no type to ?Anoixis\Cookies\SetCookie
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookies#get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookies#get() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies#getAll() changed from no type to array
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies#with() changed from no type to Anoixis\Cookies\SetCookies
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies#without() changed from no type to Anoixis\Cookies\SetCookies
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookies#without() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookies#without() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies#renderIntoSetCookieHeader() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies::fromSetCookieStrings() changed from no type to self
    [BC] CHANGED: The parameter $setCookieStrings of Anoixis\Cookies\SetCookies::fromSetCookieStrings() changed from no type to a non-contravariant array
    [BC] CHANGED: The parameter $setCookieStrings of Anoixis\Cookies\SetCookies::fromSetCookieStrings() changed from no type to array
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookies::fromResponse() changed from no type to Anoixis\Cookies\SetCookies
    [BC] CHANGED: The return type of Anoixis\Cookies\StringUtil::splitOnAttributeDelimiter() changed from no type to array
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\StringUtil::splitOnAttributeDelimiter() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\StringUtil::splitOnAttributeDelimiter() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\StringUtil::splitCookiePair() changed from no type to array
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\StringUtil::splitCookiePair() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\StringUtil::splitCookiePair() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getName() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getValue() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getExpires() changed from no type to int
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getMaxAge() changed from no type to int
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getPath() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getDomain() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getSecure() changed from no type to bool
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#getHttpOnly() changed from no type to bool
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withValue() changed from no type to self
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\SetCookie#withValue() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\SetCookie#withValue() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withExpires() changed from no type to self
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#rememberForever() changed from no type to self
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#expire() changed from no type to self
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withMaxAge() changed from no type to self
    [BC] CHANGED: The parameter $maxAge of Anoixis\Cookies\SetCookie#withMaxAge() changed from no type to a non-contravariant ?int
    [BC] CHANGED: The parameter $maxAge of Anoixis\Cookies\SetCookie#withMaxAge() changed from no type to ?int
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withPath() changed from no type to self
    [BC] CHANGED: The parameter $path of Anoixis\Cookies\SetCookie#withPath() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $path of Anoixis\Cookies\SetCookie#withPath() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withDomain() changed from no type to self
    [BC] CHANGED: The parameter $domain of Anoixis\Cookies\SetCookie#withDomain() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $domain of Anoixis\Cookies\SetCookie#withDomain() changed from no type to ?string
    [BC] CHANGED: Default parameter value for for parameter $secure of Anoixis\Cookies\SetCookie#withSecure() changed from NULL to true
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withSecure() changed from no type to self
    [BC] CHANGED: The parameter $secure of Anoixis\Cookies\SetCookie#withSecure() changed from no type to a non-contravariant bool
    [BC] CHANGED: The parameter $secure of Anoixis\Cookies\SetCookie#withSecure() changed from no type to bool
    [BC] CHANGED: Default parameter value for for parameter $httpOnly of Anoixis\Cookies\SetCookie#withHttpOnly() changed from NULL to true
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#withHttpOnly() changed from no type to self
    [BC] CHANGED: The parameter $httpOnly of Anoixis\Cookies\SetCookie#withHttpOnly() changed from no type to a non-contravariant bool
    [BC] CHANGED: The parameter $httpOnly of Anoixis\Cookies\SetCookie#withHttpOnly() changed from no type to bool
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie#__toString() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie::create() changed from no type to self
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookie::create() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\SetCookie::create() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookie::create() changed from no type to string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\SetCookie::create() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie::createRememberedForever() changed from no type to self
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookie::createRememberedForever() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\SetCookie::createRememberedForever() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookie::createRememberedForever() changed from no type to string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\SetCookie::createRememberedForever() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie::createExpired() changed from no type to self
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookie::createExpired() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\SetCookie::createExpired() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\SetCookie::fromSetCookieString() changed from no type to self
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\SetCookie::fromSetCookieString() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\SetCookie::fromSetCookieString() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\FigResponseCookies::get() changed from no type to Anoixis\Cookies\SetCookie
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigResponseCookies::get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\FigResponseCookies::get() changed from no type to a non-contravariant ?string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigResponseCookies::get() changed from no type to string
    [BC] CHANGED: The parameter $value of Anoixis\Cookies\FigResponseCookies::get() changed from no type to ?string
    [BC] CHANGED: The return type of Anoixis\Cookies\FigResponseCookies::set() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The return type of Anoixis\Cookies\FigResponseCookies::expire() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The parameter $cookieName of Anoixis\Cookies\FigResponseCookies::expire() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $cookieName of Anoixis\Cookies\FigResponseCookies::expire() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\FigResponseCookies::modify() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigResponseCookies::modify() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $modify of Anoixis\Cookies\FigResponseCookies::modify() changed from no type to a non-contravariant callable
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigResponseCookies::modify() changed from no type to string
    [BC] CHANGED: The parameter $modify of Anoixis\Cookies\FigResponseCookies::modify() changed from no type to callable
    [BC] CHANGED: The return type of Anoixis\Cookies\FigResponseCookies::remove() changed from no type to Psr\Http\Message\ResponseInterface
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigResponseCookies::remove() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\FigResponseCookies::remove() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies#has() changed from no type to bool
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookies#has() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookies#has() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies#get() changed from no type to ?Anoixis\Cookies\Cookie
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookies#get() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookies#get() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies#getAll() changed from no type to array
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies#with() changed from no type to Anoixis\Cookies\Cookies
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies#without() changed from no type to Anoixis\Cookies\Cookies
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookies#without() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $name of Anoixis\Cookies\Cookies#without() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies#renderIntoCookieHeader() changed from no type to Psr\Http\Message\RequestInterface
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies::fromCookieString() changed from no type to self
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\Cookies::fromCookieString() changed from no type to a non-contravariant string
    [BC] CHANGED: The parameter $string of Anoixis\Cookies\Cookies::fromCookieString() changed from no type to string
    [BC] CHANGED: The return type of Anoixis\Cookies\Cookies::fromRequest() changed from no type to Anoixis\Cookies\Cookies
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
  be constructed via `Anoixis\Cookies\SetCookie::fromSetCookieString('')`: an empty string
  will now be rejected.
