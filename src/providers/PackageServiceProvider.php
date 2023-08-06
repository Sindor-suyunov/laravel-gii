<?php

namespace Sindor\LaravelGii\providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Sindor\LaravelGii\livewire\model\CreateModelComponent;
use Sindor\LaravelGii\livewire\model\CreateModelsSameNamespace;

class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadViewsFrom(__DIR__ . '/../resources/views','gii');
        Livewire::component('create-model',CreateModelComponent::class);
        Livewire::component('create-models-same-namespace',CreateModelsSameNamespace::class);
    }
}
