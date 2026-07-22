<?php

namespace App;

use DOMDocument;
use DOMXPath;

class XmlReader
{
    private DOMXPath $xpath;

    public function read(string $xml): array
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        $this->xpath = new DOMXPath($dom);

        return [
            'identificacao' => $this->extractIdentificacao(),
            'prestador' => $this->extractPrestador(),
            'tomador' => $this->extractTomador(),
            'destinatario' => $this->extractDestinatario(),
            'intermediario' => $this->extractIntermediario(),
            'servico' => $this->extractServico(),
            'issqn' => $this->extractIssqn(),
            'federal' => $this->extractFederal(),
            'ibscbs' => $this->extractIbsCbs(),
            'totais' => $this->extractTotais(),
            'informacoes' => $this->extractInformacoes(),
        ];
    }

    private function value(string $query, string $default = '-'): string
    {
        $node = $this->xpath->query($query);

        if ($node->length === 0) {
            return $default;
        }

        $value = trim($node->item(0)->textContent);

        return $value !== '' ? $value : $default;
    }

    private function exists(string $query): bool
    {
        return $this->xpath->query($query)->length > 0;
    }

    public function extractIdentificacao(): array
    {
        return [
            'numero' => $this->value("//*[local-name()='infNFSe']/*[local-name()='nNFSe']"),
            'numero_dfs' => $this->value("//*[local-name()='infNFSe']/*[local-name()='nDFSe']"),
            'local_emissao' => $this->value("//*[local-name()='infNFSe']/*[local-name()='xLocEmi']"),
            'local_prestacao' => $this->value("//*[local-name()='infNFSe']/*[local-name()='xLocPrestacao']"),
            'local_incidencia' => $this->value("//*[local-name()='infNFSe']/*[local-name()='xLocIncid']"),
            'codigo_municipio' => $this->value("//*[local-name()='infNFSe']/*[local-name()='cLocIncid']"),
            'data_processamento' => $this->value("//*[local-name()='infNFSe']/*[local-name()='dhProc']"),
            'status' => $this->value("//*[local-name()='infNFSe']/*[local-name()='cStat']"),
        ];
    }

    private function extractPrestador(): array
    {
        return [
            'nome' => $this->value("//*[local-name()='emit']/*[local-name()='xNome']"),
            'documento' => $this->value("//*[local-name()='emit']/*[local-name()='CNPJ']"),
            'telefone' => $this->value("//*[local-name()='emit']/*[local-name()='fone']"),
            'email' => $this->value("//*[local-name()='emit']/*[local-name()='email']"),
            'endereco_logradouro' => $this->value("//*[local-name()='emit']//*[local-name()='xLgr']"),
            'endereco_numero' => $this->value("//*[local-name()='emit']//*[local-name()='nro']"),
            'endereco_bairro' => $this->value("//*[local-name()='emit']//*[local-name()='xBairro']"),
            'endereco_municipio' => $this->value("//*[local-name()='emit']//*[local-name()='cMun']"),
            'endereco_estado' => $this->value("//*[local-name()='emit']//*[local-name()='UF']"),
            'endereco_cep' => $this->value("//*[local-name()='emit']//*[local-name()='CEP']"),
        ];
    }

    private function extractTomador(): array
    {
        return [
            'documento' => $this->value("//*[local-name()='toma']/*[local-name()='CNPJ']"),
            'nome' => $this->value("//*[local-name()='toma']/*[local-name()='xNome']"),
            'telefone' => $this->value("//*[local-name()='toma']//*[local-name()='fone']"),
            'email' => $this->value("//*[local-name()='toma']//*[local-name()='email']"),
            'endereco_logradouro' => $this->value("//*[local-name()='toma']//*[local-name()='xLgr']"),
            'endereco_numero' => $this->value("//*[local-name()='toma']//*[local-name()='nro']"),
            'endereco_complemento' => $this->value("//*[local-name()='toma']//*[local-name()='xCpl']"),
            'endereco_bairro' => $this->value("//*[local-name()='toma']//*[local-name()='xBairro']"),
            'endereco_municipio' => $this->value("//*[local-name()='toma']//*[local-name()='cMun']"),
            'endereco_cep' => $this->value("//*[local-name()='toma']//*[local-name()='CEP']"),
        ];
    }

    private function extractDestinatario(): array
    {
        return [
            'documento' => $this->value("//*[local-name()='dest']/*[local-name()='CNPJ']"),
            'nome' => $this->value("//*[local-name()='dest']/*[local-name()='xNome']"),
            'telefone' => $this->value("//*[local-name()='dest']//*[local-name()='fone']"),
            'email' => $this->value("//*[local-name()='dest']//*[local-name()='email']"),
            'endereco_logradouro' => $this->value("//*[local-name()='dest']//*[local-name()='xLgr']"),
            'endereco_numero' => $this->value("//*[local-name()='dest']//*[local-name()='nro']"),
            'endereco_complemento' => $this->value("//*[local-name()='dest']//*[local-name()='xCpl']"),
            'endereco_bairro' => $this->value("//*[local-name()='dest']//*[local-name()='xBairro']"),
            'endereco_municipio' => $this->value("//*[local-name()='dest']//*[local-name()='cMun']"),
            'endereco_estado' => $this->value("//*[local-name()='dest']//*[local-name()='UF']"),
            'endereco_cep' => $this->value("//*[local-name()='dest']//*[local-name()='CEP']"),
        ];
    }

    private function extractIntermediario(): array
    {
        return [
            'documento' => $this->value("//*[local-name()='interm']/*[local-name()='CNPJ']"),
            'nome' => $this->value("//*[local-name()='interm']/*[local-name()='xNome']"),
            'telefone' => $this->value("//*[local-name()='interm']//*[local-name()='fone']"),
            'email' => $this->value("//*[local-name()='interm']//*[local-name()='email']"),

            'inscricao_municipal' => $this->value("//*[local-name()='interm']/*[local-name()='IM']"),

            'endereco_logradouro' => $this->value("//*[local-name()='interm']//*[local-name()='xLgr']"),
            'endereco_numero' => $this->value("//*[local-name()='interm']//*[local-name()='nro']"),
            'endereco_complemento' => $this->value("//*[local-name()='interm']//*[local-name()='xCpl']"),
            'endereco_bairro' => $this->value("//*[local-name()='interm']//*[local-name()='xBairro']"),
            'endereco_municipio' => $this->value("//*[local-name()='interm']//*[local-name()='cMun']"),
            'endereco_estado' => $this->value("//*[local-name()='interm']//*[local-name()='UF']"),
            'endereco_cep' => $this->value("//*[local-name()='interm']//*[local-name()='CEP']"),
        ];
    }

    private function extractServico(): array
    {
        return [
            'codigo_tributacao' => $this->value("//*[local-name()='cServ']/*[local-name()='cTribNac']"),
            'codigo_nbs' => $this->value("//*[local-name()='cServ']/*[local-name()='cNBS']"),
            'descricao' => $this->value("//*[local-name()='cServ']/*[local-name()='xDescServ']"),
            'codigo_municipio' => $this->value("//*[local-name()='locPrest']/*[local-name()='cLocPrestacao']"),
        ];
    }

    private function extractIssqn(): array
    {
        return [
            'tipo_tributacao' => $this->value("//*[local-name()='tpTribISSQN']"),
            'municipio_incidencia' => $this->value("//*[local-name()='cLocIncid']"),
            'regime_especial' => $this->value("//*[local-name()='regEspTrib']"),
            'imunidade' => $this->value("//*[local-name()='tpImunidade']"),
            'suspensao' => $this->value("//*[local-name()='suspExig']"),
            'processo' => $this->value("//*[local-name()='nProcSusp']"),
            'beneficio' => $this->value("//*[local-name()='cBenef']"),

            'base_calculo' => $this->value("//*[local-name()='vBC']"),
            'aliquota' => $this->value("//*[local-name()='pAliqAplic']"),
            'valor' => $this->value("//*[local-name()='vISSQN']"),
            'retencao' => $this->value("//*[local-name()='tpRetISSQN']"),
            'deducoes' => $this->value("//*[local-name()='vDedRed']"),
            'desconto' => $this->value("//*[local-name()='vDescIncond']"),
        ];
    }

    private function extractFederal(): array
    {
        return [
            'irrf' => $this->value("//*[local-name()='vIRRF']"),
            'previdencia' => $this->value("//*[local-name()='vCP']"),
            'contribuicoes' => $this->value("//*[local-name()='vRetCP']"),
            'pis' => $this->value("//*[local-name()='vPIS']"),
            'cofins' => $this->value("//*[local-name()='vCOFINS']"),
            'descricao' => $this->value("//*[local-name()='xRetFed']"),
        ];
    }

    private function extractIbsCbs(): array
    {
        return [
            'cst' => $this->value("//*[local-name()='cClassTrib']"),
            'indicador_operacao' => $this->value("//*[local-name()='indOp']"),
            'municipio' => $this->value("//*[local-name()='cLocIncid']"),
            'base' => $this->value("//*[local-name()='vBCIBSCBS']"),
            'aliquota_ibs' => $this->value("//*[local-name()='pIBS']"),
            'valor_ibs' => $this->value("//*[local-name()='vIBS']"),
            'aliquota_cbs' => $this->value("//*[local-name()='pCBS']"),
            'valor_cbs' => $this->value("//*[local-name()='vCBS']"),
        ];
    }

    private function extractTotais(): array
    {
        return [
            'valor_servico' => $this->value("//*[local-name()='vServ']"),
            'desconto_incondicionado' => $this->value("//*[local-name()='vDescIncond']"),
            'desconto_condicionado' => $this->value("//*[local-name()='vDescCond']"),
            'retencoes' => $this->value("//*[local-name()='vTotRet']"),
            'valor_liquido' => $this->value("//*[local-name()='vLiq']"),
            'total_ibscbs' => $this->value("//*[local-name()='vTotIBSCBS']"),
            'valor_final' => $this->value("//*[local-name()='vLiqTotal']"),
        ];
    }

    private function extractInformacoes(): array
    {
        return [
            'informacoes_complementares' => $this->value("//*[local-name()='infAdFisco']"),
            'informacoes_municipio' => $this->value("//*[local-name()='infMun']"),
            'obra' => $this->value("//*[local-name()='cObra']"),
            'inscricao_imobiliaria' => $this->value("//*[local-name()='inscImobFisc']"),
            'evento' => $this->value("//*[local-name()='idAtvEvt']"),
            'tributos_aproximados_federal' => $this->value("//*[local-name()='vTotTribFed']"),
            'tributos_aproximados_estadual' => $this->value("//*[local-name()='vTotTribEst']"),
            'tributos_aproximados_municipal' => $this->value("//*[local-name()='vTotTribMun']"),
        ];
    }
}