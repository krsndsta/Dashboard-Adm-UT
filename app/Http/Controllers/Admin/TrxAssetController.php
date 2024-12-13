<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxAsset;
use App\Models\TrxAssetDetail;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;
use Symfony\Polyfill\Intl\Idn\Idn;

class TrxAssetController extends Controller
{
    public function index()
    {
        $data = TrxAssetDetail::with('m_asset')->all();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = TrxAssetDetail::with('m_asset')->find($id);
        if (!$data) {
            return response()->json(null);
        }
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'tipe_asset_id' => ['required', 'integer', 'exists:m_tipe_asset,id'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();

        $data = new TrxAssetDetail($validated);
        $data->save();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'tipe_asset_id' => ['required', 'integer', 'exists:m_tipe_asset,id']
        ]);
        if ($validator->fails()) {
            $errors = $validator->error()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
        }
        return back();

        $validated = $validator->validated();
        $data = TrxAssetDetail::find($id);

        if (!$data) {
            return response()->json(null);
        }
        $data->update($validated);
        return response()->json($data);
    }

    public function destroy($id)
    {
        $data = TrxAssetDetail::find($id);
        if (!$data) {
            return response()->json(null);
        }
        $data->delete();
        return response()->json(null);
    }
}
