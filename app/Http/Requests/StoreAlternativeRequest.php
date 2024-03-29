<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;

class StoreAlternativeRequest extends FormRequest
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
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'right_one' => $this->has('right_one'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|string|max:255',
            'right_one' => 'nullable|boolean',
            'question_id' => 'required|exists:questions,id'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $updating = $this->isMethod('put') || $this->isMethod('patch');

            $question_id = $this->request->get('question_id');

            $question = Question::find($question_id);

            $right_one = $this->input('right_one') == 'true';

            $right_one_exists = $question->alternatives()->where('right_one', true)
                ->when($updating, function ($query) {
                    $alternativeId = $this->route('alternative')->id;  //resource route get object;
                    return $query->where('id', '!=', $alternativeId);
                })->exists();


            if (($question->alternatives()->count() >= 5) && !$updating) {
                $validator->errors()->add('question_id', 'The limit of 5 alternatives has been achieved.');
            }

            if ($right_one_exists && $right_one) {
                $validator->errors()->add('question_id',
                    'There has already an alternative saved as the right one for this question.');
            }
        });
    }
}
