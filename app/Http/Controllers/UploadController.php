<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Print_;
// use Illuminate\Support\Facades\Facade\DB;
class UploadController extends Controller
{

    public function upload(Request $request){
 $path=$request->file->Store('public/uploads');

//  echo ("$size");
return response()->json(['message' => 'File uploaded successfully', 'file_path' => $path]);
    }
    public function show(){
      $f=Storage::get('public/uploads/jlrK72Dss9cG2wlxu0GaNhTwNTmuzDltFYYJxnz7');
       $size = Storage::size("public/uploads/file");
       return response()->json(['message' => 'File uploaded successfully', 'file_size' => "$size  bytes"]);

    }


    public function split(){
        $text =Storage::get("public/uploads/rCWHJZAYE9XWNK7RnqVAFJW7hIhr6q5yNibFnOUI.3gp");
        $size = Storage::size("public/uploads/rCWHJZAYE9XWNK7RnqVAFJW7hIhr6q5yNibFnOUI.3gp");
        $split = str_split($text, 250);
        echo " index 0 = " . strlen($split[0]);
        $array_size = count($split);
       echo " bytes = " .$size;
       echo " arraySize = " .$array_size;
       $split_text="";

      // $file = 'public/uploads/saved/save_file7';
        for($i=0;$i<$array_size;$i++){
            $myArray[$i]=  crypt::encryptString($split[$i]);
          // $split_text .=$myArray[$i];
        }
$file_name="hhhl";
file_put_contents("$file_name",json_encode($myArray));
 Storage::put("public/uploads/saved/$file_name", $split_text);
        echo asset('storage/public/uploads/saved');
//          Print_r($myArray);
    }

        public function decription_file(){
        //    $n =Storage::get('public/uploads/saved/array.json');
           //$text1 =Storage::get('public/uploads/saved/array_json');
           $file_name="hhhl";
           $arr2 = json_decode(file_get_contents($file_name), true);
           $array_size = count($arr2);          
            for($i=0;$i<$array_size;$i++){
                            $chars[$i]= crypt::decryptString($arr2[$i]);
                        }
                        // Print_r($chars);
                        $text2='';
                        foreach($chars as $n){
                            $text2 .=$n;
                        }

                        Storage::put("public/uploads/decrypt/$file_name", $text2);
                        echo asset('storage/public/uploads/decrypt');
                        //print_r($text2);



        }
    }

//




