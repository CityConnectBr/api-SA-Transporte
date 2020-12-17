<?php
namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitor;
use Illuminate\Support\Facades\Storage;

class MonitorController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Monitor::search(parent::getUserLogged()->permissionario_id, $this->request->query->get("search"));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $monitor = Monitor::findComplete($id);
        if (isset($monitor)) {
            return $monitor;
        } else {
            return parent::responseMsgJSON("Condutor não encontrado", 404);
        }
    }

    public function showPhoto($id)
    {
        try {
            $monitor = Monitor::findComplete($id);
            if (isset($monitor)) {
                return Storage::download('fotos_monitores/monitor_' . $id . '.jpg');
            } else {
                return parent::responseMsgJSON("Monitor não encontrado", 404);
            }
        } catch (\Exception $e) {}

        return parent::responseMsgJSON("Foto não encontrada!", 404);
    }
}
