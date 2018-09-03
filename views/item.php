<?php if (__VER === '__VER') { http_response_code(404); exit; } ?>

<?php $i = 0; while ($item = mysqli_fetch_object($shapes)) : ?>
<?php if ($i !== 0) { ?></div><?php } ?><div class="item"
    data-type="<?php echo $item->type; ?>"
    data-color="<?php echo $item->color; ?>"
    data-size="<?php echo $item->size; ?>"
    data-stroke="<?php echo $item->stroke; ?>">

    <figure><var></var><i></i></figure>

    <table><tr>
        <td>Price: <b><?php echo $item->price; ?> $</b></td>
        <td align="right"><button>BUY</button></td>
    </tr></table>

<?php $i++; endwhile; ?>
<?php if ($i !== 0) { ?></div><?php } ?>