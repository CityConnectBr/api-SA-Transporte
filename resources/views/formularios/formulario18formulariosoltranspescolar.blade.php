<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        html,
        body {
            width: 190mm;
            font-size: 12px;
        }

        html {
            font-family: Arial, Helvetica, sans-serif;
        }

        .content {
            margin: 0px;
        }

        .logo {
            width: 100px;
            margin-left: 0cm;
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
            border-bottom: 4px solid #000;
            margin-bottom: 0.3cm;
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
            margin-top: -0.2cm;
            margin-bottom: -0.1cm;
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

        .escola-info {
            margin-top: 0.1cm;
        }

        .escola-info p {
            margin-bottom: 0.0cm;
            margin-top: 0.0cm;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        {{-- <div class="esquadro-foto">
            <p>Foto 3x4</p>
        </div> --}}

        <h3 style="margin-bottom: 0.1cm;">ANEXO 18 - SOLICITAÇÃO DE TRANSPORTE ESCOLAR PRÓPRIO PARA ESTABELECIMENTO DE ENSINO</h3>
        <p style="text-align: justify; margin-top: 0.2cm; font-weight: bold;">
        Sr.(a) Diretor(a) do Departamento de Transportes Públicos
        </p>
        <div class="escola-info">
            <p style="text-align: justify;">
            PREFIXO _______________________ PONTO __________ ESCOLA ____________________
            </p>
            <p style="text-align: justify;">
            Endereço _______________________________________________________, nº __________
            </p>
            <p style="text-align: justify;">
            Bairro ________________________________ Tel. _______________ Cel. ________________
            </p>
            <p style="text-align: justify;">
            Nome do responsável ____________________________________________________________
            </p>
        </div>

        <p style="margin-top: 0.1cm; margin-bottom: 0.1cm; font-weight: bold;">
        Para solicitação de transporte escolar próprio, no estabelecimento de ensino qualificado acima, foi apresentada a seguinte documentação:
        </p>
        <div class="questionario">
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Requerimento padrao preenchido
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) RG do responsável da escola - Cópia - nº ________________________
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) CNPJ ou Inscrição Estadual de Isento - Cópia
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Inscrição Municipal - Cópia
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Veículo cadastrado em nome da Escola ou contrato de comodato registrado em cartório
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Contrato Social ou Estatuto - Cópia
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Alvará de funcionamento - Cópia
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Procuração pública designando quem responderá pela escola, caso não seja sócio-proprietário
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) CRLV, IPVA E DPVAT com seguro obrigatório para transporte escolar
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Vistoria do CIRETRAN em ______/_______/_______
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Autorização para Transporte Escolar pela CIRETRAN em ______/_______/_______
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Laudo de vistoria com aprovação da SA-TRANS
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Registro em carteira comprovando vínculo empregatício do condutor auxiliar - Cópia
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Declaração de acompanhante e Cópia do RG do mesmo
            </p>
        </div>
            <p style="font-weight: bold; margin-top: -0.1cm; margin-bottom: 0.0cm;">
            DADOS DO CONDUTOR DO VEÍCULO
            </p>
        <div class="questionario">
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Nome _________________________________________________________________________
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) CNH categoria "D" - Cópia - nº _____________________ Validade ________/_______/______
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Credencial DETRAN - Cópia - nº ____________________ Validade _______/_______/______
            </p>
            <p style="line-height: 0.5cm;">
            (&nbsp;&nbsp;&nbsp;&nbsp;) Certidão negativa do registro de distribuição criminal, relativa aos crimes de homicídio, roubo, estupro e corrupção de menores - Forum de Santo André - Validade ______/_______/______
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Atestado de Saúde
            </p>
            <p style="line-height: 0.5cm;">
            (&nbsp;&nbsp;&nbsp;&nbsp;) Comprovante do atendimento ao Art. 138 do CTB - 'não ter cometido nenhuma infração grave ou gravíssima, ou ser reincidente em infrações médias nos últimos doze meses"
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Carteira Profissional - Cópia folha da foto, dados e registro
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) RG e CPF - Cópia
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Comprovante de Residência em nome do condutor
            </p>
            <p>
            (&nbsp;&nbsp;&nbsp;&nbsp;) Certificado do curso de primeiros socorros realizado em Santo André.
            </p>
        </div>

        <p style="text-align: justify; margin-top: 0.1cm; margin-bottom: 0.0cm;">
        Solicitação recebida e documentos conferidos por ____________________________________________ em ____/______/_____ assinatura ___________________________________________________________________________
        </p>

        <p style="margin-top: 0.1cm; margin-bottom: 0.0cm;">
        Informo que <b style="text-decoration: underline;">não existem</b> débitos ou pendências junto à SA-TRANS e que a documentação
apresentada foi conferida e está de acordo com o Decreto Municipal n.º 14.537/00.
        </p>
        <div class="content-signature content-signature-left">
            <div>
                <p><b>____________________________________________ </b> <span style="margin-left: 2cm;">Data ______/______/_______</span></p>
                <p><b>Encarregado Setor de Cadastro</b></p>
            </div>
        </div>

        <div class="parecer">
            <div class="parecer-p1">
                <p>De acordo,</p>
                <div class="content-signature content-signature-left">
                    <div class="parecer-bold">
                        <p>______________________________________</p>
                        <p>Gerente de Controle Operacional e Cadastro</p>
                    </div>
                </div>
                <p>Data: ____/____/_______</p>
            </div>


            <div class="parecer-p2">
                <p>Autorizo,</p>
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
