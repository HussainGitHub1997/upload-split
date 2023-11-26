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
      $f=Storage::get('public/uploads/EYL12ZZJ7WEP31Oz7S4FsC6cfrdIStzljDy2aCbY');
       $size = Storage::size("public/uploads/file");
       return response()->json(['message' => 'File uploaded successfully', 'file_size' => "$size  bytes"]);

    }


    public function split(){
        $text =Storage::get('public/uploads/EYL12ZZJ7WEP31Oz7S4FsC6cfrdIStzljDy2aCbY');
          print_r($text);
        $split = str_split($text, 5);
        //  dd($split);
        $arraySize = count($split);
        $size = Storage::size("public/uploads/EYL12ZZJ7WEP31Oz7S4FsC6cfrdIStzljDy2aCbY");
       // dd($arraySize);
        $l=$size/5;
        for($i=0;$i<$l;$i++){
            $s[$i]=  crypt::encryptString($split[$i]);
        }
        // Print_r($s);
         for($i=0;$i<$l;$i++){
            // $x = $split[$i];
            $k[$i]= crypt::decryptString($s[$i]);
        }
        $a='';
        foreach($k as $q){
            $a .=$q;
        }
dd($a);
//         Print_r($split);
//         $arraySize = count($split);
// echo "array size " . $arraySize;
//         for($i=0;$i<=6;$i++){
//                  $s= crypt::encryptString($split[$i]);
//         }
//          $k= crypt::decryptString($s);
//       dd($k);
        // dd($split);
        // foreach ($split as $s) {
            // DB::table('users')->where('id', 1)->update([
            //     'name' => crypt::encryptString('kkkkkkkkkkffffffffffmmmmmmmmmm
            //     ')]);
            //     // $user = User::where('id', 2)->first();
            //     //      $a=$user->name;
            //        //  $split = str_split($a, 1);
            //         //  dd($split);

        //    for($i=0;$i<Str::length($split);$i++){
        //         ( $split[$i]);
            //  // $s=  crypt::encryptString($split[$i]);
            // $s= crypt::decryptString($a);
            //  DB::table('users')->where('id', 2)->update([
            //     'name' => $s,
            // ]);
          //  }



    }
}

// $handle = fopen('/path/to/bigfile.txt','r');  //open big file with fopen
// $f = 1; //new file number

// while(!feof($handle))
// {
//     $newfile = fopen('/path/to/newfile' . $f . '.txt','w'); //create new file to write to with file number
//     for($i = 1; $i <= 5000; $i++) //for 5000 lines
//     {
//         $import = fgets($handle);
//         fwrite($newfile,$import);
//         if(feof($handle))
//         {break;} //If file ends, break loop
//     }
//     fclose($newfile);
//     //MySQL newfile insertion stuff goes here
//     $f++; //Increment newfile number
// }
// fclose($handle);
