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

    </style>
</head>

<body>
    <div class="content">
        <img src="{{ public_path('images/sa_logo.png') }}" alt="logo" class="logo">

        <h3>FORMULÁRIO DE REQUERIMENTO</h3>

        <p>A(o) Senhor(a) Diretor(a) do Departamento de Transportes Públicos da SA-TRANS</p>

        <p>Dados do solicitante:</p>

        <p>
        Nome: <b>{{$permissionario['nome_razao_social']}}</b>, Prefixo: <b>{{$permissionario['prefixo']}}</b>, Telefone: <b>{{$permissionario['telefone']}}</b><br>
        Endereço: <b>{{$permissionario['endereco']['endereco']}}</b>, <b>{{$permissionario['endereco']['numero']}}</b>, <b>{{$permissionario['endereco']['complemento']}}</b>, Bairro <b>{{$permissionario['endereco']['bairro']}}</b>, Município: <b>Santo André</b>, UF: <b>SP</b>, CEP: {{$permissionario['endereco']['cep']}}
        </p>

        <p>Permissionário? ( &nbsp;&nbsp;&nbsp;&nbsp;) Sim ( &nbsp;&nbsp;&nbsp;&nbsp;) Não</p>

        <p>Local do ponto <b>{{$enderecoPonto['endereco']}}</b></p>

        <p>DESCRIÇÃO DO REQUERIMENTO</p>

        <p>
            _______________________________________________________________________________
            _______________________________________________________________________________
            _______________________________________________________________________________
            _______________________________________________________________________________
            _______________________________________________________________________________
            _______________________________________________________________________________
        </p>

        <div class="content-signature">
            <p>Santo André, {{ $dataFormatada }}</p>
            <div>
                <br>
                <p>_______________________________________</p>
                <p>Assinatura do requerente</p>
            </div>
        </div>

        <p style="font-weight: bold;">
        Recebido<br>
        por: _______________________ Data ____/____/______ Assinatura: ______________________
        </p>

        <footer>
            {{-- <p class="center">{{ $empresa['endereco']['endereco']}}, {{ $empresa['endereco']['numero']}}, {{ $empresa['endereco']['complemento']}} - {{ $empresa['endereco']['bairro']}} - Santo André/SP, CEP {{ $empresa['endereco']['cep']}}</p>
            <p class="center">Telefone: {{ $empresa['telefone']}} - {{ $empresa['email']}}</p> --}}

            <p class="right">Impresso por {{ $usuario['nome'] }} do {{ date('d/m/Y H:i', time()) }}</p>
        </footer>
    </div>

</body>

</html>
