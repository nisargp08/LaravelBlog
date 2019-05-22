<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersEditRequest extends FormRequest
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
        $userid = $this->request->get('user_id');
        return [
            //
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email,'.$userid,
            //'email' => 'required|email|unique:users,email'.$this->id, (for edit profile so it ignores curreent email)
            //'role_id' => 'required|integer',
            //'is_active' => 'required|boolean',
            'photo_id' => 'image|max:2048'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return[
            'photo_id.image' => 'Invalid file extenstion(Select jpg,jpeg,png,...)',
            'photo_id.max:2048' => 'Image size exceeded maximum upload limit(2MB)',
        ];
    }
}
