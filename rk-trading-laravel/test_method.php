<?php

// Simple test without Laravel bootstrap
echo "Testing Product::active() method fix...\n\n";

// Check if the Product model file exists and has the scopeActive method
$productFile = __DIR__ . '/app/Models/Product.php';

if (!file_exists($productFile)) {
    echo "❌ ERROR: Product model file not found at $productFile\n";
    exit(1);
}

$content = file_get_contents($productFile);

if (strpos($content, 'scopeActive') === false) {
    echo "❌ ERROR: scopeActive method not found in Product model\n";
    exit(1);
}

echo "✅ SUCCESS: scopeActive method found in Product model\n";

if (strpos($content, 'return $query->where(\'is_active\', true);') === false) {
    echo "❌ ERROR: scopeActive method implementation incorrect\n";
    exit(1);
}

echo "✅ SUCCESS: scopeActive method implementation is correct\n";

echo "\n🎉 The BadMethodCallException fix has been successfully implemented!\n";
echo "The Product::active() method should now work correctly.\n\n";

echo "To test it properly, you need to:\n";
echo "1. Set up your .env file with database configuration\n";
echo "2. Run: php artisan migrate\n";
echo "3. Run: php artisan serve\n";
echo "4. Visit: http://localhost:8000/test-products\n";
