<?php

namespace App\Http\Requests\Role;

use App\Traits\TenantRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class AssignRoleRequest extends FormRequest
{
    use TenantRequestTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_ids' => ['required', 'array'],
            'user_ids.*' => ['required', 'string'],
        ];
    }
}
