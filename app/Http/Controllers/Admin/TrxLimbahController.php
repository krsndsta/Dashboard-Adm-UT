<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrxKetinggianLimbah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\error;

class TrxLimbahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = TrxKetinggianLimbah::with('trx_ketinggian_limbah')->all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'nilai' => ['required', 'float'],
            'datetime' => ['required', 'date']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }

        $validated = $validator->validated();
        $data = new TrxKetinggianLimbah($validated);
        $data->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $data = TrxKetinggianLimbah::with('trx_ketinggian_limbah')->find($id);
        if (!$data) {
            return response()->json(null);
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nilai' => ['required', 'float'],
            'datetime' => ['required', 'date']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();
        $data = TrxKetinggianLimbah::find($id);

        if (!$data) {
            return response()->json(null);
        }
        $data->update($validated);
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data = TrxKetinggianLimbah::find($id);
        if ($data) {
            return response()->json(null);
        }
        $data->delete();
        return response()->json(null);
    }
}
