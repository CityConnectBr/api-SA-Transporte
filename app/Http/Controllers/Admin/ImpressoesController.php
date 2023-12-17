<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certidao;
use App\Models\Endereco;
use App\Models\PontoDoPermissionario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class ImpressoesController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    //impressao1certidoes
    function impressoesCertidao()
    {
        if ($this->request['id'] == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
        $id = $this->request['id'];

        $obj = Certidao::findByIdComplete($id);
        if ($obj == null) {
            return parent::responseMsgJSON("Não encontrado", 404);
        }

        $dataFormatada = Carbon::now()->formatLocalized('%d de %B de %Y');

        $dataCertidao = Carbon::parse($obj['data'])->formatLocalized('%d/%m/%Y');

        $ponto = PontoDoPermissionario::findPontoByPermissionario($obj->permissionario->id);
        if ($ponto == null) {
            return parent::responseMsgJSON("Ponto não encontrado", 404);
        } else {
            $ponto = $ponto->ponto;
            $enderecoPonto = Endereco::findComplete($ponto->endereco_id);
            $ponto = $ponto->id_integracao . " - " . $enderecoPonto->endereco . ", " . $enderecoPonto->numero . ", " . $enderecoPonto->bairro . ", " . $enderecoPonto->municipio->nome . ", " . $enderecoPonto->uf;
        }

        $usuario = auth()->user();

        $formlario = "impressoes1certidoes";

        $pdf = PDF::loadView(
            'impressoes/' . $formlario,
            compact(
                'obj',
                'dataCertidao',
                'dataFormatada',
                'ponto',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'portrait')->download($formlario);
    }

    function impressoesListaCertidoes()
    {
        $permissionarioId = $this->request['permissionario'];

        if ($this->request['data_inicial'] == null) {
            return parent::responseMsgJSON("Data inicial não encontrada", 404);
        }

        if ($this->request['data_final'] == null) {
            return parent::responseMsgJSON("Data final não encontrada", 404);
        }

        $dataInicial = $this->request['data_inicial']; //yyyy-mm-dd
        $dataFinal = $this->request['data_final']; //yyyy-mm-dd

        $objList = null;
        if ($permissionarioId == null) {
            $objList = Certidao::findAllByPeriod($dataInicial, $dataFinal);
        } else {
            $objList = Certidao::findAllByPermissionario($permissionarioId, $dataInicial, $dataFinal);
        }

        $dataInicialFormatada = Carbon::parse($dataInicial)->formatLocalized('%d/%m/%Y');
        $dataFinalFormatada = Carbon::parse($dataFinal)->formatLocalized('%d/%m/%Y');

        $usuario = auth()->user();

        $formlario = "impressoes2certidoeslistagem";

        $pdf = PDF::loadView(
            'impressoes/' . $formlario,
            compact(
                'objList',
                'dataInicialFormatada',
                'dataFinalFormatada',
                'usuario'
            )
        );

        return $pdf->setPaper('a4', 'landscape')->download($formlario);
    }

}