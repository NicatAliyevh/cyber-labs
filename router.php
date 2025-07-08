<?php
// router.php

// If the requested file exists, return it directly
if (php_sapi_name() === 'cli-server') {
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    $file = __DIR__ . $url;
    if (is_file($file)) {
        return false;
    }
}

// Basic routing logic
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($request) {
    case '/'  :
    case '/home' :
        require __DIR__ . '/app/views/home.php';
        break;
    case '/about':
        require __DIR__ . '/app/views/about.php';
        break;
    case '/sql':
        require __DIR__ . '/app/sql/main.php';
        break;
    case '/sql/vulnerable':
        require __DIR__ . '/app/sql/sql_vulnerable.php';
        break;
    case '/sql/fixed':
        require __DIR__ . '/app/sql/sql_fixed.php';
        break;
    case '/xss':
        require __DIR__ . '/app/xss/main.php';
        break;
    case '/xss/vulnerable':
        require __DIR__ . '/app/xss/xss_vulnerable.php';
        break;
    case '/xss/fixed':
        require __DIR__ . '/app/xss/xss_fixed.php';
        break;
    case '/broken_access_control':
        require __DIR__ . '/app/broken access control/main.php';
        break;
    case '/bac/vulnerable/login':
        require __DIR__ . '/app/broken access control/vulnerable/bac_vulnerable_login.php';
        break;
    case '/bac/vulnerable/user':
        require __DIR__ . '/app/broken access control/vulnerable/bac_vulnerable_user.php';
        break;
    case '/bac/vulnerable/admin_cannot_be_guessed':
        require __DIR__ . '/app/broken access control/vulnerable/bac_vulnerable_admin.php';
        break;
    case '/bac/vulnerable/user/robots.txt':
        require __DIR__ . '/app/broken access control/vulnerable/robots.php';
        break;
    case '/bac/fixed/login':
        require __DIR__ . '/app/broken access control/fixed/bac_fixed_login.php';
        break;
    case '/bac/fixed/user':
        require __DIR__ . '/app/broken access control/fixed/bac_fixed_user.php';
        break;
    case '/bac/fixed/admin':
        require __DIR__ . '/app/broken access control/fixed/bac_fixed_admin.php';
        break;
    case '/command_injection':
        require __DIR__ . '/app/command_injection/main.php';
        break;
    case '/command_injection/easy':
        require __DIR__ . '/app/command_injection/os_command_easy.php';
        break;
    case '/command_injection/medium':
        require __DIR__ . '/app/command_injection/os_command_medium.php';
        break;
    case '/command_injection/impossible':
        require __DIR__ . '/app/command_injection/os_command_impossible.php';
        break;
    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
