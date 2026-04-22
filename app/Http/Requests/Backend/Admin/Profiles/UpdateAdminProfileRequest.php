<?php

namespace App\Http\Requests\Backend\Admin\Profiles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAdminProfileRequest extends FormRequest
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
        $adminId = Auth::guard('admin')->user()->id ; 
        return [
            'name' => ['required' , 'string' , 'min:3' , 'max:25'], 
            'username' => ['required' , 'string' , 'min:5' , 'max:30' , 'unique:admins,username,' . $adminId], 
            'email' => ['required' , 'string' , 'email' , 'lowercase' , '' , 'min:8','max:50' , 'unique:admins,email,' . $adminId], 
            'current_password' => ['required' , 'string' , 'min:8' , 'max:30'] , 
            'new_password' => ['required' , 'string' , 'min:8' , 'max:30' , 'confirmed'] , 
        ];
    }
}
