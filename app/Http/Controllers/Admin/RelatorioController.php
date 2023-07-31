<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alvara;
use App\Models\CursoDoCondutor;
use App\Models\CursoDoMonitor;
use App\Models\CursoDoPermissionario;
use App\Models\Permissionario;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    function __construct(Request $request)
    {
        $this->objectModel = Alvara::class;
        $this->request = $request;
    }


    function entradaSaudaDeVeiculos()
    {
        return;
    }

    function alvaraExpirado()
    {
        $alvaras = Alvara::findAlvaraExpirados();

        return parent::responseJSON($alvaras);
    }

    function cursosPermissionarioVencidos()
    {
        $cursosVencidos = CursoDoPermissionario::findCursosVencidos();

        return parent::responseJSON($cursosVencidos);
    }

    function cursosCondutorVencidos()
    {
        $cursos = CursoDoCondutor::findCursosVencidos();

        return parent::responseJSON($cursos);
    }

    function cursosMonitorVencidos()
    {
        $cursos = CursoDoMonitor::findCursosVencidos();

        return parent::responseJSON($cursos);
    }

    function documentosExpirados()
    {
        return parent::responseJSON(Permissionario::findPermissionariosComDocumentosExpirados());
    }

}