<?php

namespace Sindor\LaravelGii\services\controller;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\helpers\Generator;

class GenerateResourceControllerService
{

    public function __construct(public GenerateControllerDTO $data
    )
    {
    }

    private function createDirectory(): string
    {
        $path = str(base_path($this->data->controller_path))->replace('\\', '/');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        return $path;
    }

    private function getStubPath(): string
    {
        return __DIR__ . "/../../stubs/controller/resource-controller.stub";
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => str($this->data->controller_namespace)->replace('/', '\\'),
            'CLASS_NAME' => $this->data->controller_name,
            'ACTIONS' => $this->getActions(),
            'USE' => $this->getUses(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    private function getStubContents($stub, $stubVariables = []): array|bool|string
    {
        $contents = file_get_contents($stub);
        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }
        return $contents;
    }

    public function generateResourceController(): void
    {
//        dd($this->data);
        $path = $this->createDirectory() . "/" . $this->data->controller_name . '.php';
        $contents = $this->getContents();

        if (!File::exists($path)) {
            File::put($path, $contents);
        }
    }

    private function getActions(): string
    {
        return Generator::generateActionsForResourceController($this->data->model_name);
    }

    private function getUses(): string
    {
        return "\nuse " . $this->data->model_namespace . '\\' . $this->data->model_name . ";\nuse Illuminate\Http\Request;";
    }
}
