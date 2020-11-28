<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" =>"required|String",
            "price"=>"required|numeric",
        ];
    }
    public function messages()
    {
        return[
            "name.required"=>"Please enter name fields",
            "price.required"=>"Please enter price fields",
        ];
    }
}