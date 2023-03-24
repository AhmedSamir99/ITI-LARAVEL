<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'post_creator'=>'exists:users,id',
            'title' => ['required' , 'min:3','unique:posts,title,'.$this->post],
            'description'=>['required' , 'min:10'],
            'image'=>['max:2048','mimes:jpg,jpeg,png'],
            //
        ];
    }

    public function messages(): array
{
    return [
        'title.required' => 'A title is required',
        'body.required' => 'A message is required',
    ];
}
}
