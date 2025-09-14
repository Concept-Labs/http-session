<?php

namespace Concept\HttpSession;

use Concept\Config\Contract\ConfigurableTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class SessionMiddleware implements SessionMiddlewareInterface
{
    use ConfigurableTrait;

    /**
     * A middleware that manages PHP sessions.
     *
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Start or resume the session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $request = $request->withAttribute('session', $_SESSION);

        $response = $handler->handle($request);

        // Commit session data
        $_SESSION = $request->getAttribute('session', $_SESSION);

        return $response;
    }
}
