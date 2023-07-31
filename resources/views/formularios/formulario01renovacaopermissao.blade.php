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

        .hr-bold {
            height: 3px;
            border: none;
            color: #000000;
            background-color: #000000;
        }

        .flex-container {
            display: flex;
            justify-content: center;
            align-items: center;
            /* flex-flow: row nowrap; */
            flex-direction: row;
            flex-wrap: nowrap;
            padding: 15px;
            gap: 5px;
        }

        .signature-line {
            width: 100%;
            margin-bottom: 0%;
        }

        .signature-desc {
            margin-top: 0%;
        }

        .parecer{
            width: 100%;
            margin-top: 1.5cm;
            border-top: 4px solid #000;
        }

        .parecer-p1{
            width: 50%;
            float: left;
        }

        .parecer-bold p {
            font-weight: bold;
        }

        .parecer-p2{
            width: 50%;
            float: right;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">


        <h3>ANEXO 01 - REQUERIMENTO DE RENOVAÇÃO DE PERMISSÃO</h3>
        <p>O permissionário do serviço de <b>Taxi</b>,<br>
            Sr.(a) <b>{{ $obj['nome_razao_social'] }}</b>,<br>
            telefone: <b>{{ $obj['telefone'] }}</b>, prefixo: <b>{{ $obj['prefixo'] }}</b>, veículo placas: <b>
                @foreach ($placas as $placa)
                    {{ $loop->index > 0 ? ', ' : '' }}{{ $placa }}
                @endforeach
            </b>
            solicita a renovação do alvará de prestação de serviço, informando ainda que mantém todas as condições
            exigidas para o exercício da atividade.
        </p>

        <p>Declaro, sob as pena da lei, que não houve nenhuma alteração em meus dados cadastrais.</p>

        <div class="content-signature content-signature-right">
            <p  style="float: right;"> Santo André, {{ $dataFormatada }}</p>
            <div>
                <br>
                <br>
                <div  style="float: right;">
                    <p>____________________________________________</p>
                    <p>{{ $obj['nome_razao_social'] }}</p>
                </div>
            </div>
        </div>
        <br>

        <div>
            <p style="line-break: auto">Nome:___________________ Data:___/___/____, Assinatura: ______________________________</p>
            <hr>
        </div>

        <p>Informo que o permissionário não possui débito junto à SA TRANS e que a documentação apresentada foi conferida e está de acordo com o Decreto Municipal.</p>

        <p>Veiculo:<b > ( ) Aprovado ( ) Reprovado</b></p>

        <hr class="hr-bold">

        <p>Documentação conferida por:</p>
        <p style="margin-bottom: 2px;">Assinatura do encarregado ____________________________________ Data ____/____/_____</p>

        <div class="parecer">
            <div class="parecer-p1">
                <p>Parecer da GCOC</p>
                <p><b>De acordo,</b></p>
                <div class="content-signature content-signature-left parecer-bold">
                    <div>
                        <br>
                        <br>
                        <p>______________________________________</p>
                        <p>Gerente de Controle Operacional e Cadastro</p>
                    </div>
                </div>
                <p>Data: ____/____/_______</p>
            </div>


            <div class="parecer-p2">
                <p>Parecer da DTP</p>
                <p><b>Autorizo,</b></p>
                <div class="content-signature content-signature-left parecer-bold">
                    <div>
                        <br>
                        <br>
                        <p>______________________________________</p>
                        <p>Diretor(a) de Transportes Públicos</p>
                    </div>
                </div>
                <p>Data: ____/____/_______</p>
            </div>
        </div>
        <br> <br>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>



</body>

</html>
