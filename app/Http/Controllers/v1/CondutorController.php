<?php
namespace app\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Models\Condutor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CondutorController extends Controller
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
       // dd(parent::getUserLogged()->tipo->id);
       // return Condutor::search(parent::getUserLogged()->permissionario_id, $this->request->query->get("search"));
      // dd('here'); 
      if(parent::getUserLogged()->tipo->id === '3'){
       return Condutor::searchByPermissionario(parent::getUserLogged()->permissionario_id, $this->request->query->get("search"));
      }

      else {
        return Condutor::search( $this->request->query->get("search"));
      }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condutor = Condutor::findComplete($id);
        if (isset($condutor)) {
            return $condutor;
        } else {
            return parent::responseMsgJSON("Condutor não encontrado", 404);
        }
    }

    public function showPhoto($id)
    {
        try {
            $condutor = Condutor::findComplete($id);
            if (isset($condutor)) {
                return Storage::download('arquivos/' . $condutor->foto_uid . '.jpg');
            } else {
                return parent::responseMsgJSON("Condutor não encontrado", 404);
            }
        } catch (\Exception $e) {}

        return parent::responseMsgJSON("Foto não encontrada!", 404);
    }
}
