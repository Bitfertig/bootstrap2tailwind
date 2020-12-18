<?php

require __DIR__ . '/vendor/autoload.php';
use Awssat\Tailwindo\Converter;
#require __DIR__ . '/.env.php';
#require __DIR__ . '/helpers.php';

$example_number = $_GET['example'] ?? 0;

$bootstrap_str = '';
$tailwind_str = '';

if ( $example_number == 1 ) {
    $_POST['bootstrap'] = 'text-center'.PHP_EOL.'text-xs-center'.PHP_EOL.'text-sm-center'.PHP_EOL.'text-md-center'.PHP_EOL.'text-lg-center';
}
if ( $example_number == 2 ) {
    $_POST['bootstrap'] = '<div class="text-muted">love to tailwindo</div>';
}
if ( $example_number == 3 ) {
    $_POST['bootstrap'] = <<<HTML
    <div class="row">
        <div class="col">A</div>
        <div class="col">B</div>
    </div>
    HTML;
}

$bootstrap_str = $_POST['bootstrap'] ?? '';

$converter = (new Converter())->setFramework('bootstrap');
if ( !strstr($bootstrap_str, '<') ) $converter->classesOnly(true);
$tailwind_str = $converter->setContent($bootstrap_str)->convert()->get();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap to Tailwind</title>
</head>
<body>

    <header style="text-align:center;">
        <h1>Bootstrap to Tailwind</h1>
        <p>Transform css classes from Bootstrap to Tailwind.</p>
    </header>


    
    <form method="post" action="?">
        <div style="display:flex;gap:10px;">
            <div style="flex:1;width:100%;">
                <h2 style="text-align:center;">Bootstrap</h2>
                <textarea name="bootstrap" rows="20" style="width:100%;border:1px solid #0077be;"><?= htmlspecialchars($bootstrap_str) ?></textarea>
                <div style="text-align:center;">
                    <a href="?example=1">Example 1</a>
                    <a href="?example=2">Example 2</a>
                    <a href="?example=3">Example 3</a>
                </div>
            </div>
            <div style="flex:1;">
                <h2 style="text-align:center;">Tailwind</h2>
                <textarea name="tailwind" rows="20" readonly style="width:100%;border:1px solid silver;"><?= htmlspecialchars($tailwind_str) ?></textarea>
            </div>
        </div>
        <br>
        <div style="text-align:center;">
            <input type="submit" value="Transform">
        </div>
    </form>


    <footer style="text-align:center;margin:50px 0;">
        Powered by <a href="//www.bitfertig.de">Bitfertig</a> and <a href="https://github.com/awssat/tailwindo">Tailwindo</a>
    </footer>
    
</body>
</html>