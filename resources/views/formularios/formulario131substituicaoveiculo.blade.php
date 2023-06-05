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
        }

        .logo {
            width: 100px;
            margin-left: 1cm;
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
            font-size: 11px;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <p class="data_cabecalho">Santo André, {{ $dataFormatada }}</p>

        <p>À<br>23º Ciretran</p>

        <p>Srº Diretor,</p>
        <p style="text-align: justify;">
        Encaminhamos o Sr. {{$permissionario['nome']}}, Prefixo {{$permissionario['prefixo']}}, para cadastrar o veículo, placa {{$veiculo['placa']}}, 
        chassis {{$veiculo['MarcaModeloVeiculo']['descricao']}}, ano {{$veiculo['ano_modelo']}}, cor {{$veiculo['cor']['descricao']}}, 
        para ser utilizado em substituição ao veículo, {{$veiculo['MarcaModeloVeiculo']['descricao']}}, placa {{$veiculo['placa']}}, ano {{$veiculo['ano_modelo']}}, cor {{$veiculo['cor']['descricao']}},
        como {{$permissionario['modalidade']['descricao']}} no ponto {{$ponto['ponto']['descricao']}}.
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
