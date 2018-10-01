<?php

namespace Oxygencms\Blocks\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminBlockRequest extends FormRequest
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
        $key = $this->isMethod('POST') ? '' : $this->block->id;

        return [
            'name' => "required|string|unique:blocks,name,$key",
            'body' => 'array|distinct',
        ];
    }
}
