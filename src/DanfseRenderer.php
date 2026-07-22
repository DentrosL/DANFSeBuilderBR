<?php

namespace App;

class DanfseRenderer
{
    public function render(array $dados): string
    {
        return $this->buildHtml($dados);
    }

    private function buildHtml(array $dados): string
    {
        ob_start();

        require __DIR__.'/../public/layout.php';

        return ob_get_clean();
    }
}