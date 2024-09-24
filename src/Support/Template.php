<?php

namespace Anodio\Templating\Support;

use Anodio\Core\ContainerStorage;
use Anodio\Templating\Context\TemplateContext;
use Anodio\Templating\Events\BeforeTemplateRenderedEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Twig\Environment;

class Template
{
    private string $rendered;

    private function __construct(string $rendered)
    {
        $this->rendered = $rendered;
    }

    public static function render(string $template, array $data = []): self
    {
        $twig = ContainerStorage::getContainer()->get(Environment::class);
        $dispatcher = ContainerStorage::getContainer()->get(EventDispatcher::class);
        $dispatcher->dispatch(new BeforeTemplateRenderedEvent(), 'before_template_rendered');
        $context = TemplateContext::all();
        if (!is_null($context)) {
            $data = array_merge($context, $data);
        }
        $rendered = $twig->render($template, $data);
        return new self($rendered);
    }

    public function getRenderedBody(): string
    {
        return $this->rendered;
    }
}
