<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Crypto\Rsa\KeyPair;
use Spatie\Crypto\Rsa\PrivateKey;
use Spatie\Crypto\Rsa\PublicKey;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpatieController extends Controller
{
    public function index()
    {
        [$privateKey, $publicKey] = (new KeyPair())->generate();
        $data = 'my secret data';
        $privateKey = PrivateKey::fromString($privateKey);
        $encryptedData = $privateKey->encrypt($data);
        $publicKey = PublicKey::fromString($publicKey);
        $decryptedData = $publicKey->decrypt($encryptedData);
        return ($decryptedData);
    }
    public function aes()
    {
        DB::table('users')->where('id', 1)->update([
            'name' => crypt::encryptString('hhhhhhhhhhhhhhhhhhhhhhhhh'),
        ]);
        return ('sucsessful');
    }
}
