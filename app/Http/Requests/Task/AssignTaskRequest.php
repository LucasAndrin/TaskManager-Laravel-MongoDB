<?php

namespace App\Http\Requests\Task;

use App\Traits\SerializePivotTenant;
use App\Traits\TenantRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class AssignTaskRequest extends FormRequest
{
    use TenantRequestTrait;
    use SerializePivotTenant;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
