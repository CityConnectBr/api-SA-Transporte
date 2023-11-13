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

        .content {
            margin: 0px;
            margin-left: 1cm;
            margin-right: 1cm;
        }

        .logo {
            width: 100px;
        }

        .content p {
            margin-bottom: 0.3cm;
            line-height: 0.7cm;
        }

        .data_cabecalho{
            float: right;
        }

        .content-signature{
            margin-top: 2cm;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .content footer .right {
            text-align: right;
            font-size: 10px;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }

        .content footer .center {
            text-align: center;
            font-size: 15px;
        }

        footer {
            position:fixed;
            left:0px;
            bottom:0px;
            width:100%;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <p class="data_cabecalho">Santo André, {{ $dataFormatada }}</p>

        <p style="font-weight: bold;">À<br>23º Ciretran</p>

        <p style="font-weight: bold;">Srº Diretor,</p>
        <p style="text-align: justify;">
        Encaminhamos o Sr. <b>{{$permissionario['nome_razao_social']}}</b>, Prefixo <b>{{$permissionario['prefixo']}}</b>, para cadastrar o veículo, placa <b>{{$veiculo1['placa']}}</b>,
        chassis <b>{{$veiculo1['chassi']}}</b>, ano <b>{{$veiculo1['ano_modelo']}}</b>, cor <b>{{$veiculo1['cor']['descricao'] ?? $veiculo1['cor']}}</b>,
        para ser utilizado em substituição ao veículo, <b>{{$veiculo2['MarcaModeloVeiculo']['descricao']}}</b>, placa <b>{{$veiculo2['placa']}}</b>, ano <b>{{$veiculo2['ano_modelo']}}</b>, cor <b>{{$veiculo2['cor']['descricao']}}</b>,
        como <b>{{$permissionario['modalidade']['descricao']}}</b> no ponto <b>{{$ponto['ponto']['descricao']}}</b>.
        </p>

        <div class="content-signature">
            <p>Atenciosamente,</p>
            <div>
                <br>
                <br>
                <p><b>{{$empresa['nome_do_gerente']}}</b></p>
                <p>Gerente Controle Operacional e Cadastro</p>
                <p>SA-TRANS - Santo André Transportes</p>
            </div>
        </div>

        <footer>
            <p class="center">{{ $empresa['endereco']['endereco']}}, {{ $empresa['endereco']['numero']}}, {{ $empresa['endereco']['complemento']}} - {{ $empresa['endereco']['bairro']}} - Santo André/SP, CEP {{ $empresa['endereco']['cep']}}</p>
            <p class="center">Telefone: {{ $empresa['telefone']}} - {{ $empresa['email']}}</p>

            <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
