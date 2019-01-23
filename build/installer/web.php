<?php
// env
$env = isset($_POST['env']) ? $_POST['env'] : 'prod';
$debug = isset($_POST['debug']) ? $_POST['debug'] == 'on' : false;

// database
$dbDns = isset($_POST['dbDns']) ? $_POST['dbDns'] : 'mysql:host=localhost;port=3306;dbname=database_name';
$dbUsername = isset($_POST['dbUsername']) ? $_POST['dbUsername'] : 'root';
$dbPassword = isset($_POST['dbPassword']) ? $_POST['dbPassword'] : null;
$dbPrefix = isset($_POST['dbPrefix']) ? $_POST['dbPrefix'] : 'prefix_';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Install Paw</title>
    <style>
    
    </style>
</head>
<body>
    <form method="POST">
        <div class="form-group">
            <label for="input-env">Environment</label>
            <select name="env" id="input-env">
                <option value="prod"<?= $env == 'prod' ? ' selected' : null; ?>>Production</option>
                <option value="dev"<?= $env == 'dev' ? ' selected' : null; ?>>Development</option>
            </select>
        </div>
        <div class="form-group">
            <label for="input-debug">Enable Debug</label>
            <input type="checkbox" name="debug" id="input-debug"<?= $debug ? ' checked="checked"' : null; ?> />
        </div>
        <div class="form-group">
            <label for="input-db-dns">Database DNS</label>
            <input type="text" name="dbDns" id="input-db-dns" value="<?= $dbDns; ?>" />
        </div>
        <div class="form-group">
            <label for="input-db-username">Database User</label>
            <input type="text" name="dbUsername" id="input-db-username" value="<?= $dbUsername; ?>" />
        </div>
        <div class="form-group">
            <label for="input-db-password">Database Passowrd</label>
            <input type="password" name="dbPassword" id="input-db-password" value="<?= $dbPassword; ?>" />
        </div>
        <div class="form-group">
            <label for="input-db-prefix">Table Prefix</label>
            <input type="text" name="dbPrefix" id="input-db-prefix" value="<?= $dbPrefix; ?>" />
        </div>
        <button type="submit">Install</button>
    </form>
</body>
</html>