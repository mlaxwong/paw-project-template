<?php
$installCompleted = false;
$successRefreshDelay = 3; // 3 second

$env = [];
$noneEnv = [];

// env
$env['ENV'] = isset($_POST['ENV']) ? $_POST['ENV'] : 'prod';
$env['DEBUG'] = isset($_POST['DEBUG']) ? $_POST['DEBUG'] : 'false';

// database
$noneEnv['DB_DRIVER'] = isset($_POST['DB_DRIVER']) ? $_POST['DB_DRIVER'] : 'mysql';
$noneEnv['DB_HOST'] = isset($_POST['DB_HOST']) ? $_POST['DB_HOST'] : 'localhost';
$noneEnv['DB_PORT'] = isset($_POST['DB_PORT']) ? $_POST['DB_PORT'] : '3306';
$noneEnv['DB_NAME'] = isset($_POST['DB_NAME']) ? $_POST['DB_NAME'] : 'database';
$env['DB_USERNAME'] = isset($_POST['DB_USERNAME']) ? $_POST['DB_USERNAME'] : 'root';
$env['DB_PASSWORD'] = isset($_POST['DB_PASSWORD']) ? $_POST['DB_PASSWORD'] : '';
$env['DB_TABLE_PREFIX'] = isset($_POST['DB_TABLE_PREFIX']) ? $_POST['DB_TABLE_PREFIX'] : 'prefix_';

$env['DB_DSN'] = strtr('{driver}:host={host};port={port};dbname={name}', [
    '{driver}' => $noneEnv['DB_DRIVER'],
    '{host}' => $noneEnv['DB_HOST'],
    '{port}' => $noneEnv['DB_PORT'],
    '{name}' => $noneEnv['DB_NAME'],
]);

$data = array_merge($env, $noneEnv);

$fields = [
    'ENV' => [
        'label' => 'Environment',
        'input' => 'dropdown',
        'inputConfig' => [
            'items' => [
                'prod' => 'Production',
                'dev' => 'Development',
            ],
        ],
        'value' => $data['ENV'],
    ],
    'DEBUG' => [
        'label' => 'Enable Debug',
        'input' => 'checkbox',
        'value' => $data['DEBUG'],
    ],
    'DB_HOST' => [
        'label' => 'Database Host',
        'input' => 'text',
        'value' => $data['DB_HOST'],
    ],
    'DB_PORT' => [
        'label' => 'Database Port',
        'input' => 'text',
        'value' => $data['DB_PORT'],
    ],
    'DB_NAME' => [
        'label' => 'Database Name',
        'input' => 'text',
        'value' => $data['DB_NAME'],
    ],
    'DB_USERNAME' => [
        'label' => 'Database Username',
        'input' => 'text',
        'value' => $data['DB_USERNAME'],
    ],
    'DB_PASSWORD' => [
        'label' => 'Database Password',
        'input' => 'password',
        'value' => $data['DB_PASSWORD'],
    ],
    'DB_TABLE_PREFIX' => [
        'label' => 'Table Prefix',
        'input' => 'text',
        'value' => $data['DB_TABLE_PREFIX'],
    ],
];

$errors = [];
$connectionError = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $errors = validate($data, $fields);
    if (!$errors) 
    {
        $connectionError = testDBConnection($data['DB_DSN'], $data['DB_USERNAME'], $data['DB_PASSWORD']);

        if (!$connectionError)
        {
            $file = PATH_ROOT . '/config/.env.dist';
            $installFile = PATH_ROOT . '/config/.env';

            $content = file_get_contents($file);
            foreach ($env as $key => $value)
            {
                $content = preg_replace_callback('/(' . $key . '[\t ]+= )(.*)/', function ($matchs) use ($value) {
                    return $matchs[1] . $value;
                }, $content);
            }
            file_put_contents($installFile, $content);
            $installCompleted = true;
            header("Refresh:" . $successRefreshDelay);
        }
    }
}

