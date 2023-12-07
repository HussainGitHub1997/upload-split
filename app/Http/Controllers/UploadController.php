<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function upload(Request $request)
    {
        $path = $request->file->Store('public/uploads');

        return response()->json(['message' => 'File uploaded successfully', 'file_path' => $path]);
    }
    public function show()
    {
    //    $file=Storage::get('public/uploads/jlrK72Dss9cG2wlxu0GaNhTwNTmuzDltFYYJxnz7');
        $size = Storage::size("public/uploads/file");
        return response()->json(['message' => 'File uploaded successfully', 'file_size' => "$size  bytes"]);
    }


    public function encryption()
    {
        $data = Storage::get("public/uploads/IdCu8ouUx1HvLLMkDL9F4PMMcQ5NbJevXFYkEQfY.txt");
        $size = Storage::size("public/uploads/IdCu8ouUx1HvLLMkDL9F4PMMcQ5NbJevXFYkEQfY.txt");

        $split = str_split($data, 2000);
        $array_size = count($split);

        echo " index 0 = " . strlen($split[0]);
        echo " bytes = " . $size  . "\n";
        echo " arraySize = " . $array_size;
        $encryptionMethod = "AES-256-CBC";
        $secretKey = "ThisIsASecretKey123";
        $iv = '1234567891011121';

        for ($i = 0; $i < $array_size; $i++) {
            $encrypt_data[$i] = openssl_encrypt($split[$i], $encryptionMethod, $secretKey, 0, $iv,);
        }

        // Print_r($myArray);
        $file_name = "file";
        $string_data = json_encode($encrypt_data);
        file_put_contents("$file_name", $string_data);
        Storage::put("public/uploads/saved/$file_name", $string_data);
        echo asset('storage/public/uploads/saved' . "file name: $file_name");
        //Print_r($myArray);
    }

    public function decription()
    {
        $file_name = "file";
        $decryptionMethod = "AES-256-CBC";
        $secretKey = "ThisIsASecretKey123";
        $iv = '1234567891011121';
        $encrypt_data = json_decode(file_get_contents($file_name), true);
        //    print_r ($arr2);
        $array_size = count($encrypt_data);
        for ($i = 0; $i < $array_size; $i++) {
            $data[$i] = openssl_decrypt($encrypt_data[$i], $decryptionMethod, $secretKey, 0, $iv,);
        }
        // Print_r($data);
        $decrypt_data = '';
        foreach ($data as $all) {
            $decrypt_data .= $all;
        }

        Storage::put("public/uploads/decrypt/$file_name", $decrypt_data);
        echo asset('storage/public/uploads/decrypt' . "file name: $file_name ");
        //print_r($text2);



    }
}
