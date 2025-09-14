<?php
namespace Concept\HttpSession;

use Concept\Config\Contract\ConfigurableInterface;
use Psr\Http\Server\MiddlewareInterface;

interface SessionMiddlewareInterface extends MiddlewareInterface, ConfigurableInterface
{
}