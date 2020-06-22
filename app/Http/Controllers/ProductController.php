<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function addItem(Request $request)
    {
        $rules = array(
                'name' => 'required|alpha_num',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(

                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $data = new Product();
            $data->name = $request->name;
            $data->save();

            return response()->json($data);
        }
    }
    public function readItems(Request $req)
    {
        $data = Product::all();

        return view('welcome')->withData($data);
    }
    public function editItem(Request $req)
    {
        $data = Product::find($req->id);
        $data->name = $req->name;
        $data->save();

        return response()->json($data);
    }
    public function deleteItem(Request $req)
    {
        Product::find($req->id)->delete();

        return response()->json();
    }
}
