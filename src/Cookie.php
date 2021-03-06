<?php

declare(strict_types=1);

namespace Anoixis\Cookies;

use function array_map;
use function urlencode;

class Cookie
{
    /** @var string */
    private $name;

    /** @var string|null */
    private $value;

    public function __construct(string $name, ?string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Create a Cookie.
     * @param string $name
     * @param string|null $value
     * @return Cookie
     */
    public static function create(string $name, ?string $value = null): Cookie
    {
        return new static($name, $value);
    }

    /**
     * Create a list of Cookies from a Cookie header value string.
     *
     * @param string $string
     * @return Cookie[]
     */
    public static function listFromCookieString(string $string): array
    {
        $cookies = StringUtil::splitOnAttributeDelimiter($string);

        return array_map(static function ($cookiePair) {
            return static::oneFromCookiePair($cookiePair);
        }, $cookies);
    }

    /**
     * Create one Cookie from a cookie key/value header value string.
     * @param string $string
     * @return Cookie
     */
    public static function oneFromCookiePair(string $string): Cookie
    {
        [$cookieName, $cookieValue] = StringUtil::splitCookiePair($string);

        $cookie = new static($cookieName);

        if ($cookieValue !== null) {
            $cookie = $cookie->withValue($cookieValue);
        }

        return $cookie;
    }

    public function withValue(?string $value = null): Cookie
    {
        $clone = clone($this);

        $clone->value = $value;

        return $clone;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Render Cookie as a string.
     *
     */
    public function __toString(): string
    {
        return urlencode($this->name) . '=' . urlencode((string)$this->value);
    }
}
