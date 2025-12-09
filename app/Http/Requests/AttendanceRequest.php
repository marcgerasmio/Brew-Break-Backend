<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
        if (request()->routeIs('attendance.checkin')){
            return [
                'user_id' => 'required|integer|exists:users,id',
                'check_in' => 'required|date_format:H:i:s',
                'date' => 'required|date_format:Y-m-d',
                // 'user_id'=>'required|string|max:255',
                // 'check_in'=>'required|string|max:255',
                // 'date'=>'required',
            ];

        }
        else if (request()->routeIs('attendance.checkout')) {
            return [
                'check_out'=>'required',
            ];
        }
        return [
            'date'=>'required|string|max:255',
            'user_id'=>'required|string|max:255',
        ];
    }
}
