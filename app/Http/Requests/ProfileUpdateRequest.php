<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone' => ['required', 'string', 'min:7', 'max:20', 'regex:/^[0-9()+]+$/'],  // Add validation rules for phone number with Restrict to numbers, parentheses, and plus sign
            'address' => ['nullable', 'string', 'min:5', 'regex:/^[A-Za-z0-9\s\-\.,]+$/'], // Add validation rules for address number
        ];
    }
}
