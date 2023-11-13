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

        .content .content-signature-right {
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

        .parecer{
            width: 100%;
        }

        .parecer-p1{
            width: 50%;
            float: left;
        }

        .parecer-p2{
            width: 50%;
            float: right;
        }
    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>AUTORIZAÇÃO PARA ADESIVAÇÃO CUSTEADA PELO PERMISSIONÁRIO</h3>

        <p style="text-align: justify; margin-top: -0.3cm;">
            Autorizo o permissionário Sr.(a) {{$permissionario['nome_razao_social']}}, prefixo n° {{$permissionario['prefixo']}} a efetuar adesivação do veículo escolar, marca/modelo <b>{{$veiculo['MarcaModeloVeiculo']['descricao']}}</b>, cor: <b>{{$veiculo['cor']['descricao']}}</b>, ano de fabricação <b>{{$veiculo['ano_fabricacao']}}</b>, ano do modelo <b>{{$veiculo['ano_modelo']}}</b>, placa <b>{{$veiculo['placa']}}</b> nas seguintes empresas:
        </p>

        <p style="margin-top: -0.3cm; font-size: 12px;"><b>-{{$empresa1}}</b></p>
        <p style="margin-top: -0.3cm; font-size: 12px;"><b>-{{$empresa2}}</b></p>

        <div class="content-signature content-signature-right" style="margin-top: -0.2cm;">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div style="margin-top: 0.2cm;">
                <p>____________________________________________</p>
                <p>Encarregado de vistoria Mecânica</p>
            </div>
        </div>

        <p style="margin-top: 0.1cm;">
        Eu, <b>{{$permissionario['nome_razao_social']}}</b> recebo 02 (duas) vias desta autorização,
        comprometendo-me a entregar meu veículo para adesivação, limpo e vazio de objeto e acessórios até o dia
        <b>{{$dataLimite}}</b>, sob pena de ser responsabilizado nos termos da Resolução nº 006/2011.
        </p>

        <p style="margin-top: -0.2cm;">
        Comprometo-me a entregar à empresa <b>{{$empresa1Nome}}/{{$empresa2Nome}}</b> uma via das duas vias da autorização ora recebida,
        retendo a outra carimbada pela empresa supracitada, e preenchida com a data da entrega e da previsão de
        retirada do veículo, bem como da data de efetiva retirada com o serviço devidamente realizado;
        comprometo-me a manter comigo uma via desta autorização carimbada, apresentando-a para a retirada do
        veículo, após a realização da adesivação, bem como a levá-la na vistoria ténica a ser realizada na
        SA-TRANS para conferência dos serviços de adesivação;
        comprometo-me a trazer o veículo para vistoria técnica na SA-TRANS no prazo máximo de 05 dias úteis a
        partir da realização da adesivação, sob pena de responsabilidade nos termos da Resolução nº 006/2011,
        quando entregarei a via carimbada pela empresa <b>{{$empresa1Nome}}/{{$empresa2Nome}}</b> ao Encarregado de Vistoria Mecânica:
        </p>

        <div class="parecer">
            <div class="parecer-p1">
                <div class="content-signature content-signature-left">
                    <div>
                        <p>_________________________________</p>
                        <p>Assinatura do Permissionário</p>
                    </div>
                </div>
            </div>

            <div class="parecer-p2">
                <div class="content-signature content-signature-left">
                    <div>
                        <p>_________________________________</p>
                        <p>Empresa Contratada</p>
                    </div>
                </div>
            </div>
        </div>

        <p>
        Recebi o veículo em _____/_____/______
        </p>
        <p>
        Previsão para retirada do veículo _____/_____/______
        </p>

        <div class="parecer">
            <div class="parecer-p1">
                <div class="content-signature content-signature-left">
                        <p>Veículo Entregue em _____/_____/______</p>
                </div>
            </div>

            <div class="parecer-p2">
                <div class="content-signature content-signature-left">
                    <div>
                        <p>_________________________________</p>
                        <p>Permissionário</p>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
