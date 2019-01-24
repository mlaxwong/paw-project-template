<?php
if (!file_exists(PATH_ROOT . '/config/.env'))
{
    require __DIR__ . '/install.php';
    exit;
}