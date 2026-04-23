<?php
header('Content-Type: text/plain');

$configFile = '/tmp/server_delay.txt';
$defaultDelayMs = 100; // Default to 500ms

// --- Logic to UPDATE the delay (in milliseconds) ---
if (isset($_GET['set_delay'])) {
    $newDelayMs = (int)$_GET['set_delay'];
    
    // Safety check: allow 0ms to 30,000ms (30 seconds)
    if ($newDelayMs < 0 || $newDelayMs > 30000) {
        http_response_code(400);
        echo "Error: Delay must be between 0 and 30000 ms.";
        exit;
    }

    file_put_contents($configFile, $newDelayMs);
    echo "Success: Delay updated to $newDelayMs ms.";
    exit;
}

// --- Logic to EXECUTE the delay ---
$currentDelayMs = file_exists($configFile) ? (int)file_get_contents($configFile) : $defaultDelayMs;

// usleep takes microseconds, so we multiply ms by 1000
usleep($currentDelayMs * 1000);

echo "OK - Responded after $currentDelayMs ms.";
?>
