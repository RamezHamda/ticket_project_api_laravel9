<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'type' => 'required',
                'user_code' => 'required|unique:users,user_code',
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->route()->user->id,
                'password' => 'nullable|min:6',
                'type' => 'required',
            ];
        }
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_code' => Str::random(8),
        ]);
    }
}
