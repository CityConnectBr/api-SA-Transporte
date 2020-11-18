<?php
namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Monitor;

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
        $condutor = Monitor::findComplete($id);
        if (isset($condutor)) {
            return $condutor;
        } else {
            return parent::responseMsgJSON("Condutor não encontrado", 404);
        }
    }
}
