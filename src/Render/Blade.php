<?php

namespace App\Render;

use App\Config;
use eftec\bladeone\BladeOne;

class Blade implements RenderInterface
{
    protected BladeOne $blade;

    public function __construct()
    {
        $template = (new Config())->template;
        $this->blade = new BladeOne($template['views'], $template['cache'], BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
    }

    public function render(string $view, array $variables = []): void
    {
        echo $this->blade->run($view, $variables);
    }
}