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
    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>ANEXO 07 - DECLARAÇÃO DE MONITOR</h3>
        <p>Eu, <b style="text-decoration: underline;">{{$permissionario['nome_razao_social']}}</b>, permissionário(a) do serviço de transporte escolar neste município com o prefixo <b style="text-decoration: underline;"">{{$permissionario['prefixo']}}</b>, em cumprimento à Lei Municipal nº. 8.038 de 09 de junho de 2000, art. 7º "no transporte de estudantes será obrigatória a presença de um Monitor, para auxiliar o condutor nas operações de embarque e desembarque" e ao Decreto Municipal nº. 14.538 de 15 de agosto de 2000, Art. 8º Parágrafo único <b>"os monitores deverão estar devidamente cadastrados junto à SA-TRANS"</b> , solicito a</p>

        <p style="font-weight: bold;">INCLUSÃO DE:</p>
        <p>Nome: <b>{{$solicitacao!=null && $solicitacao['campo10']!=null?$solicitacao['campo10']:'_________________________'}}</b> RG: <b>{{$solicitacao!=null && $solicitacao['campo11']!=null?$solicitacao['campo11']:'__________________'}}</b>, CPF: <b>{{$solicitacao!=null && $solicitacao['campo12']!=null?$solicitacao['campo12']:'______________'}}</b>,</p>
        <p>Endereço: <b>{{$enderecoSolicitacao!=null?$enderecoSolicitacao:'_____________________________________________'}}</b>,</p>
        <p>E-mail: <b>{{$solicitacao!=null && $solicitacao['campo1']!=null?$solicitacao['campo1']:'__________________________________________________'}}</b>Tel: <b>{{$solicitacao!=null && $solicitacao['campo2']!=null?$solicitacao['campo2']:'______________.'}}</b></p>
        <hr>
        <p style="font-size: 12px;">OBS: Na inclusão deverão ser apresentados: cópia do RG e do CPF e Informado endereço, telefone e e-mail.</p>

        <p style="font-weight: bold;">EXCLUSÃO DE:</p>
        <hr>
        <p>Nome: <b>{{$monitor!=null?$monitor['nome']:'_________________________'}}</b> RG: <b>{{$monitor!=null?$monitor['rg']:'__________________'}}</b>, CPF: <b>{{$monitor!=null?$monitor['cpf']:'______________'}}</b>,</p>
        <p>Declaro estar ciente que o monitor no exercício de sua atividade deve obrigatoriamente documento de identidade (RG).</p>

        <div class="content-signature content-signature-right">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="float: right;">
                <br>
                <p>____________________________________________</p>
                <p>{{ $permissionario['nome_razao_social'] }}</p>
            </div>
        </div>

        <div style="margin-top: 1.5cm">
            <p>
            Solicitação recebida e documentos conferidos por ____________________________________ em _____/______/______, assinatura: _______________________________________________
            </p>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
