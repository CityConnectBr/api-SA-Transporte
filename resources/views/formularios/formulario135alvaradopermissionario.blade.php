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
        
        <div class="esquadro-foto">
            <p>Foto 3x4</p>
        </div>

        <h3>ALVARÁ DE PERMISSÃO</h3>
        <br><br><br>
        <div class="table">
            <div class="tr">
                <div class="td" style="width: 260px">
                    Permissionário:<br> {{ $permissionario['nome_razao_social'] }}
                </div>
                <div class="td" style="width: 200px">
                    Prefixo:<br> {{ $permissionario['prefixo'] }}
                </div>
                <div class="td" style="width: 200px">
                    Categoria:<br> {{$permissionario['modalidade']['descricao']}}
                </div>
            </div><br><br><br>            
            <div class="tr">
                <div class="td" style="width: 684px">
                    Local:<br> {{ $ponto['descricao'] }}
                </div>
            </div><br><br><br>     
            <div class="tr">       
                <div class="td" style="width: 260px">
                    N° do Ponto:<br> {{ $ponto['id_integracao'] }}
                </div>
                <div class="td" style="width: 200px">
                    CNH:<br> {{ $permissionario['cnh'] }}
                </div>
                <div class="td" style="width: 200px">
                    Validade CNH:<br> {{ $permissionario['vencimento_cnh'] }}
                </div>
            </div><br><br><br>  
            <div class="tr">
                <div class="td" style="width: 260px">
                    Veículo/Marca:<br> {{ $veiculo['MarcaModeloVeiculo']['descricao'] }}
                </div>
                <div class="td" style="width: 200px">
                    Espécie/Tipo:<br> {{ $veiculo['tipoVeiculo']['descricao'] }}
                </div>
                <div class="td" style="width: 200px">
                    Placa:<br> {{ $veiculo['placa'] }}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 260px">
                    Ano:<br> {{ $veiculo['ano_modelo'] }}
                </div>
                <div class="td" style="width: 200px">
                    Capacidade:<br> {{ $veiculo['capacidade'] }}
                </div>
                <div class="td" style="width: 200px">
                    Cor:<br> {{ $veiculo['cor']['descricao'] }}
                </div>
            </div><br><br><br>
            <div class="tr">
                <div class="td" style="width: 260px">
                    Taxímetro/Tacógrafo:<br> {{ $permissionario['taximetro_tacografo_numero'] }}
                </div>
                <div class="td" style="width: 200px">
                    Data de Vencimento:<br> 
                </div>
                <div class="td" style="width: 200px">
                    Data de Emissão:<br> {{ $permissionario['taximetro_tacografo_afericao'] }}
                </div>
            </div><br><br><br>
            <div class="tr">
            <div class="td" style="width: 684px">
                    Assinatura do Gerente de Fiscalização Operacional:<br>
                </div>
            </div><br><br><br>
        </div>

        <footer>
            <p>Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
