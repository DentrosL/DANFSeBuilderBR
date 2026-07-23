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
            'prestador'     => $this->extractPrestador(),
            'tomador'       => $this->extractTomador(),
            'destinatario'  => $this->extractDestinatario(),
            'intermediario' => $this->extractIntermediario(),
            'servico'       => $this->extractServico(),
            'issqn'         => $this->extractIssqn(),
            'federal'       => $this->extractFederal(),
            'ibscbs'        => $this->extractIbsCbs(),
            'totais'        => $this->extractTotais(),
            'informacoes'   => $this->extractInformacoes(),
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
            'numero_nfse'                   => $this->value("//*[local-name()='infNFSe']/*[local-name()='nNFSe']"),
            'numero_dps'                    => $this->value("//*[local-name()='infNFSe']/*[local-name()='nDFSe']"),
            'chave'                         => $this->value("//*[local-name()='infNFSe']/*[local-name()='chNFSe']"),
            'competencia'                   => $this->value("//*[local-name()='infNFSe']/*[local-name()='dtCompet']"),
            'emissao_nfse'                  => $this->value("//*[local-name()='infNFSe']/*[local-name()='dhProc']"),
            'serie_dps'                     => $this->value("//*[local-name()='infDPS']/*[local-name()='serie']"),
            'emissao_dps'                   => $this->value("//*[local-name()='infDPS']/*[local-name()='dhEmi']"),
            'municipio'                     => $this->value("//*[local-name()='xLocPrestacao']"),
            'ambiente'                      => $this->value("//*[local-name()='tpAmb']"),
            'ambiente_gerador'              => $this->value("//*[local-name()='ambGer']"),
            'status'                        => $this->value("//*[local-name()='cStat']"),
            'finalidade'                    => $this->value("//*[local-name()='finNFSe']")
        ];
    }

    private function extractPrestador(): array
    {
        return [
            'nome'                          => $this->value("//*[local-name()='emit']/*[local-name()='xNome']"),
            'documento'                     => $this->value("//*[local-name()='emit']/*[local-name()='CNPJ']"),
            'inscricao_municipal'           => $this->value("//*[local-name()='emit']/*[local-name()='IM']"),
            'telefone'                      => $this->value("//*[local-name()='emit']/*[local-name()='fone']"),
            'email'                         => $this->value("//*[local-name()='emit']/*[local-name()='email']"),
            'endereco_logradouro'           => $this->value("//*[local-name()='emit']//*[local-name()='xLgr']"),
            'endereco_numero'               => $this->value("//*[local-name()='emit']//*[local-name()='nro']"),
            'endereco_complemento'          => $this->value("//*[local-name()='emit']//*[local-name()='xCpl']"),
            'endereco_bairro'               => $this->value("//*[local-name()='emit']//*[local-name()='xBairro']"),
            'endereco_municipio'            => $this->value("//*[local-name()='emit']//*[local-name()='xMun']"),
            'endereco_estado'               => $this->value("//*[local-name()='emit']//*[local-name()='UF']"),
            'endereco_cep'                  => $this->value("//*[local-name()='emit']//*[local-name()='CEP']"),
            'simples_nacional'              => $this->value("//*[local-name()='regTrib']/*[local-name()='opSimpNac']"),
            'regime_apuracao'               => $this->value("//*[local-name()='regTrib']/*[local-name()='regApTribSN']"),
        ];
    }

    private function extractTomador(): array
    {
        return [
            'documento'                     => $this->value("//*[local-name()='toma']/*[local-name()='CNPJ']"),
            'nome'                          => $this->value("//*[local-name()='toma']/*[local-name()='xNome']"),
            'telefone'                      => $this->value("//*[local-name()='toma']//*[local-name()='fone']"),
            'email'                         => $this->value("//*[local-name()='toma']//*[local-name()='email']"),
            'endereco_logradouro'           => $this->value("//*[local-name()='toma']//*[local-name()='xLgr']"),
            'endereco_numero'               => $this->value("//*[local-name()='toma']//*[local-name()='nro']"),
            'endereco_complemento'          => $this->value("//*[local-name()='toma']//*[local-name()='xCpl']"),
            'endereco_bairro'               => $this->value("//*[local-name()='toma']//*[local-name()='xBairro']"),
            'endereco_municipio'            => $this->value("//*[local-name()='toma']//*[local-name()='cMun']"),
            'endereco_estado'               => $this->value("//*[local-name()='toma']//*[local-name()='UF']"),
            'endereco_cep'                  => $this->value("//*[local-name()='toma']//*[local-name()='CEP']"),
        ];
    }

    private function extractDestinatario(): array
    {
        if (!$this->exists("//*[local-name()='dest']")) {
            return [];
        }

        return [
            'documento'                     => $this->value("//*[local-name()='dest']/*[local-name()='CNPJ']"),
            'nome'                          => $this->value("//*[local-name()='dest']/*[local-name()='xNome']"),
            'telefone'                      => $this->value("//*[local-name()='dest']//*[local-name()='fone']"),
            'email'                         => $this->value("//*[local-name()='dest']//*[local-name()='email']"),
            'endereco_logradouro'           => $this->value("//*[local-name()='dest']//*[local-name()='xLgr']"),
            'endereco_numero'               => $this->value("//*[local-name()='dest']//*[local-name()='nro']"),
            'endereco_complemento'          => $this->value("//*[local-name()='dest']//*[local-name()='xCpl']"),
            'endereco_bairro'               => $this->value("//*[local-name()='dest']//*[local-name()='xBairro']"),
            'endereco_municipio'            => $this->value("//*[local-name()='dest']//*[local-name()='xMun']"),
            'endereco_estado'               => $this->value("//*[local-name()='dest']//*[local-name()='UF']"),
            'endereco_cep'                  => $this->value("//*[local-name()='dest']//*[local-name()='CEP']"),
        ];
    }

    private function extractIntermediario(): array
    {
        if (!$this->exists("//*[local-name()='interm']")) {
            return [];
        }

        return [
            'documento'                     => $this->value("//*[local-name()='interm']/*[local-name()='CNPJ']"),
            'nome'                          => $this->value("//*[local-name()='interm']/*[local-name()='xNome']"),
            'telefone'                      => $this->value("//*[local-name()='interm']//*[local-name()='fone']"),
            'email'                         => $this->value("//*[local-name()='interm']//*[local-name()='email']"),
            'inscricao_municipal'           => $this->value("//*[local-name()='interm']/*[local-name()='IM']"),
            'endereco_logradouro'           => $this->value("//*[local-name()='interm']//*[local-name()='xLgr']"),
            'endereco_numero'               => $this->value("//*[local-name()='interm']//*[local-name()='nro']"),
            'endereco_complemento'          => $this->value("//*[local-name()='interm']//*[local-name()='xCpl']"),
            'endereco_bairro'               => $this->value("//*[local-name()='interm']//*[local-name()='xBairro']"),
            'endereco_municipio'            => $this->value("//*[local-name()='interm']//*[local-name()='xMun']"),
            'endereco_estado'               => $this->value("//*[local-name()='interm']//*[local-name()='UF']"),
            'endereco_cep'                  => $this->value("//*[local-name()='interm']//*[local-name()='CEP']"),
        ];
    }

    private function extractServico(): array
    {
        return [
            'codigo_tributacao'             => $this->value("//*[local-name()='serv']/*[local-name()='cTribNac']"),
            'descricao_tributacao'          => $this->value("//*[local-name()='serv']/*[local-name()='xTribNac']"),
            'codigo_nbs'                    => $this->value("//*[local-name()='serv']/*[local-name()='cNBS']"),
            'descricao'                     => $this->value("//*[local-name()='serv']/*[local-name()='xDescServ']"),
            'local_prestacao'               => $this->value("//*[local-name()='xLocPrestacao']"),
            'codigo_municipio'              => $this->value("//*[local-name()='cLocPrestacao']"),
        ];
    }

    private function extractIssqn(): array
    {
        return [
            // gerais
            'tipo_tributacao'               => $this->value("//*[local-name()='tribMun']/*[local-name()='tpTribISSQN']"),
            'municipio_incidencia'          => $this->value("//*[local-name()='infNFSe']/*[local-name()='xLocIncid']"),
            'codigo_municipio'              => $this->value("//*[local-name()='infNFSe']/*[local-name()='cLocIncid']"),
            'regime_especial'               => $this->value("//*[local-name()='tribMun']/*[local-name()='regEspTrib']"),
            'imunidade'                     => $this->value("//*[local-name()='tribMun']/*[local-name()='tpImunidade']"),
            'suspensao'                     => $this->value("//*[local-name()='tribMun']/*[local-name()='suspExig']"),
            'processo'                      => $this->value("//*[local-name()='tribMun']/*[local-name()='nProcSusp']"),
            'beneficio'                     => $this->value("//*[local-name()='tribMun']/*[local-name()='cBenef']"),
            // valores
            'deducoes'                      => $this->value("//*[local-name()='valores']/*[local-name()='vDedRed']"),
            'desconto_incondicionado'       => $this->value("//*[local-name()='valores']/*[local-name()='vDescIncond']"),
            'base_calculo'                  => $this->value("//*[local-name()='valores']/*[local-name()='vBC']"),
            'aliquota'                      => $this->value("//*[local-name()='valores']/*[local-name()='pAliqAplic']"),
            'retencao'                      => $this->value("//*[local-name()='tribMun']/*[local-name()='tpRetISSQN']"),
            'valor_issqn'                   => $this->value("//*[local-name()='valores']/*[local-name()='vISSQN']"),
        ];
    }

    private function extractFederal(): array
    {
        return [
            'irrf'                          => $this->value("//*[local-name()='vIRRF']"),
            'previdencia'                   => $this->value("//*[local-name()='vCP']"),
            'contribuicoes'                 => $this->value("//*[local-name()='vRetCP']"),
            'pis'                           => $this->value("//*[local-name()='vPIS']"),
            'cofins'                        => $this->value("//*[local-name()='vCOFINS']"),
            'descricao'                     => $this->value("//*[local-name()='xRetFed']"),
        ];
    }

    private function extractIbsCbs(): array
    {

    //ibge
    //uf
    //exclusoes e reduções da bc
    //bc após exclusões e reduções
    //Red. Alíquota IBS / Red. Alíquota CBS
    // aliq efetiva cbs
        return [
            'cst'                           => $this->value("//*[local-name()='cClassTrib']"),
            'indicador_operacao'            => $this->value("//*[local-name()='indOp']"),
            'municipio'                     => $this->value("//*[local-name()='cLocIncid']"),
            'base'                          => $this->value("//*[local-name()='vBCIBSCBS']"),
            'aliquota_ibs_uf'               => $this->value("//*[local-name()='pIBSUF']"),
            'aliquota_ibs_municipio'        => $this->value("//*[local-name()='pIBSMun']"),
            'valor_ibs_uf'                  => $this->value("//*[local-name()='vIBSUF']"),
            'valor_ibs_municipio'           => $this->value("//*[local-name()='vIBSMun']"),
            'valor_total_ibs'               => $this->value("//*[local-name()='vIBSTot']"),
            'aliquota_cbs'                  => $this->value("//*[local-name()='pCBS']"),
            'valor_cbs'                     => $this->value("//*[local-name()='vCBS']"),
        ];
    }

    private function extractTotais(): array
    {
        return [
            'valor_servico'                 => $this->value("//*[local-name()='vServ']"),
            'desconto_incondicionado'       => $this->value("//*[local-name()='vDescIncond']"),
            'desconto_condicionado'         => $this->value("//*[local-name()='vDescCond']"),
            'retencoes'                     => $this->value("//*[local-name()='vRetFed']"),
            'valor_liquido'                 => $this->value("//*[local-name()='vLiq']"),
            'total_ibs'                     => $this->value("//*[local-name()='vIBSTot']"),
            'total_cbs'                     => $this->value("//*[local-name()='vCBS']"),
        ];
    }

    private function extractInformacoes(): array
    {
        return [
            'informacoes_complementares'    => $this->value("//*[local-name()='infCompl']"),
            'informacoes_municipio'         => $this->value("//*[local-name()='infMun']"),
            'obra'                          => $this->value("//*[local-name()='cObra']"),
            'inscricao_imobiliaria'         => $this->value("//*[local-name()='inscImobFisc']"),
            'evento'                        => $this->value("//*[local-name()='idAtvEvt']"),
            'nfse_substituida'              => $this->value("//*[local-name()='chSubstda']"),
            'tributos_aproximados_federal'  => $this->value("//*[local-name()='vTotTribFed']"),
            'tributos_aproximados_estadual' => $this->value("//*[local-name()='vTotTribEst']"),
            'tributos_aproximados_municipal'=> $this->value("//*[local-name()='vTotTribMun']"),
        ];
    }
}