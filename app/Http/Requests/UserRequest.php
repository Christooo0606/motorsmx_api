<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required',
            'lname' => 'nullable',
            'Fname' => 'nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'google_id' => 'nullable',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user)
            ],
            'phoneno' => 'nullable',
            'address1' => 'nullable',
            'address2' => 'nullable',
            'city' => 'nullable',
            'state' => 'nullable',
            'country' => 'nullable',
            'pincode' => 'nullable',
            'email_verified_at' => 'nullable|date',
            'password' => 'nullable',
            'role_as' => 'nullable|integer',
        ];

        return $rules;
    }
}
