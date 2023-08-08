<?php

namespace Sindor\LaravelGii\services\model;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\DTOs\GenerateSameModelsDTO;
use Sindor\LaravelGii\helpers\Data;
use Sindor\LaravelGii\helpers\Generator;
use Sindor\LaravelGii\helpers\Universal;
use Sindor\LaravelGii\services\controller\GenerateResourceControllerService;

class GenerateSameModelsService
{
    public string $model_name;
    public string $table_name;
    public array $columns;

    public function __construct(
        public GenerateSameModelsDTO $data
    )
    {
    }

    public function generateModels(): void
    {
        $tables = $this->data->table_names;
        foreach ($tables as $table) {
            $this->setColumns($table);
            $this->model_name = Generator::generateSingularModelNameFromTableName($table);
            $this->table_name = $table;
            $this->generateModel();
        }
    }

    public function setColumns($table_name): void
    {
        $this->columns = Data::getColumns($table_name);
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => $this->data->model_namespace,
            'CLASS_NAME' => $this->model_name,
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
        $path = Universal::makeFileWithDirectory($this->data->model_path, $this->model_name);

        Universal::putContent($path, $this->getContents());

        if ($this->data->add_resource_controller) {
            $this->generateResourceController();
        }
    }

    private function getFillable(): string
    {
        if ($this->data->model_is_fillable) {
            return Generator::generateFillableProperty($this->columns);
        }
        return "";
    }

    private function getCasts(): string
    {
        if ($this->data->model_has_casts) {
            return Generator::generateCastsProperty($this->columns, $this->table_name);
        }
        return "";
    }

    private function getRelations(): string
    {
        if ($this->data->model_has_relations) {
            return Generator::generateModelRelations($this->table_name);
        }
        return "";
    }

    private function generateResourceController(): void
    {
        $dto = new GenerateControllerDTO();
        $dto->model_name = $this->model_name;
        $dto->model_namespace = $this->data->model_namespace;
        $dto->controller_path = $this->data->controller_path;
        $dto->controller_namespace = $this->data->controller_namespace;
        $dto->controller_name = $this->model_name . 'Controller';
        $service = new GenerateResourceControllerService($dto);
        $service->generateResourceController();
    }
}
