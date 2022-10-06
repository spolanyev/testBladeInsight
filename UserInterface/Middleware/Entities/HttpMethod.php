<?php
/**
 * @author Stanislav Polaniev <spolanyev@gmail.com>
 */

namespace TestBladeInsight;

enum HttpMethod: string
{
    case Post = 'POST';
    case Get = 'GET';
    case Put = 'PUT';
    case Delete = 'DELETE';
}
