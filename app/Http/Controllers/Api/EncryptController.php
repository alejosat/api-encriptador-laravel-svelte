<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EncryptController extends Controller
{
    public function encrypt(Request $request)
    {
        $text = $request->input('text');

        if (!preg_match('/^[a-z\s]+$/', $text)) {
            return response()->json(['error' => 'El texto debe contener solo letras minúsculas y espacios, sin acentos ni caracteres especiales.'], 400);
        }

        $textEncrypt = str_replace(['e', 'i', 'a', 'o', 'u'], ['enter', 'imes', 'ai', 'ober', 'ufat'], $text);

        return response()->json(['text' => $textEncrypt]);
    }

    public function decrypt(Request $request)
    {
        $text = $request->input('text');

        if (!preg_match('/^[a-z\s]+$/', $text)) {
            return response()->json(['error' => 'El texto debe contener solo letras minúsculas y espacios, sin acentos ni caracteres especiales.'], 400);
        }

        $textDesencrypt = str_replace(['enter', 'imes', 'ai', 'ober', 'ufat'], ['e', 'i', 'a', 'o', 'u'], $text);

        return response()->json(['text' => $textDesencrypt]);
    }
}
