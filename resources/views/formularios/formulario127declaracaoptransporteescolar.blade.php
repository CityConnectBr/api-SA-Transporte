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

        <h3>DECLARAÇÃO</h3>

        <p style="text-align: justify;">
        Eu, {{$empresa['nome_do_gerente']}}, na  qualidade  de  Gerente de Controle Operacional e Cadastro, desta  empresa pública, declaro  para  os  devidos fins  que o Sr(a).
        {{$permissionario['nome_razao_social']}} portador(a) do RG nº {{$permissionario['rg']}} e CPF nº {{$permissionario['cpf']}} é permissionário(a) de transporte escolar do município de Santo André, prefixo nº {{$permissionario['prefixo']}}.
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
