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
        }

        .parecer{
            width: 100%;
            margin-top: 2.5cm;
            border-top: 1px solid #000;
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

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <div class="esquadro-foto">
            <p>Foto 3x4</p>
        </div>

        <h3>ANEXO 03 - TRANSFERÊNCIA DE PERMISSÃO DE TRANSPORTE ESCOLAR</h3>
        <p style="text-align: justify;">
        Sr.(a) Diretor(a) do Departamento de Transportes Públicos
        </p>
        <p style="text-align: justify;">
        Prefixo nº _________________________ Data da Transferência anterior _______/_______/_______
        </p>
        <p style="text-align: justify;">
        Ponto nº ____________________ Escola ______________________________________________
        </p>
        <p style="text-align: justify;">
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
        <div class="questionario">
            <p>
            ( ) Requerimento padrao preenchido
            </p>
            <p>
            ( ) Foto 3X4
            </p>
            <p>
            ( ) CNH de Santo André Cat."D" ______________________ Validade ______/______/________ C/Obs: "Exerce Atividade Remunerada Transporte Escolar".
            </p>
            <p>
            ( ) Pesquisa de pontuação da CNH - comprovação do atendimento ao Art. 138 do CTB -
    "não ter cometido nenhuma infração grave ou gravíssima, ou ser reincidente em infrações
    médias nos últimos doze meses" ________ pts.
            </p>
            <p>
            ( ) Certificado do curso de primeiros socorros realizado em Santo André
            </p>
            <p>
            ( ) RG ________________________
            </p>
            <p>
            ( ) CPF________________________
            </p>
            <p>
            ( ) Certidão negativa do registro de distribuição criminal, relativa aos crimes de homicídio, roubo,
    estupro e corrupção de menores - Forum de Santo André - Validade ______/______/_______
            </p>
            <p>
            ( ) Atestado de Saúde
            </p>
            <p>
            ( ) Comprovante de residencia em Santo André
            </p>
            <p>
            ( ) CRLV (Categoria Aluguel)
            </p>
            <p>
            ( ) Comprovante IPVA
            </p>
            <p>
            ( ) DPVAT - seguro obrigatório
            </p>
            <p>
            ( ) Vistoria do CIRETRAN - data ______/_______/_______
            </p>
            <p>
            ( ) Autorização para transporte escolar emitida pela CIRETRAN - data ______/_______/_______
            </p>
            <p>
            ( ) Nota Fiscal do tacógrafo, transferência ou doação, exceto original da fábrica do veículo
            </p>
            <p>
            ( ) Laudo de vistoria com aprovação da SA-TRANS
            </p>
            <p>
            ( ) Inscrição no Cadastro Mobiliário (CMC) ________________________
            </p>
            <p>
            ( ) Declaração de acompanhante (maior de 16 anos) e Xerox do RG do mesmo
            </p>
            <p>
            ( ) Relação dos alunos ( Anexo 9 )
            </p>
        </div>

        <p style="text-align: justify;">
        Informo que o permissionário não possui débito junto à SA-TRANS e que a documentação
apresentada foi conferida e está de acordo com o Decreto Municipal.
        </p>

        <p>
        Nome: ____________________________ Data: ____/____/_____, Assinatura: ___________________
        </p>
        <p>
        Documentos conferido por:
        </p>
        <div class="content-signature content-signature-left">
            <div>
                <br>
                <br>
                <p>____________________________________________  <span style="margin-left: 2cm;">Data ______/______/_______</span></p>
                <p>Encarregado Setor de Cadastro</p>
            </div>
        </div>  

        <div class="parecer">
            <div class="parecer-p1">
                <p>Parecer da GCOC</p>
                <p>De acordo,</p>
                <div class="content-signature content-signature-left">
                    <div>
                        <br>
                        <br>
                        <p>______________________________________</p>
                        <p>Gerente de Controle Operacional e Cadastro</p>
                    </div>
                </div> 
                <p>Data: ____/____/_______</p>
            </div>

            
            <div class="parecer-p2">
                <p>Parecer da DTP</p>
                <p>Autorizo,</p>
                <div class="content-signature content-signature-left">
                    <div>
                        <br>
                        <br>
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
