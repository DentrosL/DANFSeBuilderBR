<?php

namespace App;

use DOMDocument;
use DOMXPath;
// vou refatorar, 
class DanfseRenderer
{
    public function render(string $xml): string
    {
        // $data = $this->extractDocumentData($xml);
        // $html = $this->buildHtml($data);

        // $options = new Options;
        // $options->set('isRemoteEnabled', false);
        // $options->set('defaultFont', 'DejaVu Sans');
        // $options->set('isHtml5ParserEnabled', true);

        // $dompdf = new Dompdf($options);
        // $dompdf->loadHtml($html, 'UTF-8');
        // $dompdf->setPaper('A4', 'portrait');
        // $dompdf->render();

        // return $dompdf->output();

        $dados = $this->extractDocumentData($xml);

        return $this->buildHtml($dados);
    }

    private function value(DOMXPath $xpath, string $expression): string
    {
        $node = $xpath->query($expression);

        if (!$node || $node->length === 0) { return ''; }

        return trim($node->item(0)->textContent);
    }

    private function extractIdentificacao(DOMXPath $xpath): array
    {
        return [
            'numero_nfse'   => $this->value($xpath, "//*[local-name()='nNFSe']"),
            'competencia'   => $this->value($xpath, "//*[local-name()='dhCompet']"),
            'emissao_nfse'  => $this->value($xpath, "//*[local-name()='dhEmi']"),
            'municipio'     => $this->value($xpath, "//*[local-name()='xMun']")
        ];
    }

    private function extractPrestador(DOMXPath $xpath): array
    {
        return [
            'nome'=>$this->value($xpath,"//*[local-name()='prest']/*[local-name()='xNome']"),
            'documento'=>$this->value($xpath,"//*[local-name()='prest']/*[local-name()='CNPJ']"),
            'telefone'=>$this->value($xpath,"//*[local-name()='prest']/*[local-name()='fone']"),
            'municipio'=>$this->value($xpath,"//*[local-name()='prest']/*[local-name()='end']/*[local-name()='xMun']")
        ];
    }

    private function extractDocumentData(string $xml): array
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $xpath = new DOMXPath($dom);

        return [
            'identificacao'=>$this->extractIdentificacao($xpath),
            'prestador'=>$this->extractPrestador($xpath),
            // 'tomador'=>$this->extractTomador($xpath),
            // 'destinatario'=>$this->extractDestinatario($xpath),
            // 'intermediario'=>$this->extractIntermediario($xpath),
            // 'servico'=>$this->extractServico($xpath),
            // 'issqn'=>$this->extractIssqn($xpath),
            // 'federal'=>$this->extractFederal($xpath),
            // 'ibscbs'=>$this->extractIbsCbs($xpath),
            // 'totais'=>$this->extractTotais($xpath),
            // 'informacoes'=>$this->extractInformacoes($xpath)
        ];
    }

    private function buildHtml(array $dados): string
    {
        ob_start();

        require __DIR__ . '/../public/layout.php';

        return ob_get_clean();
    }
}