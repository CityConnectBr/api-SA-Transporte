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
            margin-bottom: 1cm;
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

        .separacao{
            width: 100%;
            border-top: 4px solid #000;
        }

        .parecer-p1{
            width: 50%;
            float: left;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">


        <h3>ANEXO 16 - SOLICITAÇÃO DE RESSARCIMENTO</h3>
        <p style="text-align: justify;">
Eu, ______________________________________ permissionário do serviço de _______________,
prefixo &nbsp;nº ___________________________________, &nbsp;venho &nbsp;solicitar &nbsp;a &nbsp;devolução do &nbsp;valor&nbsp;
de R$ ________________________, pago através do boleto nº ______________________, referente à
multa de transporte deferida através do Processo nº _____________________________________.
        </p>

        <p style="font-weight: bold;">
        ( &nbsp;&nbsp;&nbsp;) Depósito em Banco: ______________ AG ____________ C/C ___________________
        </p>

        <p style="font-weight: bold;">
        ( &nbsp;&nbsp;&nbsp;) Cheque nominal em nome do solicitante
        </p>


        <div class="content-signature content-signature-right">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="float: right;">
                <br>
                <p>____________________________________________</p>
                <p>Permissionário</p>
            </div>
        </div>

        <div style="margin-top: 1.5cm;">
            <p>
            Solicitação recebida e documentos conferidos por _____________________________________ em _____/______/______, assinatura: _______________________________________________
            </p>
        </div>

        <div class="separacao">
            <p>
            Situação do Permissionário ( &nbsp;&nbsp;&nbsp;) Regular ( &nbsp;&nbsp;&nbsp;) Irregular &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Obs: ____________________
            </p>
            <p>
            Assinatura do encarregado ____________________________ Data ______/______/_______
            </p>
        </div>

        <div class="separacao">
            <p>
            Data do pagamento do boleto __________/__________/________________
            </p>
            <p>
            valor pago R$ __________________ (________________________________________________)
            </p>
        </div>

        <p>
        Assinatura do Setor Financeiro__________________________ Data ______/________/__________
        </p>

        <p>Parecer do DTP</p>
        <p><b>Autorizo,</b></p>
        <div class="content-signature content-signature-left" style="font-weight: bold; margin-bottom: 1.0cm;">
            <div style="float: left;">
                <p>______________________________________</p>
                <p>Diretori(a) de Transportes Públicos</p>
            </div>
            <p style="float: right">Data: ____/____/_______</p>
        </div>

        <footer style="width: 100%; position: relative;">
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
