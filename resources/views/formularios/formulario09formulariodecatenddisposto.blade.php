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

        .content .content-signature {
        }

        .content .content-signature>p {
            text-align: center;
        }

        .content .content-signature>div {
            text-align: center;
        }

        .content-signature p {
            margin-bottom: 0.0cm;
            line-height: 0.1cm;
        }

        table {
            width: 100%;
        }

        .table-border {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        tr {
            border: 1px solid #000;
        }

        thead {
            height: 2cm;
        }

        th {
            border: 1px solid #000;
            text-align: center;
            text-decoration: underline;
        }

        td {
            border: 1px solid #000;
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



    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>ANEXO 09 - DECLARAÇÃO DE ATENDIMENTO AO DISPOSTO NO ART. 9º, INC. II DA LEI MUNICIPAL N.º 8.038/00.</h3>
        <p>
        Eu, _________________________________________________________________, transportador
        escolar cadastrado na SA-TRANS, com o prefixo nº _________________, declaro que transporto os
        alunos abaixo relacionados, para fins de cumprimento ao disposto no artigo 9º, inciso II da<br>
        Lei 8.038/00:
        </p>
        <p>
        <b>Art. 9º</b> Na prestação dos serviços, todos os Permissionários obrigam-se a:
        </p>
        <p>
        I - (...)
        </p>
        <p style="font-weight: bold;">
        "II - Manter contratos individuais de prestação de serviço com os responsáveis pelos alunos transportados;"
        </p>
        <p style="font-weight: bold;">
        ESCOLA: ___________________________________________
        </p>

        <table class="table-border">
            <thead>
                <tr>
                    <th>Nome do Aluno</th>
                    <th style="width: 1.5cm;">Entrada</th>
                    <th style="width: 1.4cm;">Saída</th>
                    <th>Responsável</th>
                    <th>Telefone</th>
                    <th style="width: 5cm;">E-mail</th>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
        </table>

        <p style="text-decoration: underline; font-weight: bold;">
        OBS.: A listagem pode continuar em folha anexa a este formulário
        </p>

        <p>
        Declaro que mantenho contratos firmados com os responsáveis pelos alunos aqui relacionados, e que os mesmos estão à disposição da SA-TRANS para eventuais conferências.
        </p>

        <p style="margin-top: 0.0cm">
        Comprometo-me, em caso de alteração desta listagem, a encaminhar a SA-TRANS, no prazo de 02 dias úteis, as correções efetuadas.
        </p>

        <div class="content-signature content-signature-right" style="margin-bottom: 2.0cm;">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="float: right;">
                <br>
                <p>____________________________________________</p>
                <p>Permissionário</p>
            </div>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
