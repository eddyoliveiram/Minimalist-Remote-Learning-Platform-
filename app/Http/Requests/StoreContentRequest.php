<?php

namespace App\Http\Requests;

use App\Rules\ContentTypeRule;
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

        $type = $this->type;

        switch ($type) {
            case 'image':
                $rules['file_uploaded'] = ['required', 'file', new ContentTypeRule($type)];
                break;
            case 'document':
                $rules['file_uploaded'] = ['required', 'file', new ContentTypeRule($type)];
                break;
            case 'article':
                $rules['text_typed'] = ['required', new ContentTypeRule($type)];
                break;
            case 'video':
                $rules['video_url'] = ['required', new ContentTypeRule($type)];
                break;
        }

        return $rules;
    }
}
