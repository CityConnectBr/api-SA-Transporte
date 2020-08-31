<?php
namespace app\Http\Controllers\Integracao;

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
        'id_permissionario_integracao' => [
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
    ];
    

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

        $permissionario = new Permissionario();
        $permissionario->fill($request->all());
        $permissionario->modalidade_id = Modalidade::findOne($request->input('modalidade_transporte'))->id;
        $permissionario->save();

        $endereco = new Endereco();
        $endereco->fill($request->all());
        $endereco->permissionario_id = $permissionario->id;
        $endereco->save();

        return $permissionario;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissionario = Permissionario::findComplete($id, true);
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

        $permissionario = Permissionario::findComplete($id);
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
