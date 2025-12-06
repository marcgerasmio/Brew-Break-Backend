<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if (request()->routeIs('user.login')){
            return [
                'email'=>'required|string|max:255',
                'password'=>'required|min:5',
            ];

        }
        else if (request()->routeIs('user.register')) {
            return [
                'name'=>'required|string|max:255',
                'email'=>'required|string|max:255',
                'password'=>'required|min:5',
            ];
        }
        return [
            'name'=>'required|string|max:255',
            'password'=>'required|min:5',
        ];
    }
}
