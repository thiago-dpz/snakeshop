<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error <?= $statusCode ?> - Snakeshop</title>
</head>

<body>

    <div class="error-container">
        <h1>Error <?= $statusCode ?></h1>
        <p><?= $errorMessage ?></p>

        <a href="<?= $homeUrl ?>" class="btn">Go back Home</a>
    </div>

</body>

</html>