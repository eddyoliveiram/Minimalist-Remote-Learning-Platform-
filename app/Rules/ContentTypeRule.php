<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContentTypeRule implements Rule
{
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function passes($attribute, $value)
    {
        switch ($this->type) {
            case 'image':
                return $attribute === 'file_uploaded' && in_array($value->getClientOriginalExtension(),
                        ['jpeg', 'png', 'gif']);
            case 'document':
                return $attribute === 'file_uploaded' && in_array($value->getClientOriginalExtension(),
                        ['doc', 'docx', 'xlsx', 'xls', 'pdf']);
            case 'article':
                return $attribute === 'text_typed' && is_string($value) && strlen($value) > 0;
            case 'video':
                return $attribute === 'video_url' && filter_var($value, FILTER_VALIDATE_URL);
            default:
                return false;
        }
    }

    public function message()
    {
        return 'The :attribute is invalid for the selected type.';
    }
}

