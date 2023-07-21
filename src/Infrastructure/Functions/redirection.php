<?php
function adminRedirection(): void
{
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), DIRECTORY_SEPARATOR);
    $destination = 'admin.php';
    header("Location: http://$host$uri/$destination");

    exit();
}

function indexRedirection(): void
{
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']), DIRECTORY_SEPARATOR);
    $destination = 'index.php';
    header("Location: http://$host$uri/$destination");

    exit();
}