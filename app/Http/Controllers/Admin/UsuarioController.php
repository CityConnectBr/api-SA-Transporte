<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminSuperController;
use App\Models\Usuario;
use App\Rules\PerfilExists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends AdminSuperController
{

    function __construct(Request $request)
    {
        parent::__construct(
            Usuario::class, [
                'nome' => [
                    'required',
                    'max:100',
                    'min:3'
                ],
                'email' => [
                    'required',
                    'email',
                    'max:200',
                ],
                'password' => [
                    'required',
                    'min:6'
                ],
                'perfil_web_id' => [
                    'required',
                    new PerfilExists
                ]
            ],
            $request
        );
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
        $validator = Validator::make($request->all(), [
            'nome' => [
                'required',
                'max:100',
                'min:3'
            ],
            'email' => [
                'required',
                'email',
                'max:200',
            ],
            'perfil_web_id' => [
                'required',
                new PerfilExists
            ]
        ],);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);
        if (isset($obj)) {
            $passBKP = $obj->password;
            $obj->fill($request->all());
            if($request["password"]==null){
                $obj->password = $passBKP;
            }
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }
}
