<?php
    function campo(string $titulo, ?string $valor = null): void
    {
?>
    <div class="campo">
        <div class="campo-label">
            <?= htmlspecialchars($titulo) ?>
        </div>
        <?php if ($valor !== null): ?>
            <div class="campo-valor">
                <?= htmlspecialchars($valor !== '' ? $valor : '-') ?>
            </div>
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
            <div class="logo"> UGABUGA </div>
            <div class="header-center">
                <div class="titulo"> DANFSe v2.0 </div>
                <div class="subtitulo"> Documento Auxiliar da NFS-e </div>
                <?php if (!empty($dados['homologacao'])) : ?>
                    <div class="homologacao"> NFS-e SEM VALIDADE JURÍDICA </div>
                <?php endif; ?>
            </div>
            <div class="header-right">
                <div>Município do Emitente: <?= htmlspecialchars($dados['identificacao']['municipio'] ?? '-') ?></div>
                <div>Ambiente Gerador: <?= htmlspecialchars($dados['identificacao']['ambiente'] ?? '-') ?></div>
                <div>Tipo de Ambiente: <?= htmlspecialchars($dados['identificacao']['tipo_ambiente'] ?? '-') ?></div>
            </div>
        </header>
        <!-- IDENTIFICAÇÃO -->
        <section class="section">
            <div class="section-title"> CHAVE DE ACESSO DA NFS-e </div>
            <div class="chave"> <?= htmlspecialchars($dados['identificacao']['chave'] ?? '-') ?></div>
            <div class="row row-3">
                <?php campo('NÚMERO DA NFS-e', $dados['identificacao']['numero_nfse'] ?? ''); ?>
                <?php campo('COMPETÊNCIA', $dados['identificacao']['competencia'] ?? ''); ?>
                <?php campo('DATA/HORA DA EMISSÃO DA NFS-e', $dados['identificacao']['emissao_nfse'] ?? ''); ?>
            </div>
            <div class="row row-3">
                <?php campo('NÚMERO DA DPS', $dados['identificacao']['numero_dps'] ?? ''); ?>
                <?php campo('SÉRIE DA DPS', $dados['identificacao']['serie_dps'] ?? ''); ?>
                <?php campo('DATA/HORA DA EMISSÃO DA DPS', $dados['identificacao']['emissao_dps'] ?? ''); ?>
            </div>
            <div class="row row-3">
                <?php campo('EMITENTE DA NFS-e', $dados['prestador']['nome'] ?? ''); ?>
                <?php campo('SITUAÇÃO DA NFS-e', $dados['identificacao']['status'] ?? ''); ?>
                <?php campo('FINALIDADE', $dados['identificacao']['finalidade'] ?? ''); ?>
            </div>
        </section>
        <!-- PRESTADOR -->
        <section class="section">
            <div class="row prestador-r1">
                <?php campo('PRESTADOR/FORNECEDOR'); ?>
                <?php campo('CNPJ/CPF/NIF', $dados['prestador']['documento'] ?? ''); ?>
                <?php campo('Indicador Municipal (Inscrição)', $dados['prestador']['inscricao_municipal'] ?? ''); ?>
                <?php campo('Telefone', $dados['prestador']['telefone'] ?? ''); ?>
            </div>
            <div class="row prestador-r2">
                <?php campo('Nome Empresarial', $dados['prestador']['nome'] ?? ''); ?>
                <?php campo('Município/UF', ($dados['prestador']['endereco_municipio'] ?? '').' / '.($dados['prestador']['endereco_estado'] ?? '')); ?>
                <?php campo('Código IBGE/CEP', ($dados['prestador']['ibge'] ?? '-').' / '.($dados['prestador']['endereco_cep'] ?? '')); ?>
            </div>
            <div class="row prestador-r3">
                <?php campo('Endereço', $dados['prestador']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['prestador']['email'] ?? ''); ?>
            </div>
            <div class="row prestador-r4">
                <?php campo('Simples Nacional na Data de Competência', $dados['prestador']['simples_nacional'] ?? ''); ?>
                <?php campo('Regime de Apuração Tributária pelo SN', $dados['prestador']['regime_apuracao'] ?? ''); ?>
            </div>
        </section>                
        <!-- TOMADOR -->
        <section class="section">
            <div class="row tomador-r1">
                <?php campo('TOMADOR/ADQUIRENTE'); ?>
                <?php campo('CNPJ/CPF/NIF', $dados['tomador']['documento'] ?? ''); ?>
                <?php campo('Indicador Municipal (Inscrição)', $dados['tomador']['inscricao'] ?? ''); ?>
                <?php campo('Telefone', $dados['tomador']['telefone'] ?? ''); ?>
            </div>
            <div class="row tomador-r2">
                <?php campo('Nome/Nome Empresarial', $dados['tomador']['nome'] ?? ''); ?>
                <?php campo('Município/UF',($dados['tomador']['endereco_municipio'] ?? '').' / '.($dados['tomador']['endereco_estado'] ?? '')); ?>
                <?php campo('Código IBGE/CEP',($dados['tomador']['ibge'] ?? '-').' / '.($dados['tomador']['endereco_cep'] ?? '')); ?>
            </div>
            <div class="row tomador-r3">
                <?php campo('Endereço', $dados['tomador']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['tomador']['email'] ?? ''); ?>
            </div>
        </section>
        <!-- DESTINATÁRIO -->
        <section class="section">
            <div class="row destinatario-r1">
                <?php campo('DESTINATÁRIO DA OPERAÇÃO'); ?>
                <?php campo('CNPJ/CPF/NIF', $dados['destinatario']['documento'] ?? ''); ?>
                <?php campo('Telefone', $dados['destinatario']['telefone'] ?? ''); ?>
            </div>
            <div class="row destinatario-r2">
                <?php campo('Nome/Nome Empresarial', $dados['destinatario']['nome'] ?? ''); ?>
                <?php campo('Município/Sigla UF',($dados['destinatario']['endereco_municipio'] ?? '').' / '.($dados['destinatario']['endereco_estado'] ?? '')); ?>
                <?php campo('Código IBGE/CEP',($dados['destinatario']['ibge'] ?? '-').' / '.($dados['destinatario']['endereco_cep'] ?? '')); ?>
            </div>
            <div class="row destinatario-r3">
                <?php campo('Endereço', $dados['destinatario']['endereco'] ?? ''); ?>
                <?php campo('E-mail', $dados['destinatario']['email'] ?? ''); ?>
            </div>
        </section>
        <!-- INTERMEDIÁRIO -->
        <section class="section">
            <div class="row intermediario-r1">
                <?php campo('INTERMEDIÁRIO DA OPERAÇÃO'); ?>
                <?php campo('CNPJ/CPF/NIF',$dados['intermediario']['documento'] ?? ''); ?>
                <?php campo('Indicador Municipal (Inscrição)',$dados['intermediario']['inscricao_municipal'] ?? ''); ?>
                <?php campo('Telefone',$dados['intermediario']['telefone'] ?? ''); ?>
            </div>
            <div class="row intermediario-r2">
                <?php campo('Nome/Nome Empresarial',$dados['intermediario']['nome'] ?? ''); ?>
                <?php campo('Município/Sigla UF',($dados['intermediario']['endereco_municipio'] ?? '').' / '.($dados['intermediario']['endereco_estado'] ?? '')); ?>
                <?php campo('Código IBGE / CEP',($dados['intermediario']['ibge'] ?? '-').' / '.($dados['intermediario']['endereco_cep'] ?? '')); ?>
            </div>
            <div class="row intermediario-r3">
                <?php campo('Endereço',$dados['intermediario']['endereco'] ?? ''); ?>
                <?php campo('E-mail',$dados['intermediario']['email'] ?? ''); ?>
            </div>
        </section>
        <!-- SERVIÇO PRESTADO -->
         <section class="section">
            <div class="section-title"> SERVIÇO PRESTADO</div>
            <div class="row servico-r1">
                <?php campo('Código de Tributação Nacional/Municipal',$dados['servico']['codigo_tributacao'] ?? ''); ?>
                <?php campo('Código da NBS',$dados['servico']['codigo_nbs'] ?? ''); ?>
                <?php campo('Local da Prestação/UF/País',$dados['servico']['local_prestacao'] ?? ''); ?>
            </div>
            <div class="row">
                <div class="campo">
                    <div class="campo-label"> Descrição do Código de Tributação Nacional / Municipal </div>
                    <div class="campo-valor"> <?= htmlspecialchars($dados['servico']['descricao_tributacao'] ?? '-') ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="campo campo-descricao">
                    <div class="campo-label">Descrição do Serviço</div>
                    <div class="campo-valor descricao-servico"><?= nl2br(htmlspecialchars($dados['servico']['descricao'] ?? '-')) ?></div>
                </div>
            </div>
        </section>
        <!-- ISSQN -->
         <section class="section">
            <div class="section-title">TRIBUTAÇÃO MUNICIPAL (ISSQN)</div>
            <div class="row issqn-r1">
                <?php campo('Tipo de Tributação do ISSQN',$dados['issqn']['tipo_tributacao'] ?? ''); ?>
                <?php campo('Município/UF/País de Incidência',$dados['issqn']['municipio_incidencia'] ?? ''); ?>
                <?php campo('Regime Especial de Tributação',$dados['issqn']['regime_especial'] ?? ''); ?>
            </div>
            <div class="row issqn-r2">
                <?php campo('Tipo de Imunidade',$dados['issqn']['imunidade'] ?? ''); ?>
                <?php campo('Suspensão da Exigibilidade',$dados['issqn']['suspensao'] ?? ''); ?>
                <?php campo('Processo',$dados['issqn']['processo'] ?? ''); ?>
                <?php campo('Benefício Municipal',$dados['issqn']['beneficio'] ?? ''); ?>
                <?php //campo('Cálculo BM',$dados['issqn']['calculo_bm'] ?? ''); ?>
            </div>
            <div class="row issqn-r3">
                <?php campo('Total Deduções / Reduções',$dados['issqn']['deducoes'] ?? ''); ?>
                <?php campo('Desconto Incondicionado',$dados['issqn']['desconto_incondicionado'] ?? ''); ?>
                <?php campo('BC ISSQN',$dados['issqn']['base_calculo'] ?? ''); ?>
                <?php campo('Alíquota Aplicada',$dados['issqn']['aliquota'] ?? ''); ?>
                <?php campo('Retenção do ISSQN',$dados['issqn']['retencao'] ?? ''); ?>
            </div>
            <div class="row"><?php campo('ISSQN APURADO',$dados['issqn']['valor_issqn'] ?? ''); ?></div>
        </section>
        <!-- TRIBUTAÇÃO FEDERAL -->
        <section class="section">
            <div class="section-title"> TRIBUTAÇÃO FEDERAL (EXCETO CBS)</div>
            <div class="row federal-r1">
                <?php campo('IRRF',$dados['federal']['irrf'] ?? ''); ?>
                <?php campo('Contribuição Previdenciária Retida',$dados['federal']['previdencia'] ?? ''); ?>
                <?php campo('Contribuições Sociais Retidas',$dados['federal']['contribuicoes'] ?? ''); ?>
            </div>
            <div class="row federal-r2">
                <?php campo('PIS - Débito Apuração Própria',$dados['federal']['pis'] ?? ''); ?>
                <?php campo('COFINS - Débito Apuração Própria',$dados['federal']['cofins'] ?? ''); ?>
            </div>
            <div class="row">
                <?php campo('Descrição das Contribuições Sociais Retidas',$dados['federal']['descricao'] ?? ''); ?>
            </div>
        </section>
        <!-- IBS / CBS -->
         <section class="section">
            <div class="section-title"> TRIBUTAÇÃO IBS / CBS</div>
            <div class="row ibs-r1">
                <?php campo('CST / Classificação', $dados['ibscbs']['cst'] ?? ''); ?>
                <?php campo('Indicador da Operação', $dados['ibscbs']['operacao'] ?? ''); ?>
                <?php campo('Município de Incidência', $dados['ibscbs']['municipio'] ?? ''); ?>
                <?php campo('UF', $dados['ibscbs']['uf'] ?? ''); ?>
            </div>
            <div class="row ibs-r2">
                <?php //campo('Exclusões / Reduções BC', $dados['ibscbs']['exclusoes'] ?? ''); ?>
                <?php campo('BC após Exclusões', $dados['ibscbs']['base'] ?? ''); ?>
                <?php //campo('Redução Alíquota IBS', $dados['ibscbs']['red_ibs'] ?? ''); ?>
                <?php //campo('Redução Alíquota CBS', $dados['ibscbs']['red_cbs'] ?? ''); ?>
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
         <section class="section">
            <div class="section-title">VALORES TOTAIS DA NFS-e</div>
            <div class="row totais-r1">
                <?php campo('Valor da Operação / Serviço', $dados['totais']['valor_servico'] ?? ''); ?>
                <?php campo('Desc. Incondicionado', $dados['totais']['desconto_incondicionado'] ?? ''); ?>
                <?php campo('Desc. Condicionado', $dados['totais']['desconto_condicionado'] ?? ''); ?>
            </div>
            <div class="row totais-r2">
                <?php campo('Total Retenções', $dados['totais']['retencoes'] ?? ''); ?>
                <?php campo('Valor Líquido da NFS-e', $dados['totais']['valor_liquido'] ?? ''); ?>
                <?php //campo('Total IBS/CBS', $dados['totais']['ibscbs'] ?? ''); ?>
                <?php campo('Valor Líquido + IBS/CBS', $dados['totais']['total_final'] ?? ''); ?>
            </div>
        </section>
        <!-- INFOS COMPLEMENTARES -->
         <section class="section">
            <div class="section-title">INFORMAÇÕES COMPLEMENTARES</div>
            <div class="row">
                <div class="campo campo-info">
                    <div class="campo-valor descricao-servico"> <?= nl2br(htmlspecialchars($dados['informacoes']['informacoes_complementares'] ?? '-')) ?></div>
                </div>
            </div>
        </section>

    </div>
</body>
</html>