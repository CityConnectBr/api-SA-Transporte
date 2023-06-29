<?php
namespace app\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\SolicitacaoDeAlteracao;
use App\Models\TipoDeSolicitacaoDeAlteracao;
use App\Models\Condutor;
use App\Models\Veiculo;
use App\Models\Permissionario;
use App\Models\Monitor;
use App\Models\Fiscal;
use App\Models\Arquivo;
use Illuminate\Support\Str;

class SolicitacaoDeAlteracaoController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    private $validatorList = [
        /*
         * 'referencia_id' => [
         * 'required',
         * 'max:40'
         * ],
         */
        'tipo_solicitacao_id' => [
            'required',
            'numeric'
        ]
    ];

    public function findIdReferenciaId($tipoDeSolicitacao, $referenciaId)
    {
        if (strpos($tipoDeSolicitacao->nome, 'condutor') !== false) {
            $refObj = Condutor::find($referenciaId);
        } else if (strpos($tipoDeSolicitacao->nome, 'veiculo') !== false) {
            $refObj = Veiculo::find($referenciaId);
        } else if (strpos($tipoDeSolicitacao->nome, 'onibus') !== false) {
            $refObj = Veiculo::find($referenciaId);
        } else if (strpos($tipoDeSolicitacao->nome, 'permissionario') !== false) {
            $refObj = Permissionario::find($referenciaId);
        } else if (strpos($tipoDeSolicitacao->nome, 'monitor') !== false) {
            $refObj = Monitor::find($referenciaId);
        } else if (strpos($tipoDeSolicitacao->nome, 'fiscal') !== false) {
            $refObj = Fiscal::find($referenciaId);
        } else if (strpos($tipoDeSolicitacao->nome, 'infracao') !== false) {
            $refObj = Veiculo::find($referenciaId);
        }

        return $refObj != null ? $refObj->id : null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SolicitacaoDeAlteracao::searchComplete(parent::getUserLogged(), $this->request->query->get("tipo"), $this->request->query->get("referencia"), $this->request->query->get("status"));
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
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeFromUser(Request $request)
    {
        $tipoDeSolicitacao = TipoDeSolicitacaoDeAlteracao::find($request["tipo_solicitacao_id"]);

        if (!isset($tipoDeSolicitacao)) {
            return parent::responseMsgJSON("Tipo de solicitação não encontrado!", 400);
        }

        $usuario = parent::getUserLogged();

        if (isset($usuario->permissionario_id) && strpos($tipoDeSolicitacao->nome, 'permissionario') !== false) {
            $referencia = $usuario->permissionario_id;
        } else if (isset($usuario->fiscal_id) && strpos($tipoDeSolicitacao->nome, 'fiscal') !== false) {
            $referencia = $usuario->fiscal_id;
        } else if (isset($usuario->condutor_id) && strpos($tipoDeSolicitacao->nome, 'condutor') !== false) {
            $referencia = $usuario->condutor_id;
        }

        if (!isset($referencia)) {
            return parent::responseMsgJSON("Usuário logado nao corresponde ao tipo de solicitação de alteração!", 400);
        }

        $request['referencia_id'] = $referencia;

        return $this->store($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $out->writeln("001");
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tipoDeSolicitacao = TipoDeSolicitacaoDeAlteracao::find($request["tipo_solicitacao_id"]);

        if (!isset($tipoDeSolicitacao)) {
            return parent::responseMsgJSON("Tipo de solicitação não encontrado!", 400);
        }

        // procurando a referencia remota
        if (isset($request["referencia_id"])) {
            $idReferenciaRemota = $this->findIdReferenciaId($tipoDeSolicitacao, $request["referencia_id"]);

            if (!isset($idReferenciaRemota)) {
                return parent::responseMsgJSON("Referência não encontrada!", 400);
            }
        }

        $solicitacao = new SolicitacaoDeAlteracao();
        $solicitacao->fill($request->all());
        if (isset($idReferenciaRemota)) {
            $solicitacao->referencia_id = $request["referencia_id"];
        }

        // setando tando referencia local
        if (isset($request["referencia_id"])) {
            $objRef = null;

            //referencias
            if (Str::contains($tipoDeSolicitacao->nome, 'condutor')) {
                $solicitacao->referencia_condutor_id = $request["referencia_id"];
                if (Str::contains($tipoDeSolicitacao->nome, 'endereco')) {
                    $objRef = Condutor::find($request["referencia_id"]);
                }
            } else if (Str::contains($tipoDeSolicitacao->nome, 'veiculo')) {
                $solicitacao->referencia_veiculo_id = $request["referencia_id"];
            } else if (Str::contains($tipoDeSolicitacao->nome, 'onibus')) {
                $solicitacao->referencia_veiculo_id = $request["referencia_id"];
            } else if (Str::contains($tipoDeSolicitacao->nome, 'permissionario')) {
                $solicitacao->referencia_permissionario_id = $request["referencia_id"];
                if (Str::contains($tipoDeSolicitacao->nome, 'endereco')) {
                    $objRef = Permissionario::find($request["referencia_id"]);
                }
            } else if (Str::contains($tipoDeSolicitacao->nome, 'monitor')) {
                $solicitacao->referencia_monitor_id = $request["referencia_id"];
                if (Str::contains($tipoDeSolicitacao->nome, 'endereco')) {
                    $objRef = Monitor::find($request["referencia_id"]);
                }
            } else if (Str::contains($tipoDeSolicitacao->nome, 'fiscal')) {
                $solicitacao->referencia_fiscal_id = $request["referencia_id"];
                if (Str::contains($tipoDeSolicitacao->nome, 'endereco')) {
                    $objRef = Fiscal::find($request["referencia_id"]);
                }
            } else if (strpos($tipoDeSolicitacao->nome, 'infracao') !== false) {
                $solicitacao->referencia_veiculo_id = $request["referencia_id"];
            }

            //setando endereco
            $solicitacao->endereco_id = $objRef != null ? $objRef->endereco_id : null;
        }

        $errors = array();

        // Validacao de campos
        for ($i = 1; $i < 26; $i++) {
            $regexField = $tipoDeSolicitacao['regex_campo' . $i];

            if (isset($regexField)) {
                $field = $solicitacao['campo' . $i];

                if (!preg_match("/" . $regexField . "/", $field)) {
                    array_push($errors, "O campo " . ($tipoDeSolicitacao['desc_campo' . $i]) . "(campo " . $i . "), contem valor inválido.");
                }
            } else {
                break;
            }
        }

        // validação de arquivos
        for ($i = 1; $i < 10; $i++) {
            if (isset($tipoDeSolicitacao['desc_arquivo' . $i])) {
                $fileField = $request->file('arquivo' . $i);

                if (!isset($fileField) || !preg_match("/([a-zA-Z0-9\s_\\.\-\(\):])+(.jpg|.jpeg|.png)$/", $fileField->getClientOriginalName())) {
                    array_push($errors, "O campo " . ($tipoDeSolicitacao['desc_arquivo' . $i]) . "(arquivo " . $i . "), contem valor inválido.");
                }
            } else {
                break;
            }
        }

        if (sizeof($errors) > 0) {
            return parent::responseMsgJSON($errors, 400);
        }

        // setando anteriores como cancelados
        if (isset($solicitacao->referencia_id)) {

            foreach (SolicitacaoDeAlteracao::findAllWaitingByReference($tipoDeSolicitacao->id, $solicitacao->referencia_id) as $solicitacaoEmAberto) {
                SolicitacaoDeAlteracao::cancel($solicitacaoEmAberto);
            }
        }

        // setando usuario
        $user = parent::getUserLogged();
        if (isset($user->permissionario_id)) {
            $solicitacao->permissionario_id = $user->permissionario_id;
        } else if (isset($user->fiscal_id)) {
            $solicitacao->fiscal_id = $user->fiscal_id;
        } else if (isset($user->motorista_id)) {
            $solicitacao->motorista_id = $user->motorista_id;
        }

        // sanvando arquivos
        for ($i = 1; $i < 10; $i++) {
            if (isset($request["arquivo" . $i])) {

                $arquivo = new Arquivo();
                $arquivo->origem = "app";
                $arquivo->save();

                $request["arquivo" . $i]->storeAs('/arquivos', $arquivo->id . ".jpg");

                $solicitacao["arquivo" . $i . "_uid"] = $arquivo->id;
            }
        }

        $solicitacao->save();

        return $solicitacao;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitacao = SolicitacaoDeAlteracao::findComplete($id);
        if (isset($solicitacao)) {
            return $solicitacao;
        } else {
            return parent::responseMsgJSON("Solicitação não encontrada", 400);
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
        $this->show($id);
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
        return response()->json([
            "Message" => "Não implementado!"
        ], 501);
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