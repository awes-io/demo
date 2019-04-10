<?php

namespace App\Sections\Settings\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Sections\Settings\Rules\CurrentPassword;

class ChangePassword extends FormRequest
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
            'password_current' => ['required', new CurrentPassword],
            'password' => 'required|confirmed|min:6',
        ];
    }
}