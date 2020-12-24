<?php
namespace app\Http\Controllers\Integracao;

use Illuminate\Http\Request;
use App\Models\Permissionario;
use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Condutor;
use App\Models\Monitor;

class ArquivoController extends Controller
{

    function __construct()
    {}

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function storeFotoPermissionario(Request $request, $id)
    {
        $permissionario = Permissionario::findByIntegracaoComplete($id, true);
        if (! isset($permissionario)) {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }

        if (! isset($request['foto'])) {
            return parent::responseMsgJSON("É necessário enviar um arquivo.", 404);
        }

        $arquivo = new Arquivo();
        $arquivo->origem = "integrador";
        $arquivo->save();

        if (isset($arquivo)) {

            $request->foto->storeAs('/arquivos', $arquivo->id . ".jpg");

            $permissionario->foto_uid = $arquivo->id;
            $permissionario->save();

            return parent::responseMsgJSON("Concluído!");
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function storeFotoCondutor(Request $request, $id)
    {
        $conditor = Condutor::findByIntegracaoComplete($id, true);
        if (! isset($conditor)) {
            return parent::responseMsgJSON("Condutor não encontrado", 404);
        }
        
        if (! isset($request['foto'])) {
            return parent::responseMsgJSON("É necessário enviar um arquivo.", 404);
        }
        
        $arquivo = new Arquivo();
        $arquivo->origem = "integrador";
        $arquivo->save();
        
        if (isset($arquivo)) {
            
            $request->foto->storeAs('/arquivos', $arquivo->id . ".jpg");
            
            $conditor->foto_uid = $arquivo->id;
            $conditor->save();
            
            return parent::responseMsgJSON("Concluído!");
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function storeFotoMonitor(Request $request, $id)
    {
        $monitor = Monitor::findByIntegracaoComplete($id, true);
        if (! isset($monitor)) {
            return parent::responseMsgJSON("Monitor não encontrado", 404);
        }
        
        if (! isset($request['foto'])) {
            return parent::responseMsgJSON("É necessário enviar um arquivo.", 404);
        }
        
        $arquivo = new Arquivo();
        $arquivo->origem = "integrador";
        $arquivo->save();
        
        if (isset($arquivo)) {
            
            $request->foto->storeAs('/arquivos', $arquivo->id . ".jpg");
            
            $monitor->foto_uid = $arquivo->id;
            $monitor->save();
            
            return parent::responseMsgJSON("Concluído!");
        }
    }
}
