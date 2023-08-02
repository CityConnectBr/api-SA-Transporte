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
            font-size: 13px;
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
            line-height: 0.5cm;
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

        .content .content-signature-left>p {
            text-align: center;
        }

        .content .content-signature-left>div {
            text-align: left;
        }

        .content-signature p {
            margin-bottom: 0.0cm;
            line-height: 0.1cm;
        }

        .questionario p{
            margin-bottom: 0.0cm;
            margin-top: 0.0cm;
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
            width: 50%;
            float: left;
        }

        .parecer-p2{
            width: 50%;
            float: right;
        }

        .esquadro-foto{
            width: 3cm;
            height: 4cm;
            border: 1px solid #000;
            float: right;
        }

        .esquadro-foto p{
            text-align: center;
            line-height: 2cm;
        }

        .diretor p {
            margin-top: 1px;
            margin-bottom: 1px;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <div class="esquadro-foto">
            <p>Foto 3x4</p>
        </div>

        <h3>ANEXO 04 - TRANSFERÊNCIA DE PERMISSÃO DE TÁXI</h3>
        <div class="diretor">
            <p style="text-align: justify; font-weight: bold;">
            Sr.(a) Diretor(a) do Departamento de Transportes Públicos
            </p>
            <p style="text-align: justify;">
            Prefixo nº _________________________ Data da Transferência anterior _______/_______/_______
            </p>
            <p style="text-align: justify;">
            Ponto nº ____________________ Escola ______________________________________________
            </p>
            <p style="text-align: justify; font-weight: bold;">
            CESSIONÁRIO: ___________________________________________________________________
            </p>
            <p style="text-align: justify;">
            Endereço ___________________________________________________________ nº __________
            </p>
            <p style="text-align: justify;">
            Bairro _____________________________ CEP.: _______________ Tels. ___________________
            </p>
            <p>
            Para Transferência da permissão qualificada acima, foi apresentada a seguinte documentação:
            </p>
        </div>
        <div class="questionario">
            <p>
            ( &nbsp;&nbsp;&nbsp;) Requerimento padrao preenchido
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Foto 3X4
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) CNH de Santo André Cat."B" ______________________ Validade ______/______/________
C/Obs: "Exerce Atividade Remunerada"
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Certificado de Curso de Taxista
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) RG ________________________
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) CPF________________________
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Certidão negativa do registro de distribuição criminal, relativa aos crimes de homicídio, roubo,
    estupro e corrupção de menores - Forum de Santo André - Validade ______/______/_______
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Atestado de Saúde
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Comprovante de residencia em Santo André
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) CRLV (Categoria Aluguel)
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) DPVAT - seguro obrigatório
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Aferição de taxímetro em ______/_______/_______ Taximetro ________________
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Vistoria com aprovação da SA-TRANS - laudo
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Inscrição no Cadastro Mobiliário (CMC) _________________________
            </p>
        </div>

        <p style="text-align: justify;">
        Solicitação recebida e documentos conferidos por _____________________________________ em
_____/______/________, assinatura _________________________________________________
        </p>

        <div style="magin-bottom: 0.0cm;">
        <p>
        Informo que o cedente não possui débito junto à SA-TRANS e que a documentação apresentada pelo
cessionário foi conferida e está de acordo com o Decreto Municipal nº 13.803/96.
        </p>
        </div>
        <div class="content-signature-left" style="margin-top: 0.0cm; margin-bottom: 0.0cm">
            <div class="content-signature">
                <p>____________________________________________  <span style="margin-left: 2cm;">Data ______/______/_______</span></p>
                <p>Encarregado Setor de Cadastro</p>
            </div>
        </div>

        <div class="parecer">
            <div class="parecer-p1">
                <p>Parecer da GCOC</p>
                <p><b>De acordo,</b></p>
                <div class="content-signature content-signature-left parecer-bold">
                    <div>
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
                        <p>______________________________________</p>
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
