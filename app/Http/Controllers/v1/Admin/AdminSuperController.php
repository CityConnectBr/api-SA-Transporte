<?php
namespace App\Http\Controllers\v1\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class AdminSuperController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function __construct($objectModel, $validatorList, $request) {
        $this->objectModel = $objectModel;
        $this->validatorList = $validatorList;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $obj = $this->objectModel::search($this->request->input('search'));
        if (isset($obj)) {
            return $obj;
        } else {
            return response()->json("Não encontrado", 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
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

        $obj = new $this->objectModel();
        $obj->fill($request->all());
        $obj->save();

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
            return $obj;
        } else {
            return response()->json("Não encontrado", 404);
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
            return response()->json($validator->errors(), 400);
        }

        $obj = $this->objectModel::find($id);
        if (isset($obj)) {
            $obj->fill($request->all());
            $obj->save();

            return $obj;
        } else {
            return response()->json("Não encontrado", 404);
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
                return response()->json("Deletado com sucesso.");
            } else {
                return response()->json("Não pode ser deletado.", 500);
            }
        } else {
            return response()->json("Não encontrado", 404);
        }
    }
}
