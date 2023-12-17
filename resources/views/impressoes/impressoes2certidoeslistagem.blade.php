<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        html,
        body {
            width: 297mm;
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

        .filters{
            margin: 10px;
        }

        .filters p{
            margin: 0px;
            padding: 0px;
            font-size: 12px;
        }

        .table{
            width: 270mm;
            border-collapse: collapse;
        }

        .table .tr{
            border: none;
        }

        .table th{
            border: none;
            font-size: 10px;
            text-align: left;
            background-color: #ccc;
        }

        .table td{
            border: none;
            font-size: 9px;
        }

    </style>
</head>

<body>
    <div class="content">
        <h3>Relatório de Certidôes</h3>
        <br>

        <div class="filters">
            <p>Data Inicial: {{$dataInicialFormatada}}</p>
            <p>Data Final: {{$dataFinalFormatada}}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Data</th>
                    <th>Condutor</th>
                    <th>Tipo</th>
                    <th>Marca/Modelo</th>
                    <th>Renavam</th>
                    <th>Placa</th>
                    <th>Chassi</th>
                    <th>Combustivel</th>
                    <th>Cor</th>
                    <th>Prefixo</th>
                    <th>Ponto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($objList as $certidao)
                <tr>
                    <td>{{ $certidao['id'] }}</td>
                    <td>{{ $certidao['data'] }}</td>
                    <td>{{ $certidao['permissionario']['nome_razao_social'] }}</td>
                    <td>{{ $certidao['tipoDeCertidao']['descricao'] }}</td>
                    <td>{{ $certidao['marcaModeloVeiculo']['descricao'] }}</td>
                    <td>{{ $certidao['renavam'] }}</td>
                    <td>{{ $certidao['placa'] }}</td>
                    <td>{{ $certidao['chassis'] }}</td>
                    <td>{{ $certidao['tipoCombustivel']['descricao'] }}</td>
                    <td>{{ $certidao['cor']['descricao'] }}</td>
                    <td>{{ $certidao['prefixo'] }}</td>
                    <td>{{ $certidao['ponto']['id_integracao'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
