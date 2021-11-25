<?php
namespace app\Http\Controllers\v1;

//use App\Http\Controllers\Admin\AdminSuperController;

use App\Http\Controllers\Controller;
use App\Models\Permissionario;
use App\Utils\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PermissionarioController extends Controller
{
    function __construct(Request $request)
    {
        $this->request = $request;
        //parent::__construct(Permissionario::class, $request);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('parent::getUserLogged()->permissionario_id')
        //return Condutor::search(parent::getUserLogged()->permissionario_id, $this->request->query->get("search"));
        return Permissionario::searchByPermissionario(parent::getUserLogged()->permissionario_id, $this->request->query->get("search"));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permissionario = Permissionario::findComplete($id);
        if (isset($permissionario)) {
            return $permissionario;
        } else {
            return parent::responseMsgJSON("Permissionario não encontrado", 404);
        }
    }

    public function showPhoto($id)
    {
        try {
            $permissionario = Permissionario::findComplete($id);
            if (isset($permissionario)) {
                return Storage::download('arquivos/' . $permissionario->foto_uid . '.jpg');
            } else {
                return parent::responseMsgJSON("Permissionario não encontrado", 404);
            }
        } catch (\Exception $e) {
            return parent::responseMsgJSON("Foto não encontrada!", 404);
        }

        return parent::responseMsgJSON("Foto não encontrada!", 404);
    }
}
    

    // function __construct(Request $request)
    // {
    //     $postMethod = $request->method() == 'POST';
    //     parent::__construct(
    //         Permissionario::class, [
    //             'numero_de_cadastro_antigo' => [
    //                 'max:10',
    //             ],
    //             'nome_razao_social' => [
    //                 'required',
    //                 'max:40',
    //                 'min:3'
    //             ],
    //             'tipo' => [
    //                 'required',
    //                 'regex:/(F|J)/'
    //             ],
    //             'cpf_cnpj' => [
    //                 'required',
    //                 'max:14',
    //                 'min:11',
    //                 'regex:'.Util::REGEX_CPF_CNPJ,
    //                 $postMethod?'unique:permissionarios':''
    //             ],
    //             'rg' => [
    //                 'max:9',
    //             ],
    //             'estado_civil' => [
    //                 'required',
    //                 'max:1',
    //                 'min:1'
    //             ],
    //             'inscricao_municipal' => [
    //                 'required',
    //                 'max:15',
    //                 'min:3'
    //             ],
    //             'alvara_de_funcionamento' => [
    //                 'max:15',
    //             ],
    //             'responsavel' => [
    //                 'max:40',
    //             ],
    //             'procurador_responsavel' => [
    //                 'max:40',
    //             ],
    //             'telefone' => [
    //                 'nullable',
    //                 'regex:'.Util::REGEX_PHONE,
    //             ],
    //             'telefone2' => [
    //                 'nullable',
    //                 'regex:'.Util::REGEX_PHONE,
    //             ],
    //             'celular' => [
    //                 'nullable',
    //                 'regex:'.Util::REGEX_PHONE,
    //             ],
    //             'email' => [
    //                 'nullable',
    //                 'email',
    //                 'max:200',
    //             ],
    //             'data_nascimento' => [
    //                 'nullable',
    //                 'regex:'.Util::REGEX_DATE
    //             ],
    //             'naturalidade' => [
    //                 'max:15',
    //             ],
    //             'nacionalidade' => [
    //                 'max:15',
    //             ],
    //             'cnh' => [
    //                 'max:15',
    //             ],
    //             'categoria_cnh' => [
    //                 'max:2',
    //                 'min:1'
    //             ],
    //             'endereco_id' => [
    //                 $postMethod?'required':'',
    //                 'exists:enderecos,id'
    //             ],
    //             'vencimento_cnh' => [
    //                 'regex:'.Util::REGEX_DATE
    //             ]
    //         ],
    //         $request
    //     );
    // }

