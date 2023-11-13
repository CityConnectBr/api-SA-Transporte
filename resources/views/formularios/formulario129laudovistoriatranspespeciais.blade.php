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
            margin-top: -0.7cm;
        }

        .content p {
            margin-bottom: 0.3cm;
            line-height: 0.7cm;
        }

        .content-signature{
            display: flex;
            justify-content: space-between;
            text-align: right;
        }

        .content footer .right {
            text-align: right;
            font-size: 10px;
            margin-top: 0.5cm;
            margin-bottom: 0.5cm;
        }

        .content footer .center {
            text-align: center;
            font-size: 11px;
        }

        .nLaudo{
            margin-top: -75px;
            float: right;
            width: 70px;
        }

        .nLaudo span{
            font-size: 10px;
        }

        .nLaudo .box{
            border: 1px solid black;
            height: 30px;
        }

        .table .td{
            float: left;
            border: 1px solid black;
            padding: 5px;
        }

        table{
            width: 100%;
        }

        table td{
            border: 1px solid black;
        }

        table th {
            border: 1px solid black;
            text-align: center;
        }

        .table-collapse {
            border-collapse: collapse;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3 style="margin-top: -0.2cm;">LAUDO DE VISTORIA TRANSPORTES ESPECIAIS</h3>

        <div class="nLaudo">
            <span>Nº do Laudo:</span>
            <div class="box"></div>
        </div>

        <div class="table" style="margin-top: -0.5cm;">
            <div class="tr">
                <div class="td" style="width: 515px; margin-right: 5px; height: 33px;">
                    Permissionário<br>
                    <b>{{$permissionario['nome_razao_social']}}</b>
                </div>
                <div class="td" style="width: 170px; height: 33px;">
                    Prefixo Permissionário<br>
                    <b>{{$permissionario['prefixo']}}</b>
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -0.3cm;">
                <div class="td" style="width: 535px; margin-right: 5px; height: 33px;">
                    Local do Ponto<br>
                    <b>{{$enderecoPonto['endereco']}}</b>
                </div>
                <div class="td" style="width: 150px; height: 33px;">
                    Prefixo Ponto<br>
                    <b>{{$ponto['id_integracao']}}</b>
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -0.6cm;">
                <div class="td" style="width: 148px; height: 33px; margin-right: 5px;">
                    C.N.H nº<br>
                    <b>{{$permissionario['cnh']}}</b>
                </div>
                <div class="td" style="width: 150px; height: 33px; margin-right: 5px;">
                    Validade C.N.H. <br>
                    <b>{{$vencimentoCNHFormatada}}</b>
                </div>
                <div class="td" style="width: 370px; height: 33px;">
                    Marca/Modelo do Veículo<br>
                    <b>{{$veiculo['MarcaModeloVeiculo']['descricao']}}</b>
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -0.9cm;">
                <div class="td" style="width: 150px; height: 33px; margin-right: 5px;">
                    Tipo de Serviço<br>
                    <b>{{$permissionario['modalidade']['descricao']}}</b>
                </div>
                <div class="td" style="width: 150px; height: 33px; margin-right: 5px;">
                    Cor<br>
                    <b>{{$veiculo['cor']['descricao']}}</b>
                </div>
                <div class="td" style="width: 60px; height: 33px; margin-right: 5px;">
                    Ano<br>
                    <b>{{$veiculo['ano_fabricacao']}}</b>
                </div>
                <div class="td" style="width: 291px; height: 33px;">
                    Capacidade / Lugares<br>
                    <b>{{$veiculo['capacidade']}}</b>
                </div>
            </div><br><br><br>
            <div class="tr" style="margin-top: -1.2cm;">
                <div class="td" style="width: 150px; height: 33px; margin-right: 5px;">
                    Placa<br>
                    <b>{{$veiculo['placa']}}</b>
                </div>
                <div class="td" style="width: 250px; height: 33px; margin-right: 5px;">
                    Tacógrafo / Taxímetro<br>
                    <b>{{$permissionario['taximetro_tacografo']}}</b>
                </div>
                <div class="td" style="width: 269px; height: 33px;">
                    Combusível<br>
                    <b>{{$veiculo['tipoCombustivel']['descricao']}}</b>
                </div>
            </div><br><br><br>
        </div>

        <table class="table-collapse" style="margin-top: -1.2cm; width: 715px;">
            <tr style="height: 30px;">
                <th style="text-align: center;" colspan="4">
                    <p style="margin: 0.0cm;">ITENS VISTORIADOS</p>
                </th>
            </tr>
            <tr>
                <td style="width: 300px">
                Funilaria
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Triângulo / Chave de Roda
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Para-Brisa
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Macaco / Estepe
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Pintura
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Lanternas
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Sistema de Direção
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Faróis Baixo / Alto
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Sistema de Freios
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Setas indicativas e pisca alerta
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Sistema de Suspensão
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Luz vigia dianteira / traseira
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Higiene Interna / Externa
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Luz de ré
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Estofamento
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Luz de placa traseira
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Escapamento
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Luz de Freios
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Pneus
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Buzina
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Cinto de Segurança
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Tacógrafo
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Quebra-Sol
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Taximetro
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Esguichador água para-brisa
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Painel
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Limpador de para-brisa
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Luminoso "Taxi"
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Para-brisa / vidros
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Espelhos Retrovisores Int. / Ext.
                </td>
                <td style="width: 20px">
                </td>
            </tr>
            <tr>
                <td style="width: 300px">
                Extintor de Incêndio
                </td>
                <td style="width: 20px">
                </td>
                <td style="width: 300px">
                Padronização
                </td>
                <td style="width: 20px">
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 680px">
                Obs:
                </td>
            </tr>
            <tr>
                <td style="width: 680px">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td style="width: 680px">
                &nbsp;
                </td>
            </tr>
            <tr>
                <td style="width: 680px">
                &nbsp;
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 680px; text-align: center; padding: 5px;">
                Renovação ( ) &nbsp;&nbsp;&nbsp;Trasferência ( ) &nbsp;&nbsp;&nbsp;Troca Veículo ( ) &nbsp;&nbsp;&nbsp;Outros ( )
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 680px; text-align: center; padding: 5px;">
                Aprovação ( )  &nbsp;&nbsp;&nbsp;Aprovado c/Restrição ( ) &nbsp;&nbsp;&nbsp;Repasse Data ____/____/____ &nbsp;&nbsp;&nbsp;Reprovado ( )
                </td>
            </tr>
        </table>
        <div style="display: block; border: 1px solid black; width: 700px; height: 90px; padding: 5px;">
            <div class="content-signature" style="float: right; margin-top: -0.5cm;">
                <p>Santo André, {{ $dataFormatada }}</p>
                <div style="margin-top: -0.4cm;">
                    <p style="margin-bottom: 0.0cm;">___________________________________</p>
                    <p style="text-align: center; margin-top: 0.0cm;">Assinatura do requerente</p>
                </div>
            </div>
            <div class="content-signature" style="float: left; margin-top: -0.5cm;">
                <p style="color: #fff">Santo André, {{ $dataFormatada }}</p>
                <div style="margin-top: -0.4cm;">
                    <p style="margin-bottom: 0.0cm;">___________________________________</p>
                    <p style=" text-align: center; margin-top: 0.0cm;">Assinatura do requerente</p>
                </div>
            </div>
        </div>

        <footer>
            <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
