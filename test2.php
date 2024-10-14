<?php

function getServerInfo() {
    // Get server name
    $serverName = gethostname();

    // Get operating system
    $operatingSystem = php_uname();

    // Get memory usage
    $memoryInfo = shell_exec('free -m');
    $memoryData = preg_split('/\s+/', trim($memoryInfo));
    $totalMemory = $memoryData[7]; // Total memory in MB
    $usedMemory = $memoryData[8]; // Used memory in MB

    // Get disk space usage
    $diskSpaceInfo = disk_total_space("/") . ' ' . disk_free_space("/");
    $diskSpaceData = explode(' ', $diskSpaceInfo);
    $totalDiskSpace = round($diskSpaceData[0] / (1024 ** 3), 2); // Total disk space in GB
    $usedDiskSpace = round(($diskSpaceData[0] - $diskSpaceData[1]) / (1024 ** 3), 2); // Used disk space in GB

    return [
        'serverName' => $serverName,
        'operatingSystem' => $operatingSystem,
        'totalMemory' => $totalMemory,
        'usedMemory' => $usedMemory,
        'totalDiskSpace' => $totalDiskSpace,
        'usedDiskSpace' => $usedDiskSpace
    ];
}

$serverInfo = getServerInfo();
header('Content-Type: application/json');
echo json_encode($serverInfo);
?>
