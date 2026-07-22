<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use App\DanfseRenderer;
use App\XmlReader;

$xmlFile = __DIR__.'/../xml/nfse.xml';

if (!file_exists($xmlFile)) {
    die("XML não encontrado em:<br>{$xmlFile}");
}

$xml = file_get_contents($xmlFile);
$reader = new XmlReader();
$dados = $reader->read($xml);

$renderer = new DanfseRenderer();

echo $renderer->render($dados);