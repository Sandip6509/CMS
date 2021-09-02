<?php

namespace App\Http\Requests\Posts;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        $postID = $this->post->id;
        return [
            'title'         => ['required',Rule::unique('posts')->ignore($postID)],
            'description'   => ['required'],
            'image'         => ['nullable','image'],
            'content'       => ['required'],
            'category'      => ['required']
        ];
    }
}
