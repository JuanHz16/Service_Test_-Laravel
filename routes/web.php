<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['application' => 'Atividade de Service e Testes']);
});
