<?php

namespace App\Http\Requests;

use App\Traits\SerializePivotTenant;
use App\Traits\TenantRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
{
    use TenantRequestTrait;
    use SerializePivotTenant;
}
