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
        }

        .logo {
            width: 100px;
            margin-left: 1cm;
        }

        .content p {
            margin-bottom: 0.3cm;
            line-height: 0.6cm;
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
    </style>
</head>

<body>
    <div class="content">
        <img src="http://santoandretransporte.cityconnect.com.br/assets/images/sa_logo.png" alt="logo" class="logo">

        <h3>ANEXO 01 - REQUERIMENTO DE RENOVAÇÃO DE PERMISSÃO</h3>
        <p>O permissionário do serviço de <b>Taxi</b>,<br>
            Sr.(a) <b>{{$obj['nome_razao_social']}}</b>,<br>
            telefone: <b>{{$obj['telefone']}}</b>, prefixo: <b>{{$obj['prefixo']}}</b>, veículo placas: <b>@foreach($placas as $placa) {{$loop->index>0?', ':''}}{{$placa}} @endforeach</b><br>
            solicita a renovação do alvará de prestação de serviço, informando ainda que mantém todas as condições
            exigidas para o exercício da atividade.
        </p>

        <p>Declaro, sob as pena da lei, que não houve nenhuma alteração em meus dados cadastrais</p>

        <div class="content-signature content-signature-right">
            <p>Santo André, {{$dataFormatada}}</p>
            <div>
                <br>
                <br>
                <p>____________________________________________</p>
                <p>ABIGAIL RUEDA BERNEIRA</p>
            </div>
        </div>

        <p>Informo que o permissionário não possui débito junto à SA TRANS e que a documentação
            apresentada foi conferida e está de acordo com o Decreto Municipal.</p>

        <p>Nome: _________________________ Data: _____/______/______, Assinatura: _____________</p>
        <p>______________________________________________________________________________</p>

        <p>Veículo:<b> ( ) Aprovado ( ) Reprovado</b></p>

        <div class="separator-top separator-bottom">
            <p>Documentação conferida por:</p>
            <p>Assinatura do encarregado ____________________________ Data ______/______/_______</p>
        </div>

        <div class="content-left">
            <p>Parecer da GCOC</p>
            <p><b>De acordo,</b></p>
            <div class="content-signature">
                <p>_____________________________________</p>
                <p><b>Gerente de Controle Operacional e Cadastro</b></p>
            </div>
            <p>Data ____/_____/______</p>
        </div>

        <div class="content-right">
            <p>Parecer da DTP</p>
            <p><b>Autorizo,</b></p>
            <div class="content-signature">
                <p>_____________________________________</p>
                <p><b>Diretor(a) de Transportes Públicos</b></p>
            </div>
            <p>Data ____/_____/______</p>
        </div>

        <footer>
            <p>Impresso por {{$usuario['nome']}} do {{date('d/m/Y H:i', time())}}</p>
        </footer>
    </div>

</body>

</html>
