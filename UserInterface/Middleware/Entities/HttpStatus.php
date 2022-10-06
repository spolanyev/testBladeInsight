<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

enum HttpStatus: int
{
    case OK = 200;
    case Created = 201;
    case NoContent = 204;
    case BadRequest = 400;
    case NotFound = 404;
    case MethodNotAllowed = 405;
    case InternalServerError = 500;
}
