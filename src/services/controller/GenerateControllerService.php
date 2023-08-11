<?php

namespace Sindor\LaravelGii\services\controller;

use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\helpers\Controller;
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
            'TRAITS' => $this->getTraits(),
            'INTERFACES' => $this->getInterfaces(),
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
        if ($this->data->is_resource_controller and $this->data->is_generation_actions) return Controller::generateActionsForResourceController($this->data->model_name);
        return "//";
    }

    private function getTraits(): string
    {
        if ($this->data->has_traits and $this->data->traits){
            return "\n\tuse " . $this->data->traits . ";\n";
        }
        return "";
    }

    private function getInterfaces(): string
    {
        if ($this->data->has_interfaces and $this->data->interfaces){
            return "implements " . $this->data->interfaces;
        }
        return "";
    }
}
