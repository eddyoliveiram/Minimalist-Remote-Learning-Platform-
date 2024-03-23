<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContentRequest extends FormRequest
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
        $rules = [
            'module_id' => 'required|integer',
            'type' => 'required|in:image,document,article,video',
            'position' => 'nullable|integer',
        ];

        if ($this->type === 'image') {
            $rules['file_uploaded'] = 'required|file|mimes:jpeg,png,gif';
        } elseif ($this->type === 'document') {
            $rules['file_uploaded'] = 'required|file|mimes:doc,docx,xlsx,xls,pdf';
        } elseif ($this->type === 'article') {
            $rules['text_typed'] = 'required|string|min:1';
        } elseif ($this->type === 'video') {
            $rules['video_url'] = 'required|url';
        }


        return $rules;
    }
}
