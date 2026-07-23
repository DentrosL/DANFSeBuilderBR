<?php

namespace App;

class DanfseRenderer
{
    public function prepare(array $dados): array
    {
        $dados['identificacao']['competencia']      = Formatter::data($dados['identificacao']['competencia'] ?? null);
        $dados['identificacao']['emissao_nfse']     = Formatter::dataHora($dados['identificacao']['emissao_nfse'] ?? null);
        $dados['identificacao']['emissao_dps']      = Formatter::dataHora($dados['identificacao']['emissao_dps'] ?? null);
        $dados['prestador']['documento']            = Formatter::documento($dados['prestador']['documento'] ?? null);
        $dados['prestador']['telefone']             = Formatter::telefone($dados['prestador']['telefone'] ?? null);
        $dados['prestador']['endereco']             = Formatter::endereco($dados['prestador']['endereco_logradouro'] ?? null, $dados['prestador']['endereco_numero'] ?? null,$dados['prestador']['endereco_complemento'] ?? null );
        $dados['prestador']['municipio_uf']         = Formatter::municipioUf($dados['prestador']['endereco_municipio'] ?? null, $dados['prestador']['endereco_estado'] ?? null);
        $dados['prestador']['ibge_cep']             = Formatter::ibgeCep($dados['prestador']['codigo_ibge'] ?? null, $dados['prestador']['endereco_cep'] ?? null);
        $dados['identificacao']['numero_nfse']      = Formatter::vazio($dados['identificacao']['numero_nfse'] ?? null);
        $dados['identificacao']['numero_dps']       = Formatter::vazio($dados['identificacao']['numero_dps'] ?? null);
        $dados['identificacao']['status']           = Formatter::vazio($dados['identificacao']['status'] ?? null);
        $dados['identificacao']['chave']            = Formatter::vazio($dados['identificacao']['chave'] ?? null);

        $chave                                      = $dados['identificacao']['chave'] ?? null;
        $dados['qrcode']                            = $chave ? QrCode::image($chave) : null;
        $dados['url_consulta']                      = QrCode::url($dados['identificacao']['chave'] ?? '');

        $dados['cancelada']                         = ($dados['identificacao']['status'] ?? null) === 'Cancelada';
        $dados['substituida']                       = ($dados['identificacao']['status'] ?? null) === 'Substituída';

        if (!empty($dados['tomador'])) {
            $dados['tomador']['documento']          = Formatter::documento($dados['tomador']['documento'] ?? null);
            $dados['tomador']['telefone']           = Formatter::telefone($dados['tomador']['telefone'] ?? null);
            $dados['tomador']['endereco']           = Formatter::endereco($dados['tomador']['endereco_logradouro'] ?? null, $dados['tomador']['endereco_numero'] ?? null, $dados['tomador']['endereco_complemento'] ?? null);
            $dados['tomador']['municipio_uf']       = Formatter::municipioUf($dados['tomador']['endereco_municipio'] ?? null, $dados['tomador']['endereco_estado'] ?? null);
            $dados['tomador']['ibge_cep']           = Formatter::ibgeCep($dados['tomador']['codigo_ibge'] ?? null,$dados['tomador']['endereco_cep'] ?? null);
        }

        if (!empty($dados['destinatario'])) {

            $dados['destinatario']['documento']     = Formatter::documento($dados['destinatario']['documento'] ?? null);
            $dados['destinatario']['telefone']      = Formatter::telefone($dados['destinatario']['telefone'] ?? null);
            $dados['destinatario']['endereco']      = Formatter::endereco($dados['destinatario']['endereco_logradouro'] ?? null, $dados['destinatario']['endereco_numero'] ?? null, $dados['destinatario']['endereco_complemento'] ?? null);
            $dados['destinatario']['municipio_uf']  = Formatter::municipioUf($dados['destinatario']['endereco_municipio'] ?? null, $dados['destinatario']['endereco_estado'] ?? null);
            $dados['destinatario']['ibge_cep']      = Formatter::ibgeCep($dados['destinatario']['codigo_ibge'] ?? null, $dados['destinatario']['endereco_cep'] ?? null);
        }

        if (!empty($dados['intermediario'])) {
            $dados['intermediario']['documento']    = Formatter::documento($dados['intermediario']['documento'] ?? null);
            $dados['intermediario']['telefone']     = Formatter::telefone($dados['intermediario']['telefone'] ?? null);
            $dados['intermediario']['endereco']     = Formatter::endereco($dados['intermediario']['endereco_logradouro'] ?? null, $dados['intermediario']['endereco_numero'] ?? null, $dados['intermediario']['endereco_complemento'] ?? null);
            $dados['intermediario']['municipio_uf'] = Formatter::municipioUf($dados['intermediario']['endereco_municipio'] ?? null, $dados['intermediario']['endereco_estado'] ?? null);
            $dados['intermediario']['ibge_cep']     = Formatter::ibgeCep($dados['intermediario']['codigo_ibge'] ?? null, $dados['intermediario']['endereco_cep'] ?? null);
        }

        foreach(['deducoes', 'desconto_incondicionado', 'base_calculo', 'valor_issqn'] as $campo) {
            $dados['issqn'][$campo] = Formatter::moeda($dados['issqn'][$campo] ?? null);
        }

        $dados['issqn']['aliquota'] = Formatter::percentual($dados['issqn']['aliquota'] ?? null);

        foreach($dados['federal'] as $campo => $valor) {
            if ($campo !== 'descricao') {
                $dados['federal'][$campo] = Formatter::moeda($valor);
            }
        }

        foreach(['base', 'valor_ibs_uf', 'valor_ibs_municipio', 'valor_total_ibs', 'valor_cbs'] as $campo) {
            $dados['ibscbs'][$campo] = Formatter::moeda($dados['ibscbs'][$campo] ?? null);
        }

        foreach(['aliquota_ibs_uf', 'aliquota_ibs_municipio', 'aliquota_cbs'] as $campo) {
            $dados['ibscbs'][$campo] = Formatter::percentual($dados['ibscbs'][$campo] ?? null);
        }

        foreach($dados['totais'] as $campo => $valor) {
            $dados['totais'][$campo] = Formatter::moeda($valor);
        }

        return $dados;
    }

    public function render(array $dados): string
    {
        return $this->buildHtml($this->prepare($dados));
    }

    private function buildHtml(array $dados): string
    {
        ob_start();

        require __DIR__.'/../public/layout.php';

        return ob_get_clean();
    }
}