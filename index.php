<?php

use CustomRouter\Route;

require __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/routes/web.php';

Route::dispatch();
