<?php

declare(strict_types=1);

namespace Tank\Cookies;

use PHPUnit\Framework\TestCase;
use function strtoupper;

class TankRequestCookiesTest extends TestCase
{
    /**
     * @test
     */
    public function it_gets_cookies() : void
    {
        $request = (new TankCookieTestingRequest())
            ->withHeader(Cookies::COOKIE_HEADER, 'theme=light; sessionToken=RAPELCGRQ; hello=world')
        ;

        self::assertEquals(
            'RAPELCGRQ',
            RequestCookies::get($request, 'sessionToken')->getValue()
        );
    }

    /**
     * @test
     */
    public function it_sets_cookies() : void
    {
        $request = (new TankCookieTestingRequest())
            ->withHeader(Cookies::COOKIE_HEADER, 'theme=light; sessionToken=RAPELCGRQ; hello=world')
        ;

        $request = RequestCookies::set($request, Cookie::create('hello', 'WORLD!'));

        self::assertEquals(
            'theme=light; sessionToken=RAPELCGRQ; hello=WORLD%21',
            $request->getHeaderLine('Cookie')
        );
    }

    /**
     * @test
     */
    public function it_modifies_cookies() : void
    {
        $request = (new TankCookieTestingRequest())
            ->withHeader(Cookies::COOKIE_HEADER, 'theme=light; sessionToken=RAPELCGRQ; hello=world')
        ;

        $request = RequestCookies::modify($request, 'hello', function (Cookie $cookie) {
            return $cookie->withValue(strtoupper($cookie->getName()));
        });

        self::assertEquals(
            'theme=light; sessionToken=RAPELCGRQ; hello=HELLO',
            $request->getHeaderLine('Cookie')
        );
    }

    /**
     * @test
     */
    public function it_removes_cookies() : void
    {
        $request = (new TankCookieTestingRequest())
            ->withHeader(Cookies::COOKIE_HEADER, 'theme=light; sessionToken=RAPELCGRQ; hello=world')
        ;

        $request = RequestCookies::remove($request, 'sessionToken');

        self::assertEquals(
            'theme=light; hello=world',
            $request->getHeaderLine('Cookie')
        );
    }
}
