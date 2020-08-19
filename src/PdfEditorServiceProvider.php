<?php

namespace Brandjaws\PDFEditor;

use Illuminate\Support\ServiceProvider;

class PdfEditorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../config/pdf-editor.php' => config_path('pdf-editor.php')
        ]);

        $this->publishes([
            __DIR__.'/../resources/assets' => resource_path('js/vendor/brandjaws/pdf-editor')
        ],'vue-components');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
