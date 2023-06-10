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
            line-height: 0.7cm;
        }

        .data_cabecalho{
            float: right;
        }

        .content-signature{
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
            font-size: 11px;
        }

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <p class="data_cabecalho">Santo André, {{ $dataFormatada }}</p>

        <p>Permissionário (a): {{$permissionario['nome_razao_social']}}</p>

        <p>CNH: {{$permissionario['cnh']}}, Validade: {{$permissionario['vencimento_cnh']}}, Prefixo n° {{$veiculo['prefixo']}}</p>

        <p>
        Dados do Veículo:<br>
        Marca/Modelo: {{$veiculo['MarcaModeloVeiculo']['descricao']}}, cor {{$veiculo['cor']['descricao']}}, ano {{$veiculo['ano_fabricacao']}}<br>
        Chassi: {{$veiculo['chassi']}}, Placa: {{$veiculo['placa']}}<br>
        Tacógrafo n° {{$permissionario['taximetro_tacografo']}}<br>
        </p>

        <p>Escolas<br>
        @foreach ($pontos as $ponto)
            Ponto n° {{ $ponto->ponto->id_integracao }} - {{ $ponto->ponto->descricao }}<br>
        @endforeach
        </p>

        <p>N° limite de alunos a transportar: {{$veiculo['capacidade']}} alunos</p>

        <p>Monitores(as):</p>
        @foreach ($monitores as $monitor)
            <p>{{ $monitor->nome }} - RG: {{ $monitor->rg }}</p>
        @endforeach

        <p style="text-align: justify;">
        Fica autorizado (a) o Permissionário (a) acima citado em virtude de: <br>
        {{$motivo}}<br>
        Autorizado até: {{$dataLimite}} <br>
        Quando deverá: {{$quandoDevera}} <br>
        Responsável pelo preenchimento {{ $usuario['nome'] }}
        </p>

        <div class="content-signature">
            <div>
                <br>
                <br>
                <p><b>{{$empresa['nome_do_gerente']}}</b></p>
                <p>Gerente Controle Operacional e Cadastro</p>
                <p>SA-TRANS - Santo André Transportes</p>
            </div>
        </div>

        <footer>
            <p class="center">{{ $empresa['endereco']['endereco']}}, {{ $empresa['endereco']['numero']}}, {{ $empresa['endereco']['complemento']}} - {{ $empresa['endereco']['bairro']}} - Santo André/SP, CEP {{ $empresa['endereco']['cep']}}</p>
            <p class="center">Telefone: {{ $empresa['telefone']}} - {{ $empresa['email']}}</p>

            <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
