<?php

namespace Anodio\Templating\Context;

use Anodio\Core\ContainerStorage;

class TemplateContext
{

    /**
     * key shouldn't be: _self, _context, _charset, _format
     * but it should starts from underscore
     * @param string $key
     * @return bool
     */
    private static function validateKey(string $key): bool
    {
        if (substr($key, 0, 1) !== '_') {
            return false;
        }
        if (in_array($key, ['_self', '_context', '_charset', '_format'])) {
            return false;
        }
        return true;
    }

    public static function addToArray(string $key, mixed $value)
    {
        if (!self::validateKey($key)) {
            throw new \InvalidArgumentException('Invalid key');
        }
        if (!ContainerStorage::getContainer()->has('templateContext')) {
            ContainerStorage::getContainer()->set('templateContext', []);
        }
        $context = ContainerStorage::getContainer()->get('templateContext');
        if (is_null($context)) {
            $context = [];
        }
        $context[$key] = $value;
        ContainerStorage::getContainer()->set('templateContext', $context);
    }

    public static function get(string $key): mixed
    {
        if (!self::validateKey($key)) {
            throw new \InvalidArgumentException('Invalid key');
        }
        if (!ContainerStorage::getContainer()->has('templateContext')) {
            ContainerStorage::getContainer()->set('templateContext', []);
        }
        $context = ContainerStorage::getContainer()->get('templateContext');
        if (is_null($context)) {
            return null;
        }
        return $context[$key] ?? null;
    }

    public static function add(string $key, mixed $value)
    {
        if (!self::validateKey($key)) {
            throw new \InvalidArgumentException('Invalid key');
        }
        if (!ContainerStorage::getContainer()->has('templateContext')) {
            ContainerStorage::getContainer()->set('templateContext', []);
        }
        $context = ContainerStorage::getContainer()->get('templateContext');
        if (is_null($context)) {
            $context = [];
        }
        $context[$key] = $value;
        ContainerStorage::getContainer()->set('templateContext', $context);
    }

    public static function all()
    {
        if (!ContainerStorage::getContainer()->has('templateContext')) {
            ContainerStorage::getContainer()->set('templateContext', []);
        }
        return ContainerStorage::getContainer()->get('templateContext');
    }
}
