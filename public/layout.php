<?php
function campo(string $titulo, ?string $valor = null, $class = ''): void
{
?>
<div class="campo <?= htmlspecialchars($class) ?>">
    <div class="campo-label"> <?= htmlspecialchars($titulo) ?> </div>
    <?php if ($valor !== null): ?>
        <div class="campo-valor"> <?= htmlspecialchars($valor !== '' ? $valor : '-') ?> </div>
    <?php endif; ?>
</div>
<?php
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/danfse.css">
    <title>DANFSe</title>
</head>
<body>
    <div class="page">
        <header class="header">
            <div class="header-logo">UGABUGA</div>
            <div class="header-documento">
                <h1 class="titulo">DANFSe v2.0</h1>
                <p class="subtitulo">Documento Auxiliar da NFS-e </p>
                <?php if (!empty($dados['homologacao'])) : ?>
                    <p class="homologacao">NFS-e SEM VALIDADE JURÍDICA</p>
                <?php endif; ?>
            </div>
            <div class="header-informacoes">
                <div>Município: <?= htmlspecialchars($dados['identificacao']['municipio'] ?? '-') ?></div>
                <div>Ambiente Gerador: <?= htmlspecialchars($dados['identificacao']['ambiente'] ?? '-') ?></div>
                <div>Tipo Ambiente: <?= htmlspecialchars($dados['identificacao']['tipo_ambiente'] ?? '-') ?></div>
            </div>
        </header>
        <div class="topo"> 
            <div class="topo-esquerda">
                <!-- IDENTIFICAÇÃO -->
                <section class="section identificacao">
                    <header class="section-header"> <span>CHAVE DE ACESSO DA NFS-e</span> </header>
                    <div class="chave-acesso"> <?= htmlspecialchars($dados['identificacao']['chave'] ?? '-') ?> </div>
                    <div class="row identificacao-r1">
                        <?php campo('NÚMERO DA NFS-e', $dados['identificacao']['numero_nfse'] ?? ''); ?>
                        <?php campo('COMPETÊNCIA DA NFS-e', $dados['identificacao']['competencia'] ?? ''); ?>
                        <?php campo('DATA E HORA DA EMISSÃO DA NFS-e', $dados['identificacao']['emissao_nfse'] ?? ''); ?>
                    </div>
                    <div class="row identificacao-r2">
                        <?php campo('NÚMERO DA DPS', $dados['identificacao']['numero_dps'] ?? ''); ?>
                        <?php campo('SÉRIE DA DPS', $dados['identificacao']['serie_dps'] ?? ''); ?>
                        <?php campo('DATA E HORA DA EMISSÃO DA DPS', $dados['identificacao']['emissao_dps'] ?? ''); ?>
                    </div>
                    <div class="row identificacao-r3">
                        <?php campo('EMITENTE DA NFS-e', $dados['prestador']['nome'] ?? ''); ?>
                        <?php campo('SITUAÇÃO DA NFS-e', $dados['identificacao']['status'] ?? ''); ?>
                        <?php campo('FINALIDADE', $dados['identificacao']['finalidade'] ?? ''); ?>
                    </div>
                </section>
            </div>
            <aside class="qrcode-box">
                <div class="qrcode-imagem">
                    <?php if (!empty($dados['qrcode'])): ?>
                        <img src="<?= $dados['qrcode'] ?>" alt="QR Code">
                    <?php endif; ?>
                </div>
                <div class="qrcode-texto">
                    A autenticidade desta NFS-e pode ser verificada pela leitura deste código QR ou pela consulta da chave de acesso no Portal Nacional da NFS-e.
                </div>
            </aside>
        </div>
        <!-- PRESTADOR -->
         <section class="section prestador">
            <header class="section-header"> <span>PRESTADOR/FORNECEDOR</span> </header>
            <div class="row entidade-r1">
                <?php campo('CNPJ/CPF/NIF', $dados['prestador']['documento'] ?? ''); ?>
                <?php campo('Indicador Municipal (Inscrição)', $dados['prestador']['inscricao_municipal'] ?? ''); ?>
                <?php campo('Telefone', $dados['prestador']['telefone'] ?? ''); ?>
            </div>
            <div class="row entidade-r2">
                <?php campo('Nome Empresarial', $dados['prestador']['nome'] ?? ''); ?>
                <?php campo('Município/UF', $dados['prestador']['municipio_uf'] ?? ''); ?>
                <?php campo('Código IBGE/CEP', $dados['prestador']['ibge_cep'] ?? ''); ?>
            </div>
            <div class="row entidade-r3">
                <?php campo('Endereço', $dados['prestador']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['prestador']['email'] ?? ''); ?>
            </div>
            <div class="row entidade-r4">
                <?php campo('Simples Nacional na Data de Competência', $dados['prestador']['simples_nacional'] ?? ''); ?>
                <?php campo('Regime de Apuração Tributária pelo SN', $dados['prestador']['regime_apuracao'] ?? ''); ?>
            </div>
        </section>
        <!-- TOMADOR -->
        <section class="section tomador">
            <header class="section-header">
                <span>TOMADOR/ADQUIRENTE</span>
            </header>
            <div class="row entidade-r1">
                <?php campo('CNPJ/CPF/NIF', $dados['tomador']['documento'] ?? ''); ?>
                <?php campo('Indicador Municipal (Inscrição)', $dados['tomador']['inscricao'] ?? ''); ?>
                <?php campo('Telefone', $dados['tomador']['telefone'] ?? ''); ?>
            </div>
            <div class="row entidade-r2">
                <?php campo('Nome/Nome Empresarial', $dados['tomador']['nome'] ?? ''); ?>
                <?php campo('Município/UF', $dados['tomador']['municipio_uf'] ?? ''); ?>
                <?php campo('Código IBGE/CEP', $dados['tomador']['ibge_cep'] ?? ''); ?>
            </div>
            <div class="row entidade-r3">
                <?php campo('Endereço', $dados['tomador']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['tomador']['email'] ?? ''); ?>
            </div>
        </section>
       <!-- DESTINATÁRIO -->
        <section class="section destinatario">
            <header class="section-header"> <span>DESTINATÁRIO DA OPERAÇÃO</span> </header>
            <div class="row destinatario-r1">
                <?php campo('CNPJ/CPF/NIF', $dados['destinatario']['documento'] ?? ''); ?>
                <?php campo('Telefone', $dados['destinatario']['telefone'] ?? ''); ?>
            </div>
            <div class="row destinatario-r2">
                <?php campo('Nome/Nome Empresarial', $dados['destinatario']['nome'] ?? '', 'campo-destaque'); ?>
                <?php campo('Município/UF', $dados['destinatario']['municipio_uf'] ?? ''); ?>
                <?php campo('Código IBGE/CEP', $dados['destinatario']['ibge_cep'] ?? ''); ?>
            </div>
            <div class="row destinatario-r3">
                <?php campo('Endereço', $dados['destinatario']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['destinatario']['email'] ?? ''); ?>
            </div>
        </section>
        <!-- INTERMEDIÁRIO -->
        <section class="section intermediario">
            <header class="section-header"> <span>INTERMEDIÁRIO DA OPERAÇÃO</span> </header>
            <div class="row entidade-r1">
                <?php campo('CNPJ/CPF/NIF', $dados['intermediario']['documento'] ?? ''); ?>
                <?php campo('Indicador Municipal (Inscrição)', $dados['intermediario']['inscricao_municipal'] ?? ''); ?>
                <?php campo('Telefone', $dados['intermediario']['telefone'] ?? ''); ?>
            </div>
            <div class="row entidade-r2">
                <?php campo('Nome/Nome Empresarial', $dados['intermediario']['nome'] ?? '', 'campo-destaque'); ?>
                <?php campo('Município/UF', $dados['intermediario']['municipio_uf'] ?? ''); ?>
                <?php campo('Código IBGE/CEP', $dados['intermediario']['ibge_cep'] ?? ''); ?>
            </div>
            <div class="row entidade-r3">
                <?php campo('Endereço', $dados['intermediario']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['intermediario']['email'] ?? ''); ?>
            </div>
        </section>
        <!-- SERVIÇO PRESTADO -->
        <section class="section servico">
            <header class="section-header"> <span>SERVIÇO PRESTADO</span> </header>
            <div class="row servico-r1">
                <?php campo('Código de Tributação Nacional/Municipal', $dados['servico']['codigo_tributacao'] ?? ''); ?>
                <?php campo('Código da NBS', $dados['servico']['codigo_nbs'] ?? ''); ?>
                <?php campo('Local da Prestação/UF/País', $dados['servico']['local_prestacao'] ?? ''); ?>
            </div>
            <div class="row">
                <?php campo('Descrição do Código de Tributação Nacional/Municipal',  $dados['servico']['descricao_tributacao'] ?? ''); ?>
            </div>
            <div class="row">
                <?php campo('Descrição do Serviço', nl2br(htmlspecialchars($dados['servico']['descricao'] ?? '-')),); ?>
            </div>
        </section>
        <!-- TRIBUTAÇÃO MUNICIPAL (ISSQN) -->
        <section class="section issqn">
            <header class="section-header"> <span>TRIBUTAÇÃO MUNICIPAL (ISSQN)</span> </header>
            <div class="row issqn-r1">
                <?php campo('Tipo de Tributação do ISSQN', $dados['issqn']['tipo_tributacao'] ?? ''); ?>
                <?php campo('Município/UF/País de Incidência', $dados['issqn']['municipio_incidencia'] ?? ''); ?>
                <?php campo('Regime Especial de Tributação', $dados['issqn']['regime_especial'] ?? ''); ?>
            </div>
            <div class="row issqn-r2">
                <?php campo('Tipo de Imunidade', $dados['issqn']['imunidade'] ?? ''); ?>
                <?php campo('Suspensão da Exigibilidade', $dados['issqn']['suspensao'] ?? ''); ?>
                <?php campo('Processo', $dados['issqn']['processo'] ?? ''); ?>
                <?php campo('Benefício Municipal', $dados['issqn']['beneficio'] ?? ''); ?>
            </div>
            <div class="row issqn-r3">
                <?php campo('Total Deduções/Reduções', $dados['issqn']['deducoes'] ?? ''); ?>
                <?php campo('Desconto Incondicionado', $dados['issqn']['desconto_incondicionado'] ?? ''); ?>
                <?php campo('BC ISSQN', $dados['issqn']['base_calculo'] ?? ''); ?>
                <?php campo('Alíquota Aplicada', $dados['issqn']['aliquota'] ?? ''); ?>
                <?php campo('Retenção do ISSQN', $dados['issqn']['retencao'] ?? ''); ?>
            </div>
            <div class="row">
                <?php campo('ISSQN APURADO', $dados['issqn']['valor_issqn'] ?? '', 'campo-destaque'); ?>
            </div>
        </section>
        <!-- TRIBUTAÇÃO FEDERAL -->
        <section class="section federal">
            <header class="section-header"> <span>TRIBUTAÇÃO FEDERAL (EXCETO CBS)</span> </header>
            <div class="row federal-r1">
                <?php campo('IRRF', $dados['federal']['irrf'] ?? ''); ?>
                <?php campo('Contribuição Previdenciária Retida', $dados['federal']['previdencia'] ?? ''); ?>
                <?php campo('Contribuições Sociais Retidas', $dados['federal']['contribuicoes'] ?? ''); ?>
            </div>
            <div class="row federal-r2">
                <?php campo('PIS - Débito Apuração Própria', $dados['federal']['pis'] ?? ''); ?>
                <?php campo('COFINS - Débito Apuração Própria', $dados['federal']['cofins'] ?? ''); ?>
            </div>
            <div class="row">
                <?php campo('Descrição das Contribuições Sociais Retidas', $dados['federal']['descricao'] ?? ''); ?>
            </div>
        </section>
        <!-- IBS/CBS -->
        <section class="section ibscbs">
            <header class="section-header"> <span>TRIBUTAÇÃO IBS/CBS</span> </header>
            <div class="row ibs-r1">
                <?php campo('CST/Classificação', $dados['ibscbs']['cst'] ?? ''); ?>
                <?php campo('Indicador da Operação', $dados['ibscbs']['operacao'] ?? ''); ?>
                <?php campo('Município de Incidência', $dados['ibscbs']['municipio'] ?? ''); ?>
                <?php campo('UF', $dados['ibscbs']['uf'] ?? ''); ?>
            </div>
            <div class="row ibs-r2">
                <?php campo('BC após Exclusões', $dados['ibscbs']['base'] ?? ''); ?>
            </div>
            <div class="row ibs-r3">
                <?php campo('Alíquota IBS Estadual', $dados['ibscbs']['aliquota_ibs_uf'] ?? ''); ?>
                <?php campo('IBS Estadual', $dados['ibscbs']['valor_ibs_uf'] ?? ''); ?>
                <?php campo('Alíquota IBS Municipal', $dados['ibscbs']['aliquota_ibs_municipio'] ?? ''); ?>
                <?php campo('IBS Municipal', $dados['ibscbs']['valor_ibs_municipio'] ?? ''); ?>
            </div>
            <div class="row ibs-r4">
                <?php campo('IBS Total', $dados['ibscbs']['valor_total_ibs'] ?? ''); ?>
                <?php campo('Alíquota CBS', $dados['ibscbs']['aliquota_cbs'] ?? ''); ?>
                <?php campo('CBS Apurada', $dados['ibscbs']['valor_cbs'] ?? ''); ?>
            </div>
        </section>
        <!-- TOTAIS -->
        <section class="section totais">
            <header class="section-header"> <span>VALORES TOTAIS DA NFS-e</span> </header>
            <div class="row totais-r1">
                <?php campo('Valor da Operação/Serviço', $dados['totais']['valor_servico'] ?? ''); ?>
                <?php campo('Desconto Incondicionado', $dados['totais']['desconto_incondicionado'] ?? ''); ?>
                <?php campo('Desconto Condicionado', $dados['totais']['desconto_condicionado'] ?? ''); ?>
            </div>
            <div class="row totais-r2">
                <?php campo('Total de Retenções', $dados['totais']['retencoes'] ?? ''); ?>
                <?php campo('Valor Líquido da NFS-e', $dados['totais']['valor_liquido'] ?? ''); ?>
                <?php campo('Valor Líquido + IBS/CBS', $dados['totais']['total_final'] ?? ''); ?>
            </div>
        </section>
        <!-- INFORMAÇÕES COMPLEMENTARES -->
        <section class="section informacoes">
            <header class="section-header"> <span>INFORMAÇÕES COMPLEMENTARES</span> </header>
            <div class="row">
                <div class="campo campo-info">
                    <div class="campo-valor descricao-servico"> <?= nl2br(htmlspecialchars($dados['informacoes']['informacoes_complementares'] ?? '-')) ?> </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-left">
                Documento Auxiliar da Nota Fiscal de Serviço eletrônica (DANFSe)
            </div>
        </footer>
    </div>
</body>
</html>