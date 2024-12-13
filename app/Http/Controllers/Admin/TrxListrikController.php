<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxPemakaianListrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Builder\FunctionLike;

class TrxListrikController extends Controller
{
    public function index()
    {
        $data = TrxPemakaianListrik::with('m_jenis_listrik')->all();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = TrxPemakaianListrik::with('m_jenis_listrik')->find($id);
        if (!$data) {
            return response()->json(null);
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis_listrik_id' => ['required', 'integer', 'exists:m_jenis_listrik,id'],
            'nilai' => ['required', 'float'],
            'datetime' => ['required', 'date'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();
        $data = new TrxPemakaianListrik($validated);
        $data->save();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis_listrik_id' => ['required', 'integer', 'exists:m_jenis_listrik,id'],
            'nilai' => ['required', 'float'],
            'datetime' => ['required', 'date'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();

        $data = TrxPemakaianListrik::find($id);

        if (!$data) {
            return response()->json(null);
        }

        $data->update($validated);

        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = TrxPemakaianListrik::find($id);

        if (!$data) {
            return response()->json(null);
        }

        $data->delete();
        return response()->json(null);
    }
}
