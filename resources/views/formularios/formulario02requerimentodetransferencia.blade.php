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

        .content .content-signature-left {
        }

        .content .content-signature-left>p {
            text-align: left;
        }

        .content .content-signature-left>div {
            text-align: left;
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

        <h3>ANEXO 02 - REQUERIMENTO DE TRANSFERENCIA</h3>
        <p style="text-align: justify;">O Sr.(a) ________________________________________________, telefone: ________________,
portador do RG ________________________________, CMC ______________________________,
permissionário (a) do serviço de _________________, prefixo ________________, ponto __________,
localizado à _____________________________________________________, desde ___/___/______,
solicita autorização para transferir os direitos do referido ponto para o Sr.(a) _____________________
_______________________, telefone: ________________ , portador do RG _____________________,
CNH __________________________, categoria _______, expedida pela 23ª CIRETRAN de Santo
André, residente à Rua/Av. _____________________________________________________________,
bairro _____________________________, CEP: ________________, no município de Santo André,
proprietário do veículo marca/modelo ______________________________, tipo __________________,
ano __________, placas _________________, que será utilizado na prestação do serviço, conforme
Decreto Municipal n.º ( ) 14.537/00 - escolar ( ) 13.803/96 - taxi.</p>
<p style="text-align: justify;">Declaramos que a documentação necessária seque em anexo e está de acordo com o previsto na
legislação vigente, e ainda que as informações, supra, são verdadeiras, e estamos cientes que a
aprovação da transferência fica condicionada à comprovação das informações declaradas.</p>

        <p style="text-align: center; margin-top: 2cm;">NESTES TERMOS P. DEFERIMENTO</p>

        <p style="text-align: center;">Santo André, {{ $dataFormatada }}</p>

        <div class="content-signature content-signature-left">
            <div>
                <br>
                <br>
                <p>____________________________________________</p>
                <p>Cedente</p>
            </div>
        </div>       
        
        <div class="content-signature content-signature-left">
            <div>
                <br>
                <br>
                <p>____________________________________________</p>
                <p>Cessionário</p>
            </div>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