function testDBConnection($dsn, $username, $password)
{
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return null;
    } catch (PDOException $ex) {
        return $ex->getMessage();
    }
}

// validation
function validate($data, $fields)
{
    $errors = [];
    $validates = [
        'ENV' => validate_require($data['ENV']),
        'DB_DRIVER' => validate_require($data['DB_DRIVER']),
        'DB_HOST' => validate_require($data['DB_HOST']),
        'DB_PORT' => validate_require($data['DB_PORT']),
        'DB_NAME' => validate_require($data['DB_NAME']),
        'DB_USERNAME' => validate_require($data['DB_USERNAME']),
    ];

    foreach ($validates as $attribute => $error)
    {
        $errorMessage = null;
        if (is_array($error)) {
            foreach ($error as $e)
            {
                if ($e !== null) 
                {
                    $errorMessage = $e;
                    break;
                }
            }
        } else {
            $errorMessage = $error;
        }
        if ($errorMessage) $errors[$attribute] = strtr($errorMessage, ['{attribute}' => $fields[$attribute]['label']]);
    }
    return $errors;
}

function validate_require($value)
{
    $error = null;
    $value = trim($value);
    if ($value === '' || $value === null) $error = '{attribute} is required';
    return $error;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $installCompleted ? 'Success' : 'Install Paw'; ?></title>
    <style>
        * {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            -o-box-sizing: border-box;
        }

        body, html {
            color: #333;
            font-family: "calibri";
        }

        .container {
            width: 500px;
            margin: auto;
            padding: 10px 0px;
        }

        @media only screen and (max-width: 500px) {
            .container {
                width: 100%;
                margin: auto;
                padding: 10px;
            }
        }

        form .form-group {
            margin-bottom: 15px;
        }

        form .form-group label {
            display: block;
            text-transform: uppercase;
            font-size: 0.8em;
            margin-bottom: 3px;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        form .form-group input, 
        form .form-group select {
            width: 100%;
            padding: 3px;
        }

        form .form-group input[type=checkbox] {
            width: auto;
        }

        .btn {
            background-color: #eee;
            padding: 10px;
            border: 1px solid #ddd;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 0.7em;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <?php if ($installCompleted): ?>
        <div class="success">
            <h1>Install Success</h1>
            <p>Auto refresh shortly ...</p>
        </div>
        <?php else: ?>
        <h1>Install Paw</h1>
        <?php if ($connectionError): ?>
        <pre><?= $connectionError; ?></pre>
        <?php endif; ?>
        <form method="POST">
            <?php foreach ($fields as $key => $field): ?>
            <div class="form-group">
                <label for="input-<?= $key; ?>"><?= $field['label']; ?></label>
                <?php if ($field['input'] == 'text' || $field['input'] == 'password'): ?>
                <input type="<?= $field['input']; ?>" name="<?= $key; ?>" value="<?= $field['value']; ?>" placeholder="<?= $field['label']; ?>" />
                <?php elseif ($field['input'] == 'dropdown'): ?>
                <select name="<?= $key; ?>" id="input-<?= $key; ?>">
                    <?php foreach ($field['inputConfig']['items'] as $optionValue => $optionLabel): ?>
                    <option value="<?= $optionValue; ?>"<?= $field['value'] == $optionValue ? ' selected' : null; ?>><?= $optionLabel; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php elseif ($field['input'] == 'checkbox'): ?>
                <input type="checkbox" name="<?= $key; ?>" id="input-<?= $key; ?>"<?= $field['value'] == 'true' ? ' checked="checked"' : null; ?> value="true" />
                <?php endif; ?>
                <?php if (isset($errors[$key])): ?>
                <div class="error"><?= $errors[$key]; ?></div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            
            <button type="submit" class="btn">Install</button>
        </form>
        <?php endif;?>
    </div>
</body>
</html>