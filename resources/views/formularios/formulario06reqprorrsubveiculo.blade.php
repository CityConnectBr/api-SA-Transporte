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
            line-height: 0.4cm;
        }

        .separacao{
            width: 100%;
            margin-top: .5cm;
            border-top: 4px solid #000;
        }

        .parecer{
            width: 100%;
            margin-top: 0.5cm;
            border-top: 4px solid #000;
        }

        .parecer-bold p {
            font-weight: bold;
        }

        .parecer-p1{
            width: 49%;
            float: left;
        }

        .parecer-p2{
            width: 49%;
            float: right;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">


        <h3>ANEXO 06 - REQUERIMENTO P/PRORROGAÇÃO DE SUBSTITUIÇÃO DE VEÍCULO</h3>
        <p style="text-align: justify">O permissionário do serviço de <b>Taxi</b>,<br>
            Sr.(a) <b>{{ $obj['permissionario']['nome_razao_social'] }}</b>,<br>
            telefone: <b>{{ $obj['permissionario']['telefone'] }}</b>, prefixo: <b>{{ $obj['permissionario']['prefixo'] }}</b>.
            Solicita prazo de 1 ano para a substituição do veículo devido a idade
            marca/modelo <b>{{ $obj['marcaModeloVeiculo']['descricao'] }}</b>, ano <b>{{ $obj['ano_modelo'] }}</b>, placa <b>{{ $obj['placa'] }}</b>
            esta solicitação esta condicionada à realização de vistoria e sua aprovação.
        </p>

        <div class="content-signature content-signature-right">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="float: right;">
                <br>
                <p>____________________________________________</p>
                <p>Permissionário</p>
            </div>
        </div>

        <div style="margin-top: 1.5cm">
            <p>
            Solicitação recebida e documentos conferidos por ____________________________________ em _____/______/______, assinatura: _______________________________________________
            </p>
        </div>

        <div class="separacao">
            <p>
            Veículo: <b>( &nbsp;&nbsp;&nbsp;&nbsp;) Aprovado ( &nbsp;&nbsp;&nbsp;&nbsp;) Reprovado</b>
            </p>
        </div>

        <div class="separacao">
            <p>
            Documentação conferida por:
            </p>
            <p>
            Assinatura do encarregado ____________________________ Data ______/______/_______
            </p>
        </div>

        <div class="parecer">
            <div class="parecer-p1">
                <p>Parecer da GCOC</p>
                <p><b>De acordo,</b></p>
                <div class="content-signature content-signature-left parecer-bold">
                    <div>
                        <p>____________________________________</p>
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
                        <p>____________________________________</p>
                        <p>Diretor(a) de Transportes Públicos</p>
                    </div>
                </div>
                <p>Data: ____/____/_______</p>
            </div>
        </div>


        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
