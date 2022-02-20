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
        <img src="http://santoandretransporte.cityconnect.com.br/assets/images/sa_logo.png" alt="logo" class="logo">

        <div class="foto3x4">Foto 3x4</div>

        <h3>ANEXO 08 - CONDUTOR AUXILIAR</h3>
        <h4>({{$inscricaoOuRenovacao!=null && $inscricaoOuRenovacao==0?'X':'__'}}) INCRIÇÃO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;({{$inscricaoOuRenovacao!=null && $inscricaoOuRenovacao==1?'X':'__'}}) RENOVAÇÃO</h4>
        <p>Eu, <b>{{$permissionario['nome_razao_social']}}</b>, permissionário(a) do serviço de <b>{{$permissionario['nome_razao_social']}}</b>, neste município com o prefixo <b>{{$permissionario['prefixo']}}</b>, telefone <b>{{$permissionario['telefone']}}</b>, venho solicitar a inscrição / renovação em cadastro do(a)</p>

        <p>Sr(a) <b>{{$nomeCondutor!=null?$nomeCondutor:'_________________________'}}</b> RG: <b>{{$rgCondutor!=null?$rgCondutor:'__________________'}}</b>,</p>
        <p>CNH <b>{{$cnhCondutor!=null?$cnhCondutor:'_________________________'}}</b>  Categoaria: <b>{{$categoriaCNHCondutor!=null?$categoriaCNHCondutor:'__________________'}}</b>, Telefone: <b>{{$telefoneCondutor!=null?$telefoneCondutor:'_____________'}}</b>,</p>
        <p>Residente à <b>{{$enderecoCondutor!=null?$enderecoCondutor:'______________________________________________________________________'}}</b>,</p>
        <p>E-mail: <b>{{$emailCondutor!=null?$emailCondutor:'__________________________________________________________________________'}}</b></p>

        <p><b>Declaro que toda documentação necessária segue em anexo e que me responsabalilizo solidariamente, por todos os atos praticados pelo Condutor Auxiliar/Preposto.</b></p>

        <table>
            <tr>
                <td style="width: 2cm;">
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) CNH</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Atestado de saúde</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Foto 3x4</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Docto que comprove vínculo empregatício (escolar)</b>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) RG</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Certidão de distribuição criminal original</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Credencial DETRAN (escolares)</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Autorização de transporte escolar emitida pela CIRETRAN na CNH</b>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) CPF</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Comprovante de residência</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>Boleto Pago: (&nbsp;&nbsp;&nbsp;) sim (&nbsp;&nbsp;&nbsp;) não</b>
                    </p>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Certificado do curso de primeiros socorros realizado em Santo André - Escolar</b>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                    <p>
                        <b>(&nbsp;&nbsp;&nbsp;) Certificado do curso de Taxistas</b>
                    </p>
                </td>
            </tr>
        </table>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
