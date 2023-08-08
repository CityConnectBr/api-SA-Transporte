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
            font-size: 13px;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <p class="data_cabecalho">Santo André, {{ $dataFormatada }}</p>

        <h3>NOTIFICAÇÃO</h3>

        <p style="font-weight: bold;">Prezado(a) Senhor(a),</p>
        <p style="text-align: justify;">
        Notificamos para que no prazo de {{$prazo}} vossa senhoria regularize a autorização/permissão {{$permissionario['prefixo']}}, recolhendo as taxas e multas em atraso, sob pena de descredenciamento para autorização para o transporte escolar.
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

        <br>
        <p style="font-weight: bold;">
            AO<br>
            {{$notificado}}<br>
            Prefixo {{$permissionario['prefixo']}}<br>
            {{$permissionario['endereco']['endereco']}}<br>
        </p>

        <footer>
            <p class="center">{{ $empresa['endereco']['endereco']}}, {{ $empresa['endereco']['numero']}}, {{ $empresa['endereco']['complemento']}} - {{ $empresa['endereco']['bairro']}} - Santo André/SP, CEP {{ $empresa['endereco']['cep']}}</p>
            <p class="center">Telefone: {{ $empresa['telefone']}} - {{ $empresa['email']}}</p>

            {{-- <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p> --}}
        </footer>
    </div>

</body>

</html>
