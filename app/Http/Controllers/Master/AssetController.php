<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\MAsset;
use App\Models\MTipeAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\LaravelIgnition\Http\Requests\UpdateConfigRequest;

use function Laravel\Prompts\error;

class AssetController extends Controller
{
    //
    public function index(){
        $data = MAsset::all();
        return response()->json($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama' => ['required','string'],
            'tipe_asset_id' => ['required','string'],
        ]);
        if ($validator->fails()){
            $errors = $validator->errors()->all();
            foreach($errors as $error){
                notyf()->error($error);
            }
            return back();
        }
        $validated = $validator->validated();
        $data = new MAsset();
        $data->save;
        return response()->json($data);
    }

    public function shwo(string $id){
        $data = MTipeAsset::find($id);
        if(!$data){
            return response()->json(null);
        }
        return response()->json($data);
    }

    public function update(Request $request, string $id){
        $validator = Validator::make($request->all(),[
            'nama'=>['required', 'string'],
            'tipe_asset_id'=>['required', 'string'],
        ]);
        if ($validator->fails()){
            $errors = $validator->errors()->all();
            foreach($errors as $error) {
                notyf()->error($error);
            }
            $validated = $validator->validated();
            $data = MAsset::find($id);
            if(!$data){
                return response()->json(null);
            }
            $data->update($validated);
            return response()->json($data);
        }

    }

    public function destroy(string $id){
        $data = MAsset::find($id);
        if (!$data){
            return response()->json(null);
        }
        $data->delete();
        return response()->json(null);
    }

}
