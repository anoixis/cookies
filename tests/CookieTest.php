<?php

declare(strict_types=1);

namespace Anoixis\Cookies;

use PHPUnit\Framework\TestCase;
use function count;

class CookieTest extends TestCase
{
    /**
     * @param string $cookieString
     * @param string $expectedName
     * @param string|null $expectedValue
     *
     * @test
     * @dataProvider provideParsesOneFromCookieStringData
     */
    public function it_parses_one_from_cookie_string(string $cookieString, string $expectedName, ?string $expectedValue
    ): void
    {
        $cookie = Cookie::oneFromCookiePair($cookieString);

        self::assertCookieNameAndValue($cookie, $expectedName, $expectedValue);
    }

    private function assertCookieNameAndValue(Cookie $cookie, string $expectedName, ?string $expectedValue): void
    {
        self::assertEquals($expectedName, $cookie->getName());
        self::assertEquals($expectedValue, $cookie->getValue());
    }

    /**
     * @param string $cookieString
     * @param string[] $expectedNameValuePairs
     *
     * @test
     * @dataProvider provideParsesListFromCookieString
     */
    public function it_parses_list_from_cookie_string(string $cookieString, array $expectedNameValuePairs): void
    {
        $cookies = Cookie::listFromCookieString($cookieString);

        self::assertCount(count($expectedNameValuePairs), $cookies);

        for ($i = 0; $i < count($cookies); $i++) {
            $cookie = $cookies[$i];
            list ($expectedName, $expectedValue) = $expectedNameValuePairs[$i];

            self::assertCookieNameAndValue($cookie, $expectedName, $expectedValue);
        }
    }

    /** @return string[][] */
    public function provideParsesOneFromCookieStringData(): array
    {
        return [
            ['someCookie=something', 'someCookie', 'something'],
            ['hello%3Dworld=how%22are%27you', 'hello=world', 'how"are\'you'],
            ['empty=', 'empty', ''],
        ];
    }

    /** @return string[][]|string[][][][] */
    public function provideParsesListFromCookieString(): array
    {
        return [
            [
                'theme=light; sessionToken=abc123',
                [
                    ['theme', 'light'],
                    ['sessionToken', 'abc123'],
                ],
            ],

            [
                'theme=light; sessionToken=abc123;',
                [
                    ['theme', 'light'],
                    ['sessionToken', 'abc123'],
                ],
            ],
        ];
    }
}
