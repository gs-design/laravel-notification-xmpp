<?php

namespace GsDesign\XMPP;

use Illuminate\Support\ServiceProvider;

class XMPPServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the applications services.
     */
    public function boot()
    {
        $this->app->when(XMPPChannel::class)
            ->needs(XMPP::class)
            ->give(function() {
                return new XMPP(
                    config('services.xmpp.host'),
                    config('services.xmpp.port'),
                    config('services.xmpp.user'),
                    config('services.xmpp.pass'),
                    config('services.xmpp.resource')
                );
            });
    }

    /**
     * Register any packages services.
     */
    public function register()
    {
    }
}