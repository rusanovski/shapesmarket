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
            <?php $first = true; while ($item = mysqli_fetch_object($shapes)) : ?>
                <?php if (!$first) { ?></div><?php } ?><div class="item"
                     data-type="<?php echo $item->type; ?>"
                     data-color="<?php echo $item->color; ?>"
                     data-size="<?php echo $item->size; ?>"
                     data-stroke="<?php echo $item->stroke; ?>">

                    <figure><var></var><i></i></figure>

                    <table><tr>
                        <td>Price: <b><?php echo $item->price; ?> $</b></td>
                        <td align="right"><button>BUY</button></td>
                    </tr></table>

            <?php $first = false; endwhile; ?>
            </div>
        </main>

        <aside>
            <form>
                <div class="filter-section">
                    <h4>CORNERS COUNT</h4>

                    <input type="checkbox" name="type[]" value="circle">
                    <input type="checkbox" name="type[]" value="triangle">
                    <input type="checkbox" name="type[]" value="rectangle">
                </div>

                <div class="filter-section">
                    <h4>COLOR</h4>

                    <input type="checkbox" name="colors[]" value="red">
                    <input type="checkbox" name="colors[]" value="green">
                    <input type="checkbox" name="colors[]" value="blue">
                </div>

                <div class="filter-section">
                    <h4>STROKE</h4>

                    <input type="checkbox" name="stoke[]" value="1">
                    <input type="checkbox" name="stoke[]" value="2">
                    <input type="checkbox" name="stoke[]" value="4">
                    <input type="checkbox" name="stoke[]" value="8">
                    <input type="checkbox" name="stoke[]" value="16">
                    <input type="checkbox" name="stoke[]" value="32">
                </div>

            </form>
        </aside>
    </section>

<script src="assets/app.js?v=<?php echo __VER; ?>"></script>
</body>

</html>