<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
            'nama' => 'required',
            'nip' => 'required',
            // 'jenisKelamin' => 'required'
        ];
    }
}
