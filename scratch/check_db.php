<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== ALL INVITATIONS ===\n";
foreach (\App\Models\Invitation::all() as $inv) {
    echo "ID: " . $inv->id . " | Title: " . $inv->title . " | Slug: " . $inv->slug . " | User ID: " . $inv->user_id . "\n";
}

echo "\n=== ALL USERS ===\n";
foreach (\App\Models\User::all() as $u) {
    echo "ID: " . $u->id . " | Name: " . $u->name . " | Email: " . $u->email . "\n";
}
