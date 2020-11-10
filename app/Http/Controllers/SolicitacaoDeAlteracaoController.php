<?php
namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\SolicitacaoDeAlteracao;
use App\Models\TipoDeSolicitacaoDeAlteracao;
use App\Models\Condutor;
use App\Models\Veiculo;
use App\Models\Permissionario;
use Illuminate\Support\Facades\Storage;

class SolicitacaoDeAlteracaoController extends Controller
{

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    private $validatorList = [
        /*'referencia_id' => [
            'required',
            'max:40'
        ],*/
        'tipo_solicitacao_id' => [
            'required',
            'numeric'
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //$out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //$out->writeln("001");
        
        $validator = Validator::make($request->all(), $this->validatorList);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $tipoDeSolicitacao = TipoDeSolicitacaoDeAlteracao::find($request["tipo_solicitacao_id"]);

        if(!isset($tipoDeSolicitacao)){
            return parent::responseMsgJSON("Tipo de solicitação não encontrado!", 400);
        }

        if (strpos($tipoDeSolicitacao->nome, 'condutor') !== false) {
            $objRef = Condutor::find($request["referencia_id"]);
        }else if (strpos($tipoDeSolicitacao->nome, 'veiculo') !== false) {
            $objRef = Veiculo::find($request["referencia_id"]);
        }if (strpos($tipoDeSolicitacao->nome, 'onibus') !== false) {
            $objRef = Veiculo::find($request["referencia_id"]);
        }if (strpos($tipoDeSolicitacao->nome, 'permissionario') !== false) {
            $objRef = Permissionario::find($request["referencia_id"]);
        }if (strpos($tipoDeSolicitacao->nome, 'monitor') !== false) {
            //$objRef = Monitor::find($request["referencia_id"]);
        }

        // if(!isset($objRef)){
        //     return parent::responseMsgJSON("Referência não encontrada!", 400);
        // }

        $solicitacao = new SolicitacaoDeAlteracao();
        $solicitacao->fill($request->all());

        $errors = array();

        //Validacao de campos
        for($i = 1;$i < 26;$i++){
            $regexField = $tipoDeSolicitacao['regex_campo'.$i];

            if(isset($regexField)){
                //alterações na expressao para PHP
                $regexField = str_replace('-', '\-', $regexField);
                //

                $field = $solicitacao['campo'.$i];

                if(!preg_match("/".$regexField."/", $field)){
                    array_push($errors, "O campo ".($tipoDeSolicitacao['desc_campo'.$i])."(campo ".$i."), contem valor inválido.");
                }

            }else{
                break;
            }
        }

        //validação de arquivos
        for($i = 1;$i < 10;$i++){           
            if(isset($tipoDeSolicitacao['desc_arquivo'.$i])){
                $fileField = $request->file('arquivo'.$i);
                
                if(!isset($fileField) || !preg_match("/([a-zA-Z0-9\s_\\.\-\(\):])+(.jpg|.jpeg|.png)$/", $fileField->getClientOriginalName())){                   
                    array_push($errors, "O campo ".($tipoDeSolicitacao['desc_arquivo'.$i])."(arquivo ".$i."), contem valor inválido.");
                }
                
            }else{
                break;
            }
        }

        if(sizeof($errors)>0){
            return parent::responseMsgJSON($errors, 400);
        }

        // setando anteriores como cancelados
        if(isset($solicitacao->referencia_id)){
            foreach(SolicitacaoDeAlteracao::findAllWaitingByReference($solicitacao->referencia_id) as $solicitacaoEmAberto){
                SolicitacaoDeAlteracao::cancel($solicitacaoEmAberto);
            }
        }
        
        //setando usuario
        $user = parent::getUserLogged();
        if(isset($user->permissionario_id)){
            $solicitacao->permissionario_id = $user->permissionario_id;
        }else if(isset($user->fiscal_id)){
            $solicitacao->fiscal_id = $user->fiscal_id;
        }else if(isset($user->motorista_id)){
            $solicitacao->motorista_id = $user->motorista_id;
        }

        $solicitacao->save();

        //sanvando arquivos
        for ($i = 1; $i < 10; $i++) {
            if(isset($request["arquivo".$i])){
                $request->arquivo1->storeAs('/solicitacao_de_alteracao_arquivos',"solicitacao_".$solicitacao->id."_arquivo".$i.".jpg");
            }
        }

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

    public function getdoc($id){
        
        $solicitacao = SolicitacaoDeAlteracao::find($id);
        if(!asset($solicitacao)){
            return parent::responseMsgJSON("Solicitação não encontrada", 404);
        }
        
        $doc = $this->request->query('doc');
        
        if(!isset($doc)){
            $doc = 1;
        }

        return Storage::download('solicitacao_de_alteracao_arquivos/solicitacao_'.$solicitacao->id.'_arquivo'.$doc.'.jpg');
    }
}
