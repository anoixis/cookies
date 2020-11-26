<?php

declare(strict_types=1);

namespace Tank\Cookies;

use Psr\Http\Message\ResponseInterface;

class TankCookieTestingResponse implements ResponseInterface
{
    use CookieTestingMessage;

    public function getStatusCode() : void
    {
        throw new \RuntimeException('This method has not been implemented.');
    }

    /** {@inheritDoc} */
    public function withStatus($code, $reasonPhrase = '') : void
    {
        throw new \RuntimeException('This method has not been implemented.');
    }

    public function getReasonPhrase() : void
    {
        throw new \RuntimeException('This method has not been implemented.');
    }
}
