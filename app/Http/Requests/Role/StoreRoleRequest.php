<?php

namespace App\Http\Requests\Role;

use App\Traits\TenantRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:3'],
            'alias' => ['required', 'string', 'min:3'],
            'description' => ['nullable', 'string'],
        ];
    }
}
