<?php


namespace App\Modules\products\Htpp\Controller;



use App\Models\Web;
use App\Modules\products\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends \App\Http\Controllers\Controller
{

    public function index(){
        return view('products::index');
    }

    public function create(){
        $webs=Web::all();
        return view('products::create',compact('webs'));
    }

    public function store(Request $request){
          $data=$request->all();






          Validator::make($data,Product::$createRules,Product::$errorMessage)->validate();





        $data['image']=Product::uploadImg($request,'image',null,$data['web_id']);

        $product=Product::create($data);


        DB::table('product_web')->insert([
            'web_id'=>$data['web_id'],
            'product_id'=>$product->id
        ]);

        $request->session()->flash('success_product','PRODUCT CREATED');
        return redirect()->back();

    }


    public function edit($id){
        return view('product::edit');
    }

    public function update(Request $request,$id){

    }

    public function delete($id){

    }



}
