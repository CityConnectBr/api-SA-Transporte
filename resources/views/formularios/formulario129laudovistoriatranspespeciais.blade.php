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
            margin-top: -70px;
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

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>LAUDO DE VISTORIA TRANSPORTES ESPECIAIS</h3>

        <div class="nLaudo">
            <span>Nº do Laudo:</span>
            <div class="box"></div>
        </div>

        <div class="table">
            <div class="tr">
                <div class="td" style="width: 520px">
                    Permissionário<br>
                    {{$permissionario['nome_razao_social']}}
                </div>
                <div class="td" style="width: 170px">
                    Prefixo Permissionário<br>
                    {{$permissionario['prefixo']}}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 540px">
                    Local do Ponto<br>
                    {{$enderecoPonto['endereco']}}
                </div>
                <div class="td" style="width: 150px">
                    Prefixo Ponto<br>
                    {{$ponto['id_integracao']}}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 150px">
                    C.N.H nº<br>
                    {{$permissionario['cnh']}}
                </div>
                <div class="td" style="width: 150px">
                    Validade C.N.H. <br>
                    {{$vencimentoCNHFormatada}}
                </div>
                <div class="td" style="width: 380px">
                    Marca/Modelo do Veículo<br>
                    {{$veiculo['MarcaModeloVeiculo']['descricao']}}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 150px">
                    Tipo de Serviço<br>
                    {{$permissionario['modalidade']['descricao']}}
                </div>
                <div class="td" style="width: 150px">
                    Cor<br>
                    {{$veiculo['cor']['descricao']}}
                </div>
                <div class="td" style="width: 70px">
                    Ano<br>
                    {{$veiculo['ano_fabricacao']}}
                </div>
                <div class="td" style="width: 300px">
                    Capacidade / Lugares<br>
                    {{$veiculo['capacidade']}}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 150px">
                    Placa<br>
                    {{$veiculo['placa']}}
                </div>
                <div class="td" style="width: 250px">
                    Tacógrafo / Taxímetro<br>
                    {{$permissionario['taximetro_tacografo']}}
                </div>
                <div class="td" style="width: 280px">
                    Combusível<br>
                    {{$veiculo['tipoCombustivel']['descricao']}}
                </div>
            </div><br><br><br>        
        </div>

        <table>
            <tr>
                <th style="text-align: center;" colspan="3">
                    <p>ITENS VISTORIADOS</p>
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
        <br>
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
        
        <br>
        <table>
            <tr>
                <td style="width: 680px; text-align: center; padding: 5px;"">
                Renovação ( ) &nbsp;&nbsp;&nbsp;Trasferência ( ) &nbsp;&nbsp;&nbsp;Troca Veículo ( ) &nbsp;&nbsp;&nbsp;Outros ( )
                </td>
            </tr>
        </table>
        
        <br>
        <table>
            <tr>
                <td style="width: 680px; text-align: center; padding: 5px;">
                Aprovação ( ) &nbsp;&nbsp;&nbsp;Aprovado c/Restrição ( ) &nbsp;&nbsp;&nbsp;Repasse Data ____/____/____ &nbsp;&nbsp;&nbsp;Reprovado ( )
                </td>
            </tr>
        </table>
        
        <br>
        <div style="display: block; border: 1px solid black; width: 700px; height: 170px; padding: 10px;">
            <div class="content-signature" style="float: right;">
                <p>Santo André, {{ $dataFormatada }}</p>
                <div>
                    <p>___________________________________</p>
                    <p>Assinatura do requerente</p>
                </div>
            </div>
            <div class="content-signature" style="float: left;">
                <div>
                    <br>
                    <br>
                    <br>
                    <p>___________________________________</p>
                    <p style=" text-align: start;">Assinatura do requerente</p>
                </div>
            </div>
        </div>

        <footer>
            <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
