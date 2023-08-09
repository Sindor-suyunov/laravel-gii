<?php

namespace Sindor\LaravelGii\services\controller;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\helpers\Generator;
use Sindor\LaravelGii\helpers\Universal;

class GenerateControllerService
{

    public function __construct(public GenerateControllerDTO $data)
    {
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->namespace,
            'CLASS_NAME' => $this->data->name,
            'PARENT_CLASS' => $this->data->parent_class,
            'ACTIONS' => $this->getActions(),
            'USE' => $this->getUses(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return Universal::getReadyContent(
            Universal::getStubPath('controller','resource-controller'),
            $this->getStubVariables()
        );
    }

    public function generateController(): void
    {
        $path = Universal::makeFileWithDirectory($this->data->path, $this->data->name);
        Universal::putContent($path, $this->getContents(), $this->data->overwrite);
    }

    private function getUses(): string
    {
        if ($this->data->is_resource_controller) return "\nuse " . $this->data->model_namespace . '\\' . $this->data->model_name . ";\nuse Illuminate\Http\Request;";
        return "";
    }

    private function getActions(): string
    {
        if ($this->data->is_resource_controller) return Generator::generateActionsForResourceController($this->data->model_name);
        return "//";
    }
}
