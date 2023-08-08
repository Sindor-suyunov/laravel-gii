<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Sindor\LaravelGii\controllers',
    'prefix' => 'gii',
], function () {

    Route::get('/', 'MainController@index');

    Route::get('/generate-model', 'ModelController@createModel')->name('create-model');
    Route::post('/generate-model', 'ModelController@generateModel')->name('generate-model');

//    Route::get('/generate-models-same-namespace', 'ModelController@createModelsSameNamespace')->name('create-models-same-namespace');
//    Route::post('/generate-model-same-namespace', 'ModelController@generateModelsSameNamespace')->name('generate-models-same-namespace');
});
