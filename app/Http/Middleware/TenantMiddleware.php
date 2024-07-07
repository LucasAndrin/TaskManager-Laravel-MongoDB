<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
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
    protected function resolveTenant(Request $request): Tenant
    {
        $tenantId = $request->header('X-Tenant-ID');

        return Tenant::userId(
            $request->user()->id
        )->findOrFail($tenantId);
    }
}
