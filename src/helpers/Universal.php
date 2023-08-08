<?php

namespace Sindor\LaravelGii\helpers;

use Illuminate\Support\Facades\File;

class Universal
{
    public static function putContent(string $path, $content,$overwrite = false): void
    {
        if (!File::exists($path) or $overwrite) {
            File::put($path, $content);
        }
    }

    public static function createDirectory(string $backPath): string
    {
        $path = base_path(self::replaceSlashes($backPath));
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        return $path;
    }

    public static function createFileFromName(string $path, string $name): string
    {
        return $path . "/" . $name . '.php';
    }

    public static function makeFileWithDirectory(string $backPath, string $name): string
    {
        return self::createFileFromName(self::createDirectory($backPath), $name);
    }

    public static function replaceSlashes(string $string)
    {
        return str($string)->replace('\\','/');
    }

    public static function getStubPath(string $dir, string $name): string
    {
        return __DIR__ . "/../stubs/$dir/$name.stub";
    }

    public static function getReadyContent(string $stub, array $values): array|bool|string
    {
        $contents = file_get_contents($stub);
        foreach ($values as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }
        return $contents;
    }
}
