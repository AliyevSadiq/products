<?php


namespace App\Modules\products\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Class Contact
 * @package App\Modules\product\Models
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable=['title','image','price','description'];

    protected $table='product';

    public static $createRules=[
        'title'=>['required','unique:products'],
        'image'=>['required','image'],
        'price'=>['required','numeric','min:1'],
        'description'=>['required']
    ];

    public static $updateRules=[
        'title'=>['required'],
        'image'=>['image'],
        'price'=>['required','numeric','min:1'],
        'description'=>['required']
    ];

    public static $errorMessage=[
        'title.required'=>'THIS TITLE IS REQUIRED',
        'image.required'=>'THIS IMAGE IS REQUIRED',
        'image.image'=>'THIS IMAGE IS INVALID',
        'price.required'=>'THIS PRICE IS REQUIRED',
        'price.numeric'=>'THIS PRICE MUST BE NUMBER',
        'price.min'=>'THIS PRICE MIN VALUE IS 1',
        'description.required'=>'THIS DESCRIPTION IS REQUIRED'
    ];



    public static function uploadImg($request,$name,$image=null){
        if($request->hasFile($name)){
            if($image){
                Storage::delete($image);
            }
            $folder="product1111/{$name}/".date("Y-m-d");
            return $request->file($name)->store("images/{$folder}");
        }
        return null;
    }
}
