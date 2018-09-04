<?php if (__VER === '__VER') { http_response_code(404); exit; } ?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Shapes Market</title>
    <meta name="description" content="All shapes from circles to rectangles">
    <meta name="author" content="Artyom Rusanov">

    <link rel="stylesheet" href="assets/reset.css">
    <link rel="stylesheet" href="assets/app.css?v=<?php echo __VER; ?>">
    <link rel="stylesheet" href="assets/shapes.css?v=<?php echo __VER; ?>">

</head>

<body>
    <section id="app">
        <header>
            <h1>Welcome to Shapes Market!</h1>
            <h2>All shapes from circles to rectangles</h2>
        </header>

        <main>
            <?php include 'items.php'; ?>
        </main>

        <aside>
            <?php include 'filters.php'; ?>
        </aside>
    </section>

<script src="assets/app.js?v=<?php echo __VER; ?>"></script>
</body>

</html>