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

        h3{
            text-align: center;
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
            margin-bottom: 0.1cm;
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
            margin: 0.0cm;
            margin: 0.0cm;
            line-height: 0.45cm;
        }

        .parecer{
            width: 100%;
            margin-top: 0.2cm;
            border-top: 4px solid #000;
        }

        .parecer-bold p {
            font-weight: bold;
        }

        .parecer-p1{
            width: 50%;
            float: left;
            margin-top: 0.1cm;
        }

        .parecer-p2{
            width: 50%;
            float: right;
            margin-top: 0.1cm;
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

        .info p {
            margin-bottom: 0.1cm;
            margin-top: 0.1cm;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <div class="esquadro-foto">
            <p>Foto 3x4</p>
        </div>

        <h3>TERMO DE CREDENCIAMENTO - TRANSPORTE ESCOLAR</h3>
        <p style="text-align: justify; font-weight: bold;">
        Sr.(a) Diretor(a) do Departamento de Transportes Públicos
        </p>
        <div class="info">
            <p style="text-align: justify;">
            Inscrição n.º ____________ Data de Início ______/______/________ CMC __________________
            </p>
            <p style="text-align: justify;">
            Ponto nº ___________________ Escola ______________________________________________
            </p>
            <p style="text-align: justify;">
            <b>Prefíxo: __________________ </b> Nome: ________________________________________________
            </p>
            <p style="text-align: justify;">
            Endereço __________________________________________________________ nº __________
            </p>
            <p style="text-align: justify;">
            Bairro ______________________________ CEP.: _______________ Tels. ___________________
            </p>
        </div>
        <div class="questionario">
            <p>
            ( &nbsp;&nbsp;&nbsp;) Xerox da C.N.H. com Curso de Condutor Escolar
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Xerox RG e CPF
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Comprovante residencial em nome do Candidato (IPTU - SEMASA)
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Certidão negativa do registro de distribuição criminal, relativa aos crimes de homicídio, roubo, estupro e corrupção de menores - Forum de Santo André
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Inscrição no Cadastro Mobiliário (CMC)
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Atestado de saúde
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Pesquisa de pontuação da CNH - comprovação do atendimento ao Art. 138 do CTB - "não ter cometido nenhuma infração grave ou gravíssima, ou ser reincidente em infrações médias nos
últimos doze meses".
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) CRLV (Categoria Aluguel)
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Contrato de Comodato registrado em Cartório, se o veículo não estiver em nome do Permissionário
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Xerox do RG do monitor (maior de 16 anos) e Comprovante de residência do mesmo
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Laudo de vistoria com aprovação da SA-TRANS
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Comprovante IPVA e DPVAT - (Pago)
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Nota Fiscal do tacógrafo, transferência ou doação, exceto original da fábrica do veículo
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Relação dos alunos (Anexo 9)
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Foto 3X4
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Vistoria e Autorização Ciretran
            </p>
            <p>
            ( &nbsp;&nbsp;&nbsp;) Certificado do Curso de Primeiros Socorros, realizado em Santo André
            </p>
        </div>

        <p style="text-align: justify; margin-top: 0.1cm;">
        A documentação apresentada foi conferida e está de acordo com o Decreto Municipal.
        </p>

        <p style="margin-bottom: 0.1cm;">
        Nome____________________ Data: _____/______/________,Assinatura _____________________
        </p>

        <p style="margin-bottom: 0.0cm; margin-top: 0.1cm;">
        Documentos conferidos por:
        </p>

        <div class="content-signature content-signature-left">
            <div>
                <p>____________________________________________  <span style="margin-left: 2cm;">Data ______/______/_______</span></p>
                <p>Encarregado Setor de Cadastro</p>
            </div>
        </div>

        <div class="parecer">
            <div class="parecer-p1">
                <p>Parecer da GCOC</p>
                <p><b>De acordo,</b></p>
                <div class="content-signature content-signature-left">
                    <div class="parecer-bold">
                        <p>______________________________________</p>
                        <p>Gerente de Controle Operacional e Cadastro</p>
                    </div>
                </div>
                <p>Data: ____/____/_______</p>
            </div>


            <div class="parecer-p2">
                <p>Parecer da DTP</p>
                <p><b>Autorizo,</b></p>
                <div class="content-signature content-signature-left">
                    <div class="parecer-bold">
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
