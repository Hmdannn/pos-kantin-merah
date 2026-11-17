<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= esc($title ?? 'Kantin Merah') ?>
    </title>
    <link rel="stylesheet" href="<?= base_url('assets/css/formal-ui.css') ?>">
    <?= view('layout/typography') ?>
</head>

<body>

    <?= $this->renderSection('content') ?>

</body>
</html>
