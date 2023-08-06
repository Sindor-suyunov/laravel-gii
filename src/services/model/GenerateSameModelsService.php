<?php

namespace Sindor\LaravelGii\services\model;

use Illuminate\Support\Facades\File;
use Sindor\LaravelGii\DTOs\GenerateControllerDTO;
use Sindor\LaravelGii\DTOs\GenerateSameModelsDTO;
use Sindor\LaravelGii\helpers\Data;
use Sindor\LaravelGii\helpers\Generator;
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

    private function createDirectory(): string
    {
        $path = str(base_path($this->data->model_path))->replace('\\', '/');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        return $path;
    }

    private function getStubPath(): string
    {
        return __DIR__ . "/../../stubs/model/model.stub";
    }

    private function getStubVariables(): array
    {
        return [
            'NAMESPACE' => str($this->data->model_namespace)->replace('/', '\\'),
            'CLASS_NAME' => $this->model_name,
            'FILLABLE' => $this->getFillable(),
            'CASTS' => $this->getCasts(),
            'RELATIONS' => $this->getRelations(),
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

    public function generateModel(): void
    {
        $path = $this->createDirectory() . "/" . $this->model_name . '.php';
        $contents = $this->getContents();

        if (!File::exists($path)) {
            File::put($path, $contents);
        }

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
