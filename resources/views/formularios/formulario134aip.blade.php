<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        html,
        body {
            width: 190mm;
        }

        html {
            font-family: Arial, Helvetica, sans-serif;
        }

        h3{
            text-align: center;
        }

        h5{
            text-align: center;
            margin: 0px;
            padding: 0px;
        }

        .table .td{
            float: left;
            border: 1px solid black;
            padding: 5px;
            min-height: 40px;
        }

        footer .right {
            text-align: right;
            font-size: 10px;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }

        footer .center {
            text-align: center;
            font-size: 11px;
        }

        .table {
            width: 100%;
            margin-left: 0.5cm;
            margin-right: 0.6cm;
        }

        .tr {
            width: 100%;
            margin-bottom: 0.0cm;
            margin-top: -0.2cm;
        }

        .td {
            padding: 5px;
            margin-bottom: 0.0cm;
            margin-top: -0.2cm;
            min-height: 40px;
            width: 100%;
            font-weight: bold;
        }

        .logo {
            margin-left: 1cm;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>Diretoria de Transportes Públicos</h3>

        <div class="table">
            <div class="tr">
                <div class="td" style="width: 261px">
                    <h5>A.I.P. - AUTO DE IMPOSIÇÃO DE PENALIDADE</h5>
                </div>
                <div class="td" style="width: 200px">
                    <b>EMISSÃO<br>
                    {{$dataEmissaoFormatada}}</b>
                </div>
                <div class="td" style="width: 200px">
                    <b>AIP Nº<br>
                    {{$infracao['num_aip']}}</b>
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 685px">
                DESCRIÇÃO DA INFRAÇÃO: {{$infracao['descricao']}}
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -0.4cm;">
            <div class="td" style="width: 685px">
                OBS: {{$infracao['obs_aip']}}
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -0.6cm;">
                <div class="td" style="width: 289px">
                VEÍCULO MARCA/PLACA<br>
                {{$infracao['veiculo']['MarcaModeloVeiculo']['descricao']}}
                </div>
                <div class="td" style="width: 100px">
                PREFIXO<br>
                    {{$infracao['permissionario']['prefixo']}}
                </div>
                <div class="td" style="width: 100px">
                HORÁRIO<br>
                    {{$horarioInfracaoFormatado}}
                </div>
                <div class="td" style="width: 160px">
                DATA OCORRÊNCIA<br>
                {{$dataInfracaoFormatada}}
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -0.8cm;">
                <div class="td" style="width: 174px">
                PROCESSO Nº<br>
                    {{$infracao['num_processo']}}
                </div>
                <div class="td" style="width: 499px">
                LOCAL DA INFRAÇÃO<br>
                    {{$infracao['local']}}
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -1.0cm;">
                <div class="td" style="width: 140px">
                Nº BOLETO<br>
                    {{$npixOuBoleto}}
                </div>
                <div class="td" style="width: 123px">
                VENCIMENTO<br>
                    {{$venctoBoletoFormatado}}
                </div>
                <div class="td" style="width: 124px">
                VALOR DA FMP<br>
                    {{$valorFMPFormatado}}
                </div>
                <div class="td" style="width: 125px">
                MULTA<br>
                    {{$infracao['natureza_infracao']['descricao']}}
                </div>
                <div class="td" style="width: 125px">
                VALOR EM FMP<br>
                    {{$valorEmFMP}}
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -1.2cm;">
                <div class="td" style="width: 413px">
                ATUALIZAÇÃO EM R$<br>
                    &nbsp;
                </div>
                <div class="td" style="width: 260px">
                VALOR EM R$<br>
                {{$valorEmFMPFormatado}}
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -1.4cm;">
                <div class="td" style="width: 219px;height: 160px;">
                    <br>
                    <br>
                    <p>________________________</p>
                    <p>DIRETORIA DE TRANSPORTES PÚBLICOS</p>
                </div>
                <div class="td" style="width: 219px;height: 160px;">
                    <br>
                    <br>
                    <p>________________________</p>
                    <p>GERENCIA DE CONTROLE OPERACIONAL E CADASTRO</p>
                </div>
                <div class="td" style="width: 223px;height: 160px;">
                    <br>
                    <p>________________________</p>
                    <p>INFRATOR</p>
                    <p>Data: ____/____/____</p>
                </div>
            </div><br><br><br><br><br><br><br><br><br>
            <div class="tr" style="margin-top: -1.492cm; width: 686px">
                <div class="td">
                    OBS.: À esta autuação cabe recurso que deve ser enviado ao Superintendente da SA-TRANS no
                    prazo de 10 (dez) dias úteis, a partir do recebimento do AIP, nos termos da Lei 7.615 de 30/12/97.
                    Documentos necessários - Cópia simples: da notificação; documento de identidade oficial; contrato
                    social (pessoal jurídica); AIP - Auto de infração de Penalidade; alvará de Permissão; razões escritas
                    dos fatos e provas que eventualmente levariam à anulação do respectivo auto de infração e ao
                    conseqüente cancelamento da penalidade.
                </div>
            </div>
            </div><br><br><br>
        </div>


    <footer>
        <p class="center">{{ $empresa['endereco']['endereco']}}, {{ $empresa['endereco']['numero']}}, {{ $empresa['endereco']['complemento']}} - {{ $empresa['endereco']['bairro']}} - Santo André/SP, CEP {{ $empresa['endereco']['cep']}}</p>
        <p class="center">Telefone: {{ $empresa['telefone']}} - {{ $empresa['email']}}</p>

        <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
    </footer>
</div>

</body>

</html>
