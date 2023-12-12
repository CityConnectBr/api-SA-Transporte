<!DOCTYPE html> <html> <head>
<title></title>
<style type="text/css">
    html,
    body {
        width: 190mm;
    }

    html {
        font-family: Arial, Helvetica, sans-serif;
    }

    h3 {
        text-align: center;
        margin: 0px;
        padding: 0px;
    }

    .header {
        width: 100%;
        height: 0.7cm;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
    }

    .header .empresa {
        float: left;
    }

    .header .data_cabecalho {
        float: right;
    }

    .box {
        width: 100%;
        border: 1px solid black;
        margin-top: 5px;
    }

    table {
        width: 100%;
        border: none;
    }

    table tr th,
    table tr td {
        font-size: 9px;
        border: none;
        padding: 0px;
        margin: 0px;
    }

    table tr {
        width: 100%;
        border: none;
    }

    table tr th {
        text-align: left;
    }

    table tr .w20 {
        width: 20%;
    }

    table tr .w30 {
        width: 33.33333333%;
    }

    table tr .w60 {
        width: 66.66666666%;
    }

    table tr .w50 {
        width: 50%;
    }

    table tr .w100 {
        width: 100%;
    }

    .alvara{
        width: 6cm;
        height: 5cm;
        border-left: 1px solid black;
        border-bottom: 1px solid black;
        position: absolute;
        right: -15px;
        padding: 5px;
    }

    .alvara p{
        font-size: 9px;
    }
</style>
</head>

