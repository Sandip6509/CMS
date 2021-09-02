<?php

namespace App\Http\Requests\Tags;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
        $tagID = $this->tag->id;
        return [
            'name' =>['required',Rule::unique('tags')->ignore($tagID)]
        ];
    }
}
