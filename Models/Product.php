<?php


namespace App\Modules\products\Models;

use App\Models\Setting;
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


    protected $guarded=['guarded'];

    public static $createRules=[
        'title'=>['required','unique:products'],
        'image'=>['required','image'],
        'price'=>['required','numeric','min:1'],
        'description'=>['required'],
        'web_id'=>['required','exists:webs,id']
    ];

    public static $updateRules=[
        'title'=>['required'],
        'image'=>['image'],
        'price'=>['required','numeric','min:1'],
        'description'=>['required'],
        'web_id'=>['required','exists:webs,id']

    ];

    public static $errorMessage=[
        'title.required'=>'THIS TITLE IS REQUIRED',
        'image.required'=>'THIS IMAGE IS REQUIRED',
        'image.image'=>'THIS IMAGE IS INVALID',
        'price.required'=>'THIS PRICE IS REQUIRED',
        'price.numeric'=>'THIS PRICE MUST BE NUMBER',
        'price.min'=>'THIS PRICE MIN VALUE IS 1',
        'description.required'=>'THIS DESCRIPTION IS REQUIRED',
        'web_id.required'=>'THIS WEBSITE IS REQUIRED',
        'web_id.exists'=>'THIS WEBSITE IS NOT EXISTS',
    ];



    public static function uploadImg($request,$name,$image,$web_id){

        if($request->hasFile($name)){
            if($image){
                Storage::delete($image);
            }
           $setting=Setting::where('web_id','=',$web_id)->where('module_name','=','products')->first();

           if($setting){
               $folder_name=$setting->field_value;
           }else{
               $folder_name='product';
           }



            $folder="{$folder_name}/{$name}/".date("Y-m-d");
            return $request->file($name)->store("{$folder}");
        }
        return null;
    }
}
