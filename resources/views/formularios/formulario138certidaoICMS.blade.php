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

        h3 {
            text-align: center;
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

        .data_cabecalho {
            float: right;
        }

        .content-signature {
            margin-top: 2cm;
            display: flex;
            justify-content: space-between;
            text-align: center;
        }

        .content footer .right {
            text-align: right;
            font-size: 10px;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }

        .content footer .center {
            text-align: center;
            font-size: 15px;
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

        footer {
            position: fixed;
            bottom: 0px;
            width: 100%;
        }

        footer h3 {
            text-align: center;
            margin: 0px;
        }

        footer p {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <p class="data_cabecalho">Santo André, {{ $dataFormatada }}</p>

        <h3>CERTIDÃO SA-TRANS/DTP/GCOC N.º096.2015</h3>

        <p style="text-align: justify;">
            <b>{{$empresa['nome_do_diretor']}}</b>, Diretor de Transporte Público da Empresa Santo André Transportes,
            integrante da administração indireta do município de Santo André, nomeado pela Superintendência por meio da
            Portaria n°38.10.2017 baixada em 31/10/2017, dentro de suas atribuições e na forma da Lei,
            <b>DECLARA</b> sob as penas da Lei, para fins de isenção de <b>ICMS</b>,conform previsto no Artigo 88 do
            Anexo I do <b>RICMS</b>
            aprovado pelo Decreto nº 45.490, de 30 de novembro de 2000, acrescentado pelo Dec. 46.053 de 24 de agosto de
            2001,
            que o(a) Sr(a).
            <b>{{$certidao['permissionario']['nome_razao_social']}}</b>,
            {{$certidao['permissionario']['nacionalidade']}}, prefixo <b>{{$certidao['permissionario']['prefixo']}}</b>,
            portador(a) da célula de identidade RG nº <b>{{$certidao['permissionario']['rg']}}</b> inscrito no
            CPF/MF sob o nº <b>{{$certidao['permissionario']['cpf_cnpj']}}</b>,
            residente à <b>{{$certidao['permissionario']['endereco']['endereco']}},
                {{$certidao['permissionario']['endereco']['numero']}} -
                {{$certidao['permissionario']['endereco']['bairro']}}</b>, nesta cidade, exerce há mais de 01(um)
            ano
            a atividade de condutor autônomo de passageiros<b>táxi</b> em veículo de sua propriedade, tendo as seguintes
            características: marca/modelo <b>{{$certidao['marcaModeloVeiculo']['descricao']}}</b>, cor
            <b>{{$certidao['cor']['descricao']}}</b>, ano de fabricação <b>{{$certidao['ano_fabricacao']}}</b>,
            placa: <b>{{$certidao['placa']}}</b>. sendo sua área de atividade à <b>{{$certidao['ponto']['descricao']}}</b>, ponto 
            <b>{{$certidao['marcaModeloVeiculo']['id_integracao']}}</b> <br>
            Declara ainda, que os últimos 02(dois) anos este órgão não expedio certidão em nome do interessado para
            aquisição de veículo
            com isenção ou com redução de base de cálculo de ICMS, Declaração elaborada em 03 de setembro de 2015 e
            conferida por {{$empresa['nome_do_gerente']}}.
        </p>

        <div class="content-signature content-signature-right">
            <div>
                <br>
                <br>
                <div style="float: right;">
                    <p>____________________________________________</p>
                    <p>Gerente Controle Operacional e Cadastro</p>
                </div>
            </div>
        </div>
        <h3>&nbsp;</h3>
        <h3>&nbsp;</h3><!-- ACERTANDO BUG DE QUEBRA DE PÁGINA -->

        <footer>
            <h3>{{$empresa['nome_do_diretor']}}</h3>
            <p class="center">Diretor de Transporte Público</p>
            <p class="center">SA-TRANS - Santo André Transportes</p>
            <p class="center">{{ $empresa['endereco']['endereco']}}, {{ $empresa['endereco']['numero']}}, {{
                $empresa['endereco']['complemento']}} - {{ $empresa['endereco']['bairro']}} - Santo André/SP, CEP {{
                $empresa['endereco']['cep']}}</p>
            <p class="center">Telefone: {{ $empresa['telefone']}} - {{ $empresa['email']}}</p>

            <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>