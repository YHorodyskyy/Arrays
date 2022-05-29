<?php

namespace App\Render;

interface RenderInterface
{
    public function render(string $view, array $variables = []): void;
}