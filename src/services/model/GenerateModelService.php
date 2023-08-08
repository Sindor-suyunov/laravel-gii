<?php

namespace Sindor\LaravelGii\services\model;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\DTOs\GenerateModelDTO;
use Sindor\LaravelGii\helpers\Generator;
use Sindor\LaravelGii\helpers\Universal;
use Sindor\LaravelGii\services\controller\GenerateResourceControllerService;

class GenerateModelService
{

    public function __construct(public GenerateModelDTO $data)
    {
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->model_namespace,
            'CLASS_NAME' => $this->data->model_name,
            'PARENT_CLASS' => $this->data->model_parent_class,
            'FILLABLE' => $this->getFillable(),
            'CASTS' => $this->getCasts(),
            'RELATIONS' => $this->getRelations(),
        ];
    }

    private function getContents(): array|bool|string
    {
        return Universal::getReadyContent(
            Universal::getStubPath('model','model'),
            $this->getStubVariables()
        );
    }

    public function generateModel(): void
    {
        $path = Universal::makeFileWithDirectory($this->data->model_path, $this->data->model_name);

        Universal::putContent($path, $this->getContents(), $this->data->model_overwrite);

        if ($this->data->add_resource_controller) {
            $service = new GenerateResourceControllerService(GenerateControllerDTO::fromModelDTO($this->data));
            $service->generateResourceController();
        }
    }

    private function getFillable(): string
    {
        if ($this->data->model_is_fillable) {
            return Generator::generateFillableProperty($this->data->columns);
        }
        return "";
    }

    private function getCasts(): string
    {
        if ($this->data->model_has_casts) {
            return Generator::generateCastsProperty($this->data->columns, $this->data->table_name);
        }
        return "";
    }

    private function getRelations(): string
    {
        if ($this->data->model_has_relations) {
            return Generator::generateModelRelations($this->data->table_name);
        }
        return "";
    }
}
