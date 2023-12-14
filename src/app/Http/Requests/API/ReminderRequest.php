<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReminderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [Rule::requiredIf($this->isMethod('POST')), 'string', Rule::unique('reminders')->ignore($this->id)],
            'description' => [Rule::requiredIf($this->isMethod('POST')), 'string'],
            'remind_at' => [Rule::requiredIf($this->isMethod('POST')), 'integer'],
            'event_at' => [Rule::requiredIf($this->isMethod('POST')), 'integer'],
        ];
    }
}
