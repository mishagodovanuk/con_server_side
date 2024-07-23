<?php

namespace App\Providers;

use App\Helpers\PaginationMacro;
use App\Interfaces\AvatarInterface;
use App\Interfaces\StoreFileInterface;
use App\Interfaces\StoreImageInterface;
use App\Services\File\StoreFile;
use App\Services\File\StoreImage;
use App\Services\User\Avatar;
use App\View\Components\BookmarkComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AvatarInterface::class, function () {
            return new Avatar();
        });

        $this->app->bind(StoreImageInterface::class, function () {
            return new StoreImage();
        });

        $this->app->bind(StoreFileInterface::class, function () {
            return new StoreFile();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         PaginationMacro::changePagination($this);
         Blade::component('bookmark',BookmarkComponent::class);
    }
}
