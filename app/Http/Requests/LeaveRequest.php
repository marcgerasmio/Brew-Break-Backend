<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
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
        if (request()->routeIs('leave.store')){
            return [
                'user_id'=>'required|string|max:255',
                'leave_type'=>'required|string|max:255',
                'start_date'=>'required',
                'end_date'=>'required',
                'reason'=>'required|string|max:255',  
                'status'=>'required',     
            ];
        
        }
          else if (request()->routeIs('leave.update')) {
            return [
                'status'=>'required',    
            ];
        }  
        return [
            'date'=>'required|string|max:255',
            'user_id'=>'required|string|max:255',       
        ];
    }
}
