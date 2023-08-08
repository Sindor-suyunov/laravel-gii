<?php

namespace Sindor\LaravelGii\services\controller;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\helpers\Generator;
use Sindor\LaravelGii\helpers\Universal;

class GenerateResourceControllerService
{

    public function __construct(public GenerateControllerDTO $data)
    {
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->controller_namespace,
            'CLASS_NAME' => $this->data->controller_name,
            'PARENT_CLASS' => $this->data->controller_parent_class,
            'ACTIONS' => Generator::generateActionsForResourceController($this->data->model_name),
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

    public function generateResourceController(): void
    {
        $path = Universal::makeFileWithDirectory($this->data->controller_path, $this->data->controller_name);
        Universal::putContent($path, $this->getContents(), $this->data->controller_overwrite);
    }

    private function getUses(): string
    {
        return "\nuse " . $this->data->model_namespace . '\\' . $this->data->model_name . ";\nuse Illuminate\Http\Request;";
    }
}
