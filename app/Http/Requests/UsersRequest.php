<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            //
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email',
            //'email' => 'required|email|unique:users,email'.$this->id, (for edit profile so it ignores curreent email)
            'role_id' => 'required|integer',
            'is_active' => 'required|boolean',
            'password' => 'required|min:6|max:30',
            'photo_id' => 'image|max:2048'
        ];
    }
}
