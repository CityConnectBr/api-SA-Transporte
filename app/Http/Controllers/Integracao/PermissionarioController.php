<?php
namespace app\Http\Controllers\Integracao;

use App\Http\Controllers\Integracao\IntegracaoController;
use App\Models\Endereco;
use App\Models\Modalidade;
use Illuminate\Http\Request;
use App\Models\Permissionario;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PermissionarioController extends IntegracaoController
{

    function __construct()
    {
        parent::__construct(Permissionario::class, [
            'nome' => [
                'required',
                'max:40',
                'min:3'
            ],
            'id_integracao' => [
                'required',
                'numeric'
            ],
            'modalidade_transporte' => [
                'required',
                'max:1',
                'min:1'
            ],
            'situacao' => [
                'required',
                'max:1',
                'min:1'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // paginate
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $endereco = new Endereco();
        $endereco->fill($request->all());
        $endereco->save();

        $permissionario = new Permissionario();
        $permissionario->fill($request->all());
        $permissionario->modalidade_id = Modalidade::findOne($request->input('modalidade_transporte'))->id;
        $permissionario->endereco_id = $endereco->id;
        // atualizando status da foto
        $permissionario->setStatus(null, $request['foto_url']);

        $permissionario->save();

        return $permissionario;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function storeFoto(Request $request, $id)
    {
        $permissionario = Permissionario::findByIntegracaoComplete($id, true);
        if (isset($permissionario)) {

            // atualizando status da foto
            $permissionario->setStatus($request['foto'], $request['foto_url']);

            // 0=sem foto, 1=com foto, 2=com foto url
            switch ($permissionario->status_foto) {
                case 0:
                    $permissionario->foto_url = null;
                    break;
                case 1:
                    $request->foto->storeAs('/fotos_permissionarios', "permissionario_" . $permissionario->id . ".jpg");
                    break;
                case 2:
                    $permissionario->foto_url = $request["foto_url"];
                    break;
            }

            $permissionario->save();

            return parent::responseMsgJSON("Concluído!");
        } else {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
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
        $permissionario = Permissionario::findByIntegracaoComplete($id, true);
        if (isset($permissionario)) {
            return $permissionario;
            // return (new PermissionarioTransformer)->transform(Permissionario::find($id));
        } else {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
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

        $permissionario = Permissionario::findByIntegracaoComplete($id, true);
        if (isset($permissionario)) {
            $permissionario->fill($request->all());
            $permissionario->versao ++;
            $permissionario->modalidade_id = Modalidade::where('identificador', $request->input('modalidade_transporte'))->first()->id;
            $permissionario->endereco->fill($request->all());

            $permissionario->save();
            $permissionario->endereco->save();

            return $permissionario;
        } else {
            return parent::responseMsgJSON("Permissionário não encontrado", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
    }
}
