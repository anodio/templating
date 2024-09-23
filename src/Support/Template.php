<?php

namespace Anodio\Templating\Support;

use Anodio\Core\ContainerStorage;

class Template
{
    private string $rendered;

    private function __construct(string $rendered)
    {
        $this->rendered = $rendered;
    }

    public static function render(string $template, array $data = []): self
    {
        $twig = ContainerStorage::getContainer()->get(\Twig\Environment::class);
        $rendered = $twig->render($template, $data);
        return new self($rendered);
    }

    public function getRenderedBody(): string
    {
        return $this->rendered;
    }
}
