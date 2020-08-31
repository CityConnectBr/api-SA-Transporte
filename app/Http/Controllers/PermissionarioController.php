<?php
namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Endereco;
use App\Models\Modalidade;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;

class PermissionarioController extends Controller
{

    private $validatorList = [
        'nome' => [
            'required',
            'max:40',
            'min:3'
        ],
    ];
    
    public function me()
    {
        if(auth()->user()->tipo_id===1){
            return Permissionario::findComplete(auth()->user()->permissionario_id);
        }else{
            return parent::responseMsgJSON("Usuário não é um permissionário.", 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return parent::responseJSON($validator->errors(), 400);
        }

        $permissionario = Permissionario::findComplete($id);
        if (isset($permissionario)) {
            $permissionario->versao++;
            $permissionario->telefone =  $request->input('modalidade_transporte');
            
            
            
            $permissionario->save();
            
            return $permissionario;
        } else {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
    }
}
