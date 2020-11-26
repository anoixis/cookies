<?php

declare(strict_types=1);

namespace Tank\Cookies;

use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use function is_callable;

class RequestCookies
{
    /**
     * @param RequestInterface $request
     * @param string $name
     * @param string|null $value
     * @return Cookie
     */
    public static function get(RequestInterface $request, string $name, ?string $value = null): Cookie
    {
        $cookies = Cookies::fromRequest($request);
        $cookie = $cookies->get($name);

        if ($cookie) {
            return $cookie;
        }

        return Cookie::create($name, $value);
    }

    /**
     * @param RequestInterface $request
     * @param Cookie $cookie
     * @return RequestInterface
     */
    public static function set(RequestInterface $request, Cookie $cookie): RequestInterface
    {
        return Cookies::fromRequest($request)
            ->with($cookie)
            ->renderIntoCookieHeader($request);
    }

    /**
     * @param RequestInterface $request
     * @param string $name
     * @param callable $modify
     * @return RequestInterface
     */
    public static function modify(RequestInterface $request, string $name, callable $modify): RequestInterface
    {
        if (!is_callable($modify)) {
            throw new InvalidArgumentException('$modify must be callable.');
        }

        $cookies = Cookies::fromRequest($request);
        $cookie = $modify($cookies->has($name)
            ? $cookies->get($name)
            : Cookie::create($name));

        return $cookies
            ->with($cookie)
            ->renderIntoCookieHeader($request);
    }

    /**
     * @param RequestInterface $request
     * @param string $name
     * @return RequestInterface
     */
    public static function remove(RequestInterface $request, string $name): RequestInterface
    {
        return Cookies::fromRequest($request)
            ->without($name)
            ->renderIntoCookieHeader($request);
    }
}
