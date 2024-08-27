<?php

namespace App\Traits;

trait SerializePivotTenant
{
    private function serializePivotTenant(): void
    {
        $this->user()->load('pivotTenant');
    }

    protected function prepareForValidation(): void
    {
        $this->serializePivotTenant();
    }
}
