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

        <h3>ANEXO 18 - SOLICITAÇÃO DE TRANSPORTE ESCOLAR PRÓPRIO PARA ESTABELECIMENTO DE ENSINO</h3>
        <p style="text-align: justify;">
        Sr.(a) Diretor(a) do Departamento de Transportes Públicos
        </p>
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
        <p>
        Para solicitação de transporte escolar próprio, no estabelecimento de ensino qualificado acima, foi apresentada a seguinte documentação:
        </p>
        <div class="questionario">
            <p>
            ( ) Requerimento padrao preenchido
            </p>
            <p>
            ( ) RG do responsável da escola - Cópia - nº ________________________
            </p>
            <p>
            ( ) CNPJ ou Inscrição Estadual de Isento - Cópia
            </p>
            <p>
            ( ) Inscrição Municipal - Cópia
            </p>
            <p>
            ( ) Veículo cadastrado em nome da Escola ou contrato de comodato registrado em cartório
            </p>
            <p>
            ( ) Contrato Social ou Estatuto - Cópia
            </p>
            <p>
            ( ) Alvará de funcionamento - Cópia
            </p>
            <p>
            ( ) Procuração pública designando quem responderá pela escola, caso não seja sócio-proprietário
            </p>
            <p>
            ( ) CRLV, IPVA E DPVAT com seguro obrigatório para transporte escolar
            </p>
            <p>
            ( ) Vistoria do CIRETRAN em ______/_______/_______
            </p>
            <p>
            ( ) Autorização para Transporte Escolar pela CIRETRAN em ______/_______/_______
            </p>
            <p>
            ( ) Laudo de vistoria com aprovação da SA-TRANS
            </p>
            <p>
            ( ) Registro em carteira comprovando vínculo empregatício do condutor auxiliar - Cópia
            </p>
            <p>
            ( ) Declaração de acompanhante e Cópia do RG do mesmo
            </p>     
            <p>
            DADOS DO CONDUTOR DO VEÍCULO
            </p>    
            <p>
            ( ) Nome _________________________________________________________________________
            </p>  
            <p>
            ( ) CNH categoria "D" - Cópia - nº _____________________ Validade ________/_______/______
            </p>  
            <p>
            ( ) Credencial DETRAN - Cópia - nº ____________________ Validade _______/_______/______
            </p>  
            <p>
            ( ) Certidão negativa do registro de distribuição criminal, relativa aos crimes de homicídio, roubo, estupro e corrupção de menores - Forum de Santo André - Validade ______/_______/______
            </p>  
            <p>
            ( ) Atestado de Saúde
            </p>  
            <p>
            ( ) Comprovante do atendimento ao Art. 138 do CTB - 'não ter cometido nenhuma infração grave ou gravíssima, ou ser reincidente em infrações médias nos últimos doze meses"
            </p>  
            <p>
            ( ) Carteira Profissional - Cópia folha da foto, dados e registro
            </p>  
            <p>
            ( ) RG e CPF - Cópia
            </p>  
            <p>
            ( ) Comprovante de Residência em nome do condutor
            </p>  
            <p>
            ( ) Certificado do curso de primeiros socorros realizado em Santo André.
            </p>            
        </div>

        <p style="text-align: justify;">
        Solicitação recebida e documentos conferidos por _______________________ em ____/______/_____ assinatura ___________________________________________________________________________
        </p>

        <p>
        Informo que não existem débitos ou pendências junto à SA-TRANS e que a documentação
apresentada foi conferida e está de acordo com o Decreto Municipal n.º 14.537/00.
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
