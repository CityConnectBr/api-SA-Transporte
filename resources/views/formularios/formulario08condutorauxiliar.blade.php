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
            font-size: 12.5px;
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
            margin-right: -1cm;
        }

        .p-bold-underline b {
            text-decoration: underline;
        }

        .auxiliar-info p {
            margin-top: 0.1cm;
            margin-bottom: 0.1cm;
        }

        .table-border {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        .table-border tr td {
            border: 1px solid #000;
            padding: 0.2cm;
            height: 2cm;
        }
    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <div class="foto3x4">Foto 3x4</div>

        <h3>ANEXO 08 - CONDUTOR AUXILIAR ({{$inscricaoOuRenovacao!=null && $inscricaoOuRenovacao==2?'X':'  '}}) INSCRIÇÃO &nbsp;({{$inscricaoOuRenovacao!=null && $inscricaoOuRenovacao==1?'X':'   '}}) RENOVAÇÃO</h3>

        <p class="p-bold-underline" style="margin-bottom: 0.0cm;">Eu, <b>{{$permissionario['nome_razao_social']}}</b>, permissionário(a) do serviço de <b>{{$modalidadeDoPermissionario!=null?$modalidadeDoPermissionario['descricao']:'--'}}</b>, neste município com o prefixo <b>{{$permissionario['prefixo']}}</b>, telefone <b>{{$permissionario['telefone']}}</b>, venho solicitar a inscrição / renovação em cadastro do(a)</p>

        <div class="auxiliar-info">
        <p>Sr(a) <b>{{$nomeCondutor!=null?$nomeCondutor:'____________________________________________________'}}</b> RG: <b>{{$rgCondutor!=null?$rgCondutor:'__________________'}}</b>,</p>
        <p>CNH <b>{{$cnhCondutor!=null?$cnhCondutor:'_________________________'}}</b>, Categoaria: <b>{{$categoriaCNHCondutor!=null?$categoriaCNHCondutor:'__________________'}}</b>, telefone: <b>{{$telefoneCondutor!=null?$telefoneCondutor:'_____________'}}</b>,</p>
        <p>residente à <b>{{$enderecoCondutor!=null?$enderecoCondutor:'______________________________________________________________________'}}</b>,</p>
        <p>E-mail: <b>{{$emailCondutor!=null?$emailCondutor:'_____________________________________________________________________'}}</b> na condição de condutor auxiliar.</p>
        </div>
        <p><b>Declaro que toda documentação necessária segue em anexo e que me responsabalilizo solidariamente, por todos os atos praticados pelo Condutor Auxiliar/Preposto.</b></p>

        <div class="content-signature content-signature-right">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="float: left;">
                <br>
                <p>________________________________</p>
                <p>Permissionário</p>
            </div>

            <div style="float: right;">
                <br>
                <p>________________________________</p>
                <p>Condutor Auxiliar/Preposto</p>
            </div>
        </div>

        <div style="margin-top: 0.1cm">
            <p>
            Solicitação recebida e documentos conferidos por ___________________________________________________ em _____/______/______, assinatura: _____________________________________________________
            </p>
        </div>

        <div style="margin-top: -0.5cm">
            <p>
                Conferida por ______________________________________________________________ em _____/______/______, assinatura: ______________________________________________________________
            </p>
        </div>

        <table class="table-border">
            <tr>
                <td style="width: 2cm;">
                    <p>
                       (&nbsp;&nbsp;&nbsp;) CNH - xerox
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Atestado de saúde original
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Foto 3x4
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Docto que comprove vínculo empregatício (escolar) - xerox
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) RG - xerox
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Certidão de distribuição criminal original
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Credencial DETRAN (escolares) - xerox
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Autorização de transporte escolar emitida pela CIRETRAN na CNH - xerox
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) CPF - xerox
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Comprovante de residência - xerox
                    </p>
                </td>
                <td>
                    <p>
                       {{-- Boleto Pago: (&nbsp;&nbsp;&nbsp;) sim (&nbsp;&nbsp;&nbsp;) não --}}
                    </p>
                </td>
                <td>
                    <p>
                       (&nbsp;&nbsp;&nbsp;) Certificado do curso de primeiros socorros realizado em Santo André - Escolar
                    </p>
                </td>
            </tr>
            {{-- <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    <p>
                        (&nbsp;&nbsp;&nbsp;) Certificado do curso de Taxistas
                    </p>
                </td>
            </tr> --}}
        </table>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
