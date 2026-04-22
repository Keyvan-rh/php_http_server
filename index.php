<?php
// Set the response type to plain text
header('Content-Type: text/plain');

// Configuration: Get 'delay' from query string, default to 2 seconds
$delay = isset($_GET['delay']) ? (int)$_GET['delay'] : 2;

// Validation: Limit the delay to prevent long-running hanging processes
if ($delay > 10) {
    echo "Error: Delay too long. Keep it under 10 seconds.";
    exit;
}

// The "Work": Wait for the configurable amount of time
sleep($delay);

// The Response
echo "OK - Responded after $delay seconds.";
?>
