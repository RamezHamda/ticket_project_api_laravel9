<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
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
                'status' => 'required',
                'parent_id' => 'nullable',
                'short_code' => 'required|unique:catalogs,short_code',
                'response_time' => 'required|numeric',
                'normal' => 'required|numeric',
                'moderated' => 'required|numeric',
                'critical' => 'required|numeric',
            ];
        } else {
            return [
                'name' => 'required',
                'status' => 'required',
                'parent_id' => 'nullable',
                'short_code' => 'required|unique:catalogs,short_code',
                'response_time' => 'required|numeric',
                'normal' => 'required|numeric',
                'moderated' => 'required|numeric',
                'critical' => 'required|numeric',
            ];
        }
    }

    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //        // 'user_id' => request()->user()->id,
    //         'short_code' => Str::random(8),
    //     ]);
    // }
}
