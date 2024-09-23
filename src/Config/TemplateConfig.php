<?php

namespace Anodio\Templating\Config;

use Anodio\Core\AttributeInterfaces\AbstractConfig;
use Anodio\Core\Attributes\Config;
use Anodio\Core\Configuration\Env;

#[Config('templating')]
class TemplateConfig extends AbstractConfig
{
    #[Env('TEMPLATE_PATH', 'views')]
    public string $templatePath;

    #[Env('TEMPLATE_CACHE_PATH', 'cache')]
    public string $templateCachePath;
}
