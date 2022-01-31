<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use Illuminate\Support\Facades\Storage;

class AdminSuperController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct($objectModel, $validatorList, $request, $showOnlyFile = false)
    {
        $this->objectModel = $objectModel;
        $this->validatorList = $validatorList;
        $this->request = $request;
        $this->showOnlyFile = $showOnlyFile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = null;
        if (method_exists($this->objectModel, 'search')) {
            $search = $this->request->input('search');
            if ($search == null) {
                $search = $this->request->query('search');
            }

            $obj = $this->objectModel::search($search);
        } else {
            $obj = $this->objectModel::simplePaginate(15);
        }

        if ($obj != null) {
            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        return parent::responseMsgJSON("Não implementado!", 501);
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
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = new $this->objectModel();
        $obj->fill($request->all());
        //caso contenha arquivo anexo
        if (isset($request->file)) {
            $obj->original_file_name = $request->file->getClientOriginalName();
            $obj->file_name = 'file_' . $obj->id . "." . $request->file->extension();
        }
        $obj->save();

        if (isset($request->file)) {
            $request->file->storeAs('/' . $obj->getTable(), $obj->file_name);
        }

        return $obj;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = $this->objectModel::find($id);
        if (isset($obj)) {

            if ($this->showOnlyFile) {
                return Storage::download($obj->getTable() . '/' . $obj->file_name);
            }

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return parent::responseMsgJSON("Não implementado!", 501);
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
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);
        if (isset($obj)) {

            if (isset($request->file)) {
                $obj->original_file_name = $request->file->getClientOriginalName();
                $obj->file_name = 'file_' . $obj->id . "." . $request->file->extension();
                $request->file->storeAs('/' . $obj->getTable(), $obj->file_name);
            }

            $obj->fill($request->all());
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
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
        $obj = $this->objectModel::find($id);
        if (isset($obj)) {
            if ($obj->delete()) {
                return parent::responseMsgJSON("Deletado com sucesso.");
            } else {
                return parent::responseMsgJSON("Não pode ser deletado.", 500);
            }
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    private function storePhoto(Request $request)
    {
        $arquivo = new Arquivo();
        $arquivo->origem = "web";
        $arquivo->save();

        $request["foto"]->storeAs('/arquivos', $arquivo->id . ".jpg");

        return $arquivo;
    }

    public function storeFoto($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'foto' => [
                'required',
                'file',
            ]
        ]);

        if ($validator->fails()) {
            return Parent::responseMsgsJSON($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);
        if (isset($obj)) {
            $arquivo = $this->storePhoto($request);
            $obj->foto_uid = $arquivo->id;
            $obj->update();

            return $obj;
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }

    public function showFoto($id)
    {
        $obj = $this->objectModel::find($id);
        if ($obj !== null && $obj->foto_uid != null) {
            return Storage::download('/arquivos/' . $obj->foto_uid . ".jpg");
        } else {
            return parent::responseMsgJSON("Não encontrado", 404);
        }
    }
}
