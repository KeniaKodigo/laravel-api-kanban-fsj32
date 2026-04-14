<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:tasks|max:50',
            'description' => 'required|string',
            'status' => 'required|in:pendiente,en proceso,completado',
            'priority' => 'required|in:baja,media,alta',
            //año-mes-dia
            'due_date' => 'nullable|date|after_or_equal:today',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
