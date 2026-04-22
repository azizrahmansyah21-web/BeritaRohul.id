<?php

namespace App\Http\Requests\Backend\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => ['required' , 'string' , 'max:40'] , 
            'username' => ['required' , 'string' , 'max:50' , 'unique:users,username'] , 
            'email' => ['required' , 'string' , 'email' , 'lowercase' , 'max:50' , 'unique:users,email'] , 
            'phone' => ['required' , 'string' , 'phone:Auto' , 'unique:users,phone'] ,
            'country' => ['nullable' , 'string' , 'max:20'] , 
            'city' => ['nullable' , 'string' , 'max:20'] , 
            'street' => ['nullable' , 'string' , 'max:20'], 
            'email_verified_at' => ['in:0,1'] , 
            'password' => ['required' , 'string' , 'min:8' , 'max:30' , 'confirmed'] , 
            'password_confirmation' => ['required' , 'string' , 'min:8' , 'max:30'] ,
            'status' => ['in:0,1'] , 
            'image' => ['required' , 'image' , 'mimes:png,jpg,jpeg,webp' , 'max:2048'] ,
        ];
    }
}
