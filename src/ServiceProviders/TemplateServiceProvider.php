<?php

namespace Anodio\Templating\ServiceProviders;

use Anodio\Core\AttributeInterfaces\ServiceProviderInterface;
use Anodio\Core\Attributes\ServiceProvider;
use Anodio\Templating\Config\TemplateConfig;

#[ServiceProvider]
class TemplateServiceProvider implements ServiceProviderInterface
{
    public function register(\DI\ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            \Twig\Environment::class => \DI\factory(function (TemplateConfig $config) {
                $loader = new \Twig\Loader\FilesystemLoader(BASE_PATH.'/'.$config->templatePath);
                return new \Twig\Environment($loader, [
                    'cache' => BASE_PATH.'/'.$config->templateCachePath,
                ]);
            })->parameter('config', \DI\get(TemplateConfig::class)),
        ]);
    }
}
