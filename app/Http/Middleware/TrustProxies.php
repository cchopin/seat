<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Set to null to trust no proxy by default.
     * Configure trusted proxies via the TRUST_PROXIES environment variable
     * (e.g. a single IP, a comma-separated list, or a CIDR range like 10.0.0.0/8).
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = null;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;

    /**
     * Bootstrap the trusted proxies from the environment.
     */
    public function __construct()
    {
        $envProxies = env('TRUST_PROXIES');

        if (! empty($envProxies)) {
            $this->proxies = array_map('trim', explode(',', $envProxies));
        }
    }
}