<body>
    <div class="content">
        <div class="header">
            <div class="empresa">SA TRANSPORTES</div>
            <div class="data_cabecalho">Santo André, {{ $dataFormatada }}</div>
        </div>

        <h3>Ficha Completa</h3>

        <div class="box">
            <table>
                <tr>
                    <th class="w30">Dados Pessoais</th>
                    <td class="w30">Inicio Atividades: {{ $inicioAtividades }}</td>
                    <td class="w30">Situação: {{ $ativo }}</td>
                </tr>
                <tr>
                    <td class="w30">N° Cadastro: </td>
                    <td class="w30">N°: Cadastro Antigo: </td>
                    <td class="w30">Prefixo: </td>
                </tr>
                <tr>
                    <td class="w30">Nome: {{ $permissionario['nome_razao_social'] }}</td>
                    <td class="w30"></td>
                    <td class="w30">N° Reg INSS: {{ $permissionario['inss'] }}</td>
                </tr>
                <tr>
                    <td class="w20">Pessoa: {{ $permissionario['tipo'] }}</td>
                    <td class="w20">CPF: {{ $permissionario['cpf_cnpj'] }}</td>
                    <td class="w20">RG: {{ $permissionario['rg'] }}</td>
                    <td class="w20">Insc. Municipal: {{ $permissionario['inscricao_municipal'] }}</td>
                </tr>
                <tr>
                    <td class="w30">Responsavel: </td>
                    <td class="w30"></td>
                    <td class="w30">N° Alvará Func: {{ $permissionario['alvara_de_funcionamento'] }}</td>
                </tr>
                <tr>
                    <td class="w30">Procur/resp: </td>
                </tr>
                <tr>
                    <td class="w30">Telefone: {{ $permissionario['telefone'] }}</td>
                    <td class="w30">Celular: {{ $permissionario['celular'] }}</td>
                    <td class="w30">Recados: {{ $permissionario['telefone2'] }}</td>
                </tr>
                <tr>
                    <td class="w60">Endereço: {{ $endereco['endereco'] }}</td>
                    <td class="w30">N°: {{ $endereco['numero'] }}</td>
                </tr>
                <tr>
                    <td class="w30">Complemento: {{ $endereco['complemento'] }}</td>
                    <td class="w30">Bairro: {{ $endereco['bairro'] }}</td>
                    <td class="w30"></td>
                </tr>
                <tr>
                    <td class="w30">Município: {{ $municipio['nome'] }}</td>
                    <td class="w30">UF: {{ $endereco['uf'] }}</td>
                    <td class="w30">CEP: {{ $endereco['cep'] }}</td>
                </tr>
                <tr>
                    <td class="w30">E-mail: {{ $permissionario['email'] }}</td>
                    <td class="w30">Ent. Associativa: {{ $entidadeAssociativa['descricao'] }}</td>
                    <td class="w30"></td>
                </tr>
                <tr>
                    <td class="w30">Data de Nasc: {{ $dataNasc }}</td>
                    <td class="w30">Naturalidade: {{ $permissionario['naturalidade'] }}</td>
                    <td class="w30">Nacionalidade: {{ $permissionario['nacionalidade'] }}</td>
                </tr>
                <tr>
                    <td class="w30">CNH: {{ $permissionario['cnh'] }}</td>
                    <td class="w30">Vencto CNH: {{ $cnhVencto }}</td>
                    <td class="w30">Estado Civil: {{ $permissionario['estado_civil'] }}</td>
                </tr>
                <tr>
                    <td class="w30">1° Ponto: {{ $ponto1 }}</td>
                    <td class="w30">6° Ponto: {{ $ponto6 }}</td>
                    <td class="w30"></td>
                </tr>
                <tr>
                    <td class="w30">2° Ponto: {{ $ponto2 }}</td>
                    <td class="w30">7° Ponto: {{ $ponto7 }}</td>
                    <td class="w30"></td>
                </tr>
                <tr>
                    <td class="w30">3° Ponto: {{ $ponto3 }}</td>
                    <td class="w30">8° Ponto: {{ $ponto8 }}</td>
                    <td class="w30"></td>
                </tr>
                <tr>
                    <td class="w30">4° Ponto: {{ $ponto4 }}</td>
                    <td class="w30">9° Ponto: {{ $ponto9 }}</td>
                    <td class="w30"></td>
                </tr>
                <tr>
                    <td class="w30">5° Ponto: </td>
                    <td class="w30"></td>
                    <td class="w30"></td>
                </tr>

            </table>
        </div>

        <div class="box">
            <div class="alvara">
                <p>Alvará</p>
                <p>Data Emissão: {{ $emissaoAlvara }}</p>
                <p>Data Vencto: {{ $vencimentoAlvara }}</p>
                <p>Data Retorno: {{ $retornoAlvara }}</p>
                <p>OBS: {{ $obsAlvara }}</p>
            </div>
            <table style="width: 80%;">
                <tr>
                    <th class="w50">Documentos Apresentados</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['atestado_de_saude']?'X':" "}} ] Atestado de Saúde</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['certidao_negativa']?'X':" "}} ] Certidão Negativa de Distribuição Criminal</th>
                    <td class="w50">Validade: {{ $validadeCertidaoNegativa }}</td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['comprovante_de_endereco']?'X':" "}} ] Comprovante de Endereço</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['inscricao_do_cadastro_mobiliario']?'X':" "}} ] CMC - Inscrição Cadastro Mobiliário</th>
                    <td class="w50">N°: {{ $permissionario['numero_do_cadastro_mobiliario'] }}</td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['curso_primeiro_socorros']?'X':" "}} ] Cursos - SEST/SENAT: </th>
                    <td class="w50">Emissão: {{ $emissaoCursoPrimeirosSocorros }}</td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['crlv']?'X':" "}} ] C.R.L.V</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['contrato_comodato']?'X':" "}} ] Contrato de Comodato</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['ipva']?'X':" "}} ] IPVA</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['dpvat']?'X':" "}} ] DPVAT</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['relacao_dos_alunos_transportados']?'X':" "}} ] Relação dos alunos transportados</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['laudo_vistoria_com_aprovacao_da_sa_trans']?'X':" "}} ] Laudo de vistoria com aprovação da SA-TRANS</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['ciretran_vistoria']?'X':" "}} ] CERETRAN Vistoria</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['ciretran_autorizacao']?'X':" "}} ] CERETRAN Autorização</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['selo_gnv']?'X':" "}} ] Selo GNV</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <th class="w50">[ {{ $permissionario['taximetro_tacografo']?'X':" "}} ] Taximetro/Tacógrafo</th>
                    <td class="w50"></td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%; position: absolute; right: -17px;">
            <table>
                <tr>
                <th class="w50">Dados Condotur Auxiliar 2</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w50">Nome: {{ $condutor2Nome }}</td>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w50">CPF: {{ $condutor2Cpf }}</td>
                    <td class="w50">RG: {{ $condutor2Rg }}</td>
                </tr>
                <tr>
                    <td class="w30">CNH: {{ $condutor2Cnh }}</td>
                    <td class="w30">CAT: {{ $condutor2CnhCategoria }}</td>
                    <td class="w30">Vencto: {{ $condutor2CnhVencimento }}</td>
                </tr>
                <tr>
                    <td class="w50">[ {{$condutor2AtestadoDeSaude?'X':' '}} ] Atestado de Saúde</td>
                    <td class="w50">[ {{$condutor2RegistroCTPS?'X':' '}} ] Registro na CTPS</td>
                </tr>
                <tr>
                    <td class="w50">[ {{$condutor2CertidaoNegativa?'X':' '}} ] Certidão Neg. Destrib. Criminal</td>
                    <td class="w50">Val: {{ $condutor2CertidaoNegativaValidade }}</td>
                </tr>
                <tr>
                    <td class="w50">[ {{$condutor2CursoPrimeirosSocorros?'X':' '}} ] Cursos - SEST/SENAT</td>
                    <td class="w50">Emissão: {{ $condutor2CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
                <tr>
                    <td class="w100">Mot. Afastamento: {{ $condutor2MotAfastamento }}</td>
                </tr>
                <tr>
                    <td class="w100">Período de Afastamento: De {{ $condutor2PeriodoAfastamentoInicio }} a {{ $condutor2PeriodoAfastamentoFim }}</td>
                </tr>
            </table>
        </div>
        <div class="box" style="width: 50%;">
            <table>
                <tr>
                    <th class="w50">Dados Condotur Auxiliar 1</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w50">Nome: {{ $condutor1Nome }}</td>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w50">CPF: {{ $condutor1Cpf }}</td>
                    <td class="w50">RG: {{ $condutor1Rg }}</td>
                </tr>
                <tr>
                    <td class="w30">CNH: {{ $condutor1Cnh }}</td>
                    <td class="w30">CAT: {{ $condutor1CnhCategoria }}</td>
                    <td class="w30">Vencto: {{ $condutor1CnhVencimento }}</td>
                </tr>
                <tr>
                    <td class="w50">[ {{$condutor1AtestadoDeSaude?'X':' '}} ] Atestado de Saúde</td>
                    <td class="w50">[ {{$condutor1RegistroCTPS?'X':' '}} ] Registro na CTPS</td>
                </tr>
                <tr>
                    <td class="w50">[ {{$condutor1CertidaoNegativa?'X':' '}} ] Certidão Neg. Destrib. Criminal</td>
                    <td class="w50">Val: {{ $condutor1CertidaoNegativaValidade }}</td>
                </tr>
                <tr>
                    <td class="w50">[ {{$condutor1CursoPrimeirosSocorros?'X':' '}} ] Cursos - SEST/SENAT</td>
                    <td class="w50">Emissão: {{ $condutor1CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
                <tr>
                    <td class="w100">Mot. Afastamento: {{ $condutor1MotAfastamento }}</td>
                </tr>
                <tr>
                    <td class="w100">Período de Afastamento: De {{ $condutor1PeriodoAfastamentoInicio }} a {{ $condutor1PeriodoAfastamentoFim }}</td>
                </tr>
            </table>
        </div>

        <div class="box">
            <table>
                <tr>
                    <th class="w20">Dados do Veículo</th>
                    <td class="w20"></td>
                    <td class="w20">Capacidade: {{ $veiculo['capacidade']}}</td>
                    <td class="w20">Vida Útil: {{ $veiculo['anos_vida_util_veiculo']}}</td>
                </tr>
                <tr>
                    <td class="w30">Marca/Modelo {{ $veiculo['marcaModeloVeiculo']['descricao']}}</td>
                    <td class="w10"></td>
                    <td class="w20">Placa:  {{ $veiculo['placa']}}</td>
                    <td class="w20">Normal:  [ ]</td>
                </tr>
                <tr>
                    <td class="w20">Renavan:  {{ $veiculo['cod_renavam']}}</td>
                    <td class="w20">Chassis:  {{ $veiculo['chassi']}}</td>
                    <td class="w20">Combustivel:  {{ $veiculo['tipoCombustivel']['descricao']}}</td>
                    <td class="w20">Homologada:  [ ]</td>
                </tr>
                <tr>
                    <td class="w20">Ano Fabric:  {{ $veiculo['ano_fabricacao']}}</td>
                    <td class="w20">Ano Modelo:  {{ $veiculo['ano_modelo']}}</td>
                    <td class="w20">Cor:  {{ $veiculo['cor']['descricao']}}</td>
                    <td class="w20">Modificada:  [ ]</td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%; position: absolute; right: -17px;">
            <table>
                <tr>
                    <th class="w50">Monitor 3</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w100">Nome: {{ $monitor3Nome }}</td>
                </tr>
                <tr>
                    <td class="w50">RG: {{ $monitor3RG }}</td>
                    <td class="w50">Data Nasc: {{ $monitor3DataNasc }}</td>
                </tr>
                <tr>
                    <td class="w50">Curso de 1° Socorros: {{ $monitor3CursoPrimeirosSocorros }}</td>
                    <td class="w50">Emissão: {{ $monitor3CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%;">
            <table>
                <tr>
                    <th class="w50">Monitor 1</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w100">Nome: {{ $monitor1Nome }}</td>
                </tr>
                <tr>
                    <td class="w50">RG: {{ $monitor1RG }}</td>
                    <td class="w50">Data Nasc: {{ $monitor1DataNasc }}</td>
                </tr>
                <tr>
                    <td class="w50">Curso de 1° Socorros: {{ $monitor1CursoPrimeirosSocorros }}</td>
                    <td class="w50">Emissão: {{ $monitor1CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%; position: absolute; right: -17px;">
            <table>
                <tr>
                    <th class="w50">Monitor 4</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w100">Nome: {{ $monitor4Nome }}</td>
                </tr>
                <tr>
                    <td class="w50">RG: {{ $monitor4RG }}</td>
                    <td class="w50">Data Nasc: {{ $monitor4DataNasc }}</td>
                </tr>
                <tr>
                    <td class="w50">Curso de 1° Socorros: {{ $monitor4CursoPrimeirosSocorros }}</td>
                    <td class="w50">Emissão: {{ $monitor4CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%;">
            <table>
                <tr>
                    <th class="w50">Monitor 2</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w100">Nome: {{ $monitor2Nome }}</td>
                </tr>
                <tr>
                    <td class="w50">RG: {{ $monitor2RG }}</td>
                    <td class="w50">Data Nasc: {{ $monitor2DataNasc }}</td>
                </tr>
                <tr>
                    <td class="w50">Curso de 1° Socorros: {{ $monitor2CursoPrimeirosSocorros }}</td>
                    <td class="w50">Emissão: {{ $monitor2CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%; position: absolute; right: -17px;">
            <table>
                <tr>
                    <th class="w50">Monitor 6</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w100">Nome: {{ $monitor6Nome }}</td>
                </tr>
                <tr>
                    <td class="w50">RG: {{ $monitor6RG }}</td>
                    <td class="w50">Data Nasc: {{ $monitor6DataNasc }}</td>
                </tr>
                <tr>
                    <td class="w50">Curso de 1° Socorros: {{ $monitor6CursoPrimeirosSocorros }}</td>
                    <td class="w50">Emissão: {{ $monitor6CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
            </table>
        </div>

        <div class="box" style="width: 50%;">
            <table>
                <tr>
                    <th class="w50">Monitor 3</th>
                    <td class="w50"></td>
                </tr>
                <tr>
                    <td class="w100">Nome: {{ $monitor3Nome }}</td>
                </tr>
                <tr>
                    <td class="w50">RG: {{ $monitor3RG }}</td>
                    <td class="w50">Data Nasc: {{ $monitor3DataNasc }}</td>
                </tr>
                <tr>
                    <td class="w50">Curso de 1° Socorros: {{ $monitor3CursoPrimeirosSocorros }}</td>
                    <td class="w50">Emissão: {{ $monitor3CursoPrimeirosSocorrosEmissao }}</td>
                </tr>
            </table>
        </div>


    </div>

</body>

</html>
