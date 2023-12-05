<!DOCTYPE html>
<html>
<head>
    <title>PDF Printing Example</title>
    <style>
        /* Common styles for both pages */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
        }

        footer p {
            text-align: right;
            font-size: 10px;
            margin-top: 1.5cm;
            margin-bottom: 0.1cm;
        }

        table td{
            float: left;
            padding: 5px;
            margin: 0px;
            min-height: 40px;
            font-weight: bold;
            width: 100%;
        }

        /* Styles for the first page */
        @media print {
            .page {
                page-break-after: always;
                width: 148mm; /* A5 width */
                height: 210mm; /* A5 height */
                margin: 0 auto; /* Center the page horizontally */
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        /* Styles for the second page */
        @media print {
            .page:last-child {
                page-break-after: avoid;
                width: 148mm; /* A5 width */
                height: 210mm; /* A5 height */
                margin: 0 auto; /* Center the page horizontally */
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <table>
            <tbody aria-colspan="5">
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">{{$permissionario['prefixo']}}</td>
                </tr>
                <tr class="tr">
                    <td colspan="5">{{$permissionario['nome_razao_social']}}</td>
                </tr>
                <tr class="tr">
                    <td colspan="5">{{$ponto['descricao']}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$permissionario['modalidade']['descricao']}}</td>
                    <td colspan="3" style="text-align: right;">{{$ponto['id_integracao']}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$permissionario['cnh']}}</td>
                    <td style="text-align: right;">{{$permissionario->vencimento_cnh->format('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$veiculo['MarcaModeloVeiculo']['descricao']}}</td>
                    <td colspan="2">{{$veiculo['tipoVeiculo']['descricao']}}</td>
                </tr>
                <tr>
                    <td colspan="1">{{$veiculo['placa']}}</td>
                    <td colspan="1">{{$veiculo['ano_modelo']}}</td>
                    <td colspan="2">{{$veiculo['capacidade']}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$veiculo['cor']['descricao']}}</td>
                    <td>{{$permissionario['taximetro_tacografo_numero']}}</td>
                </tr>
                <tr>
                    <td colspan="2">{{$alvara->data_vencimento->format('d/m/Y')}}</td>
                    <td>{{$alvara->data_emissao->format('d/m/Y')}}</td>
                </tr>
            </tbody>
        </table>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>
    <br><br><br>

    <div class="page">
        <p>DATA DE INÍCIO DAS ATIVIDADES:</p>
        <p>CMC: </p>
        <br><br><br><br><br>
        Condutor(es) Auxiliar(es):
        {{-- @foreach($condutores as $condutor)
            <p>{{$condutor['nome']}}</p>
            <p>CNH: {{$condutor['cnh']}} Validade: {{$condutor->vencimento_cnh->format('d/m/Y')}}</p>
        @endforeach --}}
    </div>
</body>
</html>
