<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Config;

class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Cargar la configuración desde la base de datos
        $config = Config::first();

        // Verificar si existe la configuración y establecerla dinámicamente
        if ($config) {
            config([
                'adminlte.logo' => '<b>' . $config->site_name . '</b>LTE',
                'adminlte.logo_img' => 'storage/' . $config->logo,
                'adminlte.logo_img_alt' => $config->site_name,
            ]);
        }
    }
}
