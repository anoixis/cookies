<?php

declare(strict_types=1);

namespace Anoixis\Cookies;

use DateTime;
use DateTimeInterface;
use InvalidArgumentException;
use Anoixis\Cookies\Modifier\SameSite;
use function array_shift;
use function count;
use function explode;
use function gmdate;
use function implode;
use function is_int;
use function is_numeric;
use function is_string;
use function sprintf;
use function strtolower;
use function strtotime;
use function urlencode;

class SetCookie
{
    /** @var string */
    private $name;
    /** @var string|null */
    private $value;
    /** @var int */
    private $expires = 0;
    /** @var int */
    private $maxAge = 0;
    /** @var string|null */
    private $path;
    /** @var string|null */
    private $domain;
    /** @var bool */
    private $secure = false;
    /** @var bool */
    private $httpOnly = false;
    /** @var SameSite|null */
    private $sameSite;

    private function __construct(string $name, ?string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @return static
     */
    public static function createRememberedForever(string $name, ?string $value = null): self
    {
        return static::create($name, $value)->rememberForever();
    }

    /**
     * @return $this
     */
    public function rememberForever(): self
    {
        return $this->withExpires(new DateTime('+5 years'));
    }

    /**
     * @param int|string|DateTimeInterface|null $expires
     * @return SetCookie
     */
    public function withExpires($expires = null): self
    {
        $expires = $this->resolveExpires($expires);

        $clone = clone($this);

        $clone->expires = $expires;

        return $clone;
    }

    /**
     * @param int|DateTimeInterface|string|null $expires
     * @return int
     */
    private function resolveExpires($expires = null): int
    {
        if ($expires === null) {
            return 0;
        }

        if ($expires instanceof DateTimeInterface) {
            return $expires->getTimestamp();
        }

        if (is_numeric($expires)) {
            return (int)$expires;
        }

        $time = strtotime($expires);

        if (!is_int($time)) {
            throw new InvalidArgumentException(sprintf('Invalid expires "%s" provided', $expires));
        }

        return $time;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @return static
     */
    public static function create(string $name, ?string $value = null): self
    {
        return new static($name, $value);
    }

    /**
     * @param string $name
     * @return static
     */
    public static function createExpired(string $name): self
    {
        return static::create($name)->expire();
    }

    /**
     * @return $this
     */
    public function expire(): self
    {
        return $this->withExpires(new DateTime('-5 years'));
    }

    /**
     * @param string $string
     * @return static
     */
    public static function fromSetCookieString(string $string): self
    {
        $rawAttributes = StringUtil::splitOnAttributeDelimiter($string);

        $rawAttribute = array_shift($rawAttributes);

        if (!is_string($rawAttribute)) {
            throw new InvalidArgumentException(sprintf(
                'The provided cookie string "%s" must have at least one attribute',
                $string
            ));
        }

        [$cookieName, $cookieValue] = StringUtil::splitCookiePair($rawAttribute);

        $setCookie = new static($cookieName);

        if ($cookieValue !== null) {
            $setCookie = $setCookie->withValue($cookieValue);
        }

        while ($rawAttribute = array_shift($rawAttributes)) {
            $rawAttributePair = explode('=', $rawAttribute, 2);

            $attributeKey = $rawAttributePair[0];
            $attributeValue = count($rawAttributePair) > 1 ? $rawAttributePair[1] : null;

            $attributeKey = strtolower($attributeKey);

            switch ($attributeKey) {
                case 'expires':
                    $setCookie = $setCookie->withExpires($attributeValue);
                    break;
                case 'max-age':
                    $setCookie = $setCookie->withMaxAge((int)$attributeValue);
                    break;
                case 'domain':
                    $setCookie = $setCookie->withDomain($attributeValue);
                    break;
                case 'path':
                    $setCookie = $setCookie->withPath($attributeValue);
                    break;
                case 'secure':
                    $setCookie = $setCookie->withSecure(true);
                    break;
                case 'httponly':
                    $setCookie = $setCookie->withHttpOnly(true);
                    break;
                case 'samesite':
                    $setCookie = $setCookie->withSameSite(SameSite::fromString((string)$attributeValue));
                    break;
            }
        }

        return $setCookie;
    }

    /**
     * @param string|null $value
     * @return $this
     */
    public function withValue(?string $value = null): self
    {
        $clone = clone($this);

        $clone->value = $value;

        return $clone;
    }

    /**
     * @param int|null $maxAge
     * @return $this
     */
    public function withMaxAge(?int $maxAge = null): self
    {
        $clone = clone($this);

        $clone->maxAge = (int)$maxAge;

        return $clone;
    }

    /**
     * @param string|null $domain
     * @return $this
     */
    public function withDomain(?string $domain = null): self
    {
        $clone = clone($this);

        $clone->domain = $domain;

        return $clone;
    }

    /**
     * @param string|null $path
     * @return $this
     */
    public function withPath(?string $path = null): self
    {
        $clone = clone($this);

        $clone->path = $path;

        return $clone;
    }

    /**
     * @param bool $secure
     * @return $this
     */
    public function withSecure(bool $secure = true): self
    {
        $clone = clone($this);

        $clone->secure = $secure;

        return $clone;
    }

    /**
     * @param bool $httpOnly
     * @return $this
     */
    public function withHttpOnly(bool $httpOnly = true): self
    {
        $clone = clone($this);

        $clone->httpOnly = $httpOnly;

        return $clone;
    }

    /**
     * @param SameSite $sameSite
     * @return $this
     */
    public function withSameSite(SameSite $sameSite): self
    {
        $clone = clone($this);

        $clone->sameSite = $sameSite;

        return $clone;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @return int
     */
    public function getExpires(): int
    {
        return $this->expires;
    }

    /**
     * @return int
     */
    public function getMaxAge(): int
    {
        return $this->maxAge;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @return bool
     */
    public function getSecure(): bool
    {
        return $this->secure;
    }

    /**
     * @return bool
     */
    public function getHttpOnly(): bool
    {
        return $this->httpOnly;
    }

    /**
     * @return SameSite|null
     */
    public function getSameSite(): ?SameSite
    {
        return $this->sameSite;
    }

    /**
     * @return $this
     */
    public function withoutSameSite(): self
    {
        $clone = clone($this);

        $clone->sameSite = null;

        return $clone;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $cookieStringParts = [
            urlencode($this->name) . '=' . urlencode((string)$this->value),
        ];

        $cookieStringParts = $this->appendFormattedDomainPartIfSet($cookieStringParts);
        $cookieStringParts = $this->appendFormattedPathPartIfSet($cookieStringParts);
        $cookieStringParts = $this->appendFormattedExpiresPartIfSet($cookieStringParts);
        $cookieStringParts = $this->appendFormattedMaxAgePartIfSet($cookieStringParts);
        $cookieStringParts = $this->appendFormattedSecurePartIfSet($cookieStringParts);
        $cookieStringParts = $this->appendFormattedHttpOnlyPartIfSet($cookieStringParts);
        $cookieStringParts = $this->appendFormattedSameSitePartIfSet($cookieStringParts);

        return implode('; ', $cookieStringParts);
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedDomainPartIfSet(array $cookieStringParts): array
    {
        if ($this->domain) {
            $cookieStringParts[] = sprintf('Domain=%s', $this->domain);
        }

        return $cookieStringParts;
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedPathPartIfSet(array $cookieStringParts): array
    {
        if ($this->path) {
            $cookieStringParts[] = sprintf('Path=%s', $this->path);
        }

        return $cookieStringParts;
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedExpiresPartIfSet(array $cookieStringParts): array
    {
        if ($this->expires) {
            $cookieStringParts[] = sprintf('Expires=%s', gmdate('D, d M Y H:i:s T', $this->expires));
        }

        return $cookieStringParts;
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedMaxAgePartIfSet(array $cookieStringParts): array
    {
        if ($this->maxAge) {
            $cookieStringParts[] = sprintf('Max-Age=%s', $this->maxAge);
        }

        return $cookieStringParts;
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedSecurePartIfSet(array $cookieStringParts): array
    {
        if ($this->secure) {
            $cookieStringParts[] = 'Secure';
        }

        return $cookieStringParts;
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedHttpOnlyPartIfSet(array $cookieStringParts): array
    {
        if ($this->httpOnly) {
            $cookieStringParts[] = 'HttpOnly';
        }

        return $cookieStringParts;
    }

    /**
     * @param string[] $cookieStringParts
     *
     * @return string[]
     */
    private function appendFormattedSameSitePartIfSet(array $cookieStringParts): array
    {
        if ($this->sameSite === null) {
            return $cookieStringParts;
        }

        $cookieStringParts[] = $this->sameSite->asString();

        return $cookieStringParts;
    }
}
