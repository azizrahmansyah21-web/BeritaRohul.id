<?php

namespace App\Http\Requests\adminAuth\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required' , 'string' , 'min:10' , 'max:100'] ,
            'description' => ['required' , 'string' , 'min:100' ,'max:1000'] ,
            'images' => ['required' , 'array'] , 
            'images.*' => ['required' , 'image' , 'mimes:jpg,png,jpeg,webp' , 'max:2048'] , 
            'category_id' => ['required' , 'exists:categories,id']  , 
            'comment_able' => ['required' , 'in:0,1'] , 
            'small_description' => ['nullable' , 'string' , 'min:70'] ,
            'status' => ['required' , 'in:0,1'] ,
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'category' ,
            'comment_able' => 'comment ablility' , 
        ] ; 
    }
}
