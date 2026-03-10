<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo 'products=' . App\Models\Product::count() . PHP_EOL;
echo 'latest_id=' . (App\Models\Product::latest()->value('id') ?? 'null') . PHP_EOL;
echo 'latest_name=' . (App\Models\Product::latest()->value('name') ?? 'null') . PHP_EOL;
echo 'latest_sku=' . (App\Models\Product::latest()->value('sku') ?? 'null') . PHP_EOL;
echo 'latest_created_at=' . (App\Models\Product::latest()->value('created_at') ?? 'null') . PHP_EOL;

