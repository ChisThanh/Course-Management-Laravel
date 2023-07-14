<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Validation\Rule;
use App\Enums\StudentStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'date',
                // 'before:today',
            ],
            'status' => [
                'required',
                Rule::in(StudentStatusEnum::asArray()),
            ],
            'avatar' => [
                'nullable',
                'file',
                'image',
            ],
            'course_id' => [
                'required',
                Rule::exists(Course::class, 'id'),
            ],
        ];
    }
}
