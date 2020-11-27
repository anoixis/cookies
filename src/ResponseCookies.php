<?php

declare(strict_types=1);

namespace Anoixis\Cookies;

use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use function is_callable;

class ResponseCookies
{
    /**
     * @param ResponseInterface $response
     * @param string $name
     * @param string|null $value
     * @return SetCookie
     */
    public static function get(ResponseInterface $response, string $name, ?string $value = null): SetCookie
    {
        $setCookies = SetCookies::fromResponse($response);
        $cookie = $setCookies->get($name);

        if ($cookie) {
            return $cookie;
        }

        return SetCookie::create($name, $value);
    }

    /**
     * @param ResponseInterface $response
     * @param string $cookieName
     * @return ResponseInterface
     */
    public static function expire(ResponseInterface $response, string $cookieName): ResponseInterface
    {
        return static::set($response, SetCookie::createExpired($cookieName));
    }

    /**
     * @param ResponseInterface $response
     * @param SetCookie $setCookie
     * @return ResponseInterface
     */
    public static function set(ResponseInterface $response, SetCookie $setCookie): ResponseInterface
    {
        return SetCookies::fromResponse($response)
            ->with($setCookie)
            ->renderIntoSetCookieHeader($response);
    }

    /**
     * @param ResponseInterface $response
     * @param string $name
     * @param callable $modify
     * @return ResponseInterface
     */
    public static function modify(ResponseInterface $response, string $name, callable $modify): ResponseInterface
    {
        if (!is_callable($modify)) {
            throw new InvalidArgumentException('$modify must be callable.');
        }

        $setCookies = SetCookies::fromResponse($response);
        $setCookie = $modify($setCookies->has($name)
            ? $setCookies->get($name)
            : SetCookie::create($name));

        return $setCookies
            ->with($setCookie)
            ->renderIntoSetCookieHeader($response);
    }

    /**
     * @param ResponseInterface $response
     * @param string $name
     * @return ResponseInterface
     */
    public static function remove(ResponseInterface $response, string $name): ResponseInterface
    {
        return SetCookies::fromResponse($response)
            ->without($name)
            ->renderIntoSetCookieHeader($response);
    }
}
