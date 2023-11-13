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

        .content .content-left {
            width: 50%;
            float: left;
        }

        .content .content-right {
            width: 50%;
            float: right;
        }

        .content hr {
            height: 2px;
            border-width: 0;
            color: gray;
            background-color: gray;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }

        .content footer p {
            text-align: right;
            font-size: 10px;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }

        .content .separator-top {
            border-top: 1px solid #000;
            margin-top: 0.5cm;
        }

        .content .separator-bottom {
            border-bottom: 1px solid #000;
            margin-bottom: 0.5cm;
        }

        .content .content-signature-right {
            margin: 1cm;
        }

        .content .content-signature-right>p {
            text-align: right;
        }

        .content .content-signature-right>div {
            text-align: center;
        }

        .content-signature p {
            margin-bottom: 0.0cm;
            line-height: 0.1cm;
        }

        .foto3x4 {
            width: 3cm;
            height: 4cm;
            float: right;
            border: 1px solid #000;
            text-align: center;
            line-height: 4cm;
        }
    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>ANEXO 17 - SOLICITAÇÃO DE BAIXA DE CONDUTOR AUXILIAR NO CADASTRO</h3>
        <p>Eu, <b>{{$permissionario['nome_razao_social']}}</b>, telefone <b>{{$permissionario['telefone']}}</b>, prefixo <b>{{$permissionario['prefixo']}}</b>, permissionário(a) do serviço de <b>{{$modalidadeDoPermissionario!=null?$modalidadeDoPermissionario['descricao']:'--'}}</b>, neste município solicitar a BAIXA da inscrição em cadastro do
            (a) Sr.(a) <b>{{$condutor['nome'] ? $condutor['nome'] : '_____________________________________________'}}</b>, RG <b>{{$condutor['rg'] ? $condutor['rg'] : '___________________________'}}</b>, CNH <b>{{$condutor['cnh'] ? $condutor['cnh'] : '_______________________'}}</b>, Categoria, <b>{{$condutor['categoria_cnh'] ? $condutor['categoria_cnh'] : '______________'}}</b>, na condição de condutor auxiliar.
        </p>


        <div class="content-signature content-signature-right">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="float: right;">
                <br>
                <p>____________________________________________</p>
                <p>{{ $permissionario['nome_razao_social'] }}</p>
            </div>
        </div>

        <div style="margin-top: 1.5cm;">
            <p>Solicitação recebida por: _____________________________________ em _____/______/_______, Assinatura ______________________</p>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
