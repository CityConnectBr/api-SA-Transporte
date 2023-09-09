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

        .table .td{
            float: left;
            border: 1px solid black;
            padding: 5px;
            margin: 0px;
            min-height: 40px;
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

        <h3>CERTIDÃO</h3>
        <br><br><br>
        <div class="table">
            <div class="tr">
                <div class="td" style="width: 100px">
                    Data:<br> {{ $dataCertidao }}
                </div>
                <div class="td" style="width: 200px">
                    N° do Protocolo:<br> {{ $obj['protocol'] }}
                </div>
                <div class="td" style="width: 200px">
                    N° do Renavam:<br> {{ $obj['renavam'] }}
                </div>                
                <div class="td" style="width: 148px">
                    Tipo de Certidão:<br> {{ $obj['tipoDeCertidao']['descricao'] }}
                </div>
            </div><br><br><br>          
            <div class="tr">
                <div class="td" style="width: 684px">
                    Nome do Permissionário:<br> {{ $obj['permissionario']['nome_razao_social'] }}
                </div>
            </div><br><br><br>      
            <div class="tr">
                <div class="td" style="width: 684px">
                    Ponto:<br> {{ $ponto }}
                </div>
            </div><br><br><br>     
            <div class="tr">       
                <div class="td" style="width: 260px">
                    Placa:<br> {{ $obj['placa'] }}
                </div>
                <div class="td" style="width: 200px">
                    Ano de Fabricação:<br> {{ $obj['ano_fabricacao'] }}
                </div>
                <div class="td" style="width: 200px">
                    Chassi:<br> {{ $obj['chassis'] }}
                </div>
            </div><br><br><br>  
            <div class="tr">
                <div class="td" style="width: 260px">
                    Prefixo:<br> {{ $obj['prefixo'] }}
                </div>
                <div class="td" style="width: 200px">
                    Marca/Modelo:<br> {{ $obj['marcaModeloVeiculo']['descricao'] }}
                </div>
                <div class="td" style="width: 200px">
                    Tipo de Combustível:<br> {{ $obj['tipoCombustivel']['descricao'] }}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 260px">
                    Cor:<br> {{ $obj['cor']['descricao'] }}
                </div>
                <div class="td" style="width: 412px">
                    Observação:<br> {{ $obj['observacao'] }}
                </div>
            </div><br><br><br>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
