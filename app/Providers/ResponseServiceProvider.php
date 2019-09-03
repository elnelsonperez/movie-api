<?php

namespace App\Providers;

use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('api', function ($data, $success = true, $code = 200) use ($factory) {

            if ($success) {
                $customFormat = [
                    'success' => true,
                    'code' => $code,
                    'data' => $data
                ];
            } else {
                $customFormat = [
                    'success' => false,
                    'code' => $code,
                    'message' => $data
                ];
            }
            return $factory->make($customFormat, $code);

        });
    }
}
