<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use App\Models\Product;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Testing Product::active() method...\n";

try {
    // Test the scopeActive method
    $activeProducts = Product::active()->get();
    echo "✅ SUCCESS: Product::active() method works!\n";
    echo "Found " . $activeProducts->count() . " active products.\n";

    // Test the query structure
    $query = Product::active();
    echo "✅ Query built successfully: " . $query->toSql() . "\n";

} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "Type: " . get_class($e) . "\n";
}

echo "\nTesting completed.\n";
