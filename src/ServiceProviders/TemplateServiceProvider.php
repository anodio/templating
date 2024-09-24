<?php

namespace Anodio\Templating\ServiceProviders;

use Anodio\Core\AttributeInterfaces\ServiceProviderInterface;
use Anodio\Core\Attributes\ServiceProvider;
use Anodio\Http\Config\WorkerConfig;
use Anodio\Templating\Config\TemplateConfig;

#[ServiceProvider]
class TemplateServiceProvider implements ServiceProviderInterface
{
    public function register(\DI\ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->addDefinitions([
            \Twig\Environment::class => \DI\factory(function (TemplateConfig $config, WorkerConfig $workerConfig) {
                $loader = new \Twig\Loader\FilesystemLoader(BASE_PATH.'/'.$config->templatePath);
                return new \Twig\Environment($loader, [
                    'auto_reload' => $config->autoReload || $workerConfig->devMode,
                    'cache' => BASE_PATH.'/'.$config->templateCachePath,
                ]);
            })->parameter('config', \DI\get(TemplateConfig::class))->parameter('workerConfig', \DI\get(WorkerConfig::class)),
        ]);
    }
}
