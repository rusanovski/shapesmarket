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
            <?php include 'item.php'; ?>
        </main>

        <aside>

            <form>
                <?php foreach ($config['fields'] as $field => $values) : ?>
                    <div class="filter">
                        <h4><?php echo $field; ?></h4>
                        <?php foreach ($values as $value) : ?>
                            <input type="checkbox" name="type[]" value="<?php echo $value; ?>">
                            <label for="type_<?php echo $value; ?>"><?php echo ucfirst($value); ?></label><br>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </form>

        </aside>
    </section>

<script src="assets/app.js?v=<?php echo __VER; ?>"></script>
</body>

</html>