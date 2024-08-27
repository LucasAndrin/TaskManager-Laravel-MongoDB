<?php

namespace App\Http\Middleware;

use App\Http\Requests\TenantRequest;
use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request = TenantRequest::createFrom($request);

        $tenant = $this->resolveTenant($request);

        $request->merge([
            'tenant' => $tenant
        ]);

        return $next($request);
    }

    /**
     * Resolve Tenant from Request
     *
     * @param Request $request
     * @return Tenant
     */
    protected function resolveTenant(TenantRequest $request): Tenant
    {
        $tenantId = $request->tenantId();

        return Tenant::userId(
            $request->user()->id
        )->findOrFail($tenantId);
    }
}
