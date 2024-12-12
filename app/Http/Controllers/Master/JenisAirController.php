<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MJenisAir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisAirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MJenisAir::all();
        return response()->json($data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'deskripsi' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();

        $data = new MJenisAir($validated);
        $data->save();

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = MJenisAir::find($id);

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
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string'],
            'deskripsi' => ['required', 'string']
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            foreach ($errors as $error) {
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();

        $data = MJenisAir::find($id);

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
        $data = MJenisAir::find($id);

        if (!$data) {
            return response()->json(null);
        }

        $data->delete();
        return response()->json(null);
    }
}
