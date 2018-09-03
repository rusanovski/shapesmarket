<?php if (__VER === '__VER') { http_response_code(404); exit; } ?>

<form>
    <?php foreach ($config['fields'] as $field => $values) : ?>
        <div class="filter-group">
            <h4><?php echo $field; ?></h4>
            <?php foreach ($values as $value) : ?>
                <input type="checkbox"
                    id="<?php echo "{$field}_$value"; ?>"
                    name="<?php echo $field; ?>[]"
                    value="<?php echo $value; ?>"
                    <?php if (!is_null($_GET[$field]) && in_array($value, $_GET[$field])) { ?> checked <? } ?>
                    <?php if (array_key_exists($field, $filters) && !in_array($value, $filters[$field])) { ?> disabled <?php } ?>
                >
                <label for="<?php echo "{$field}_$value"; ?>"><?php echo ucfirst($value); ?></label><br>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</form>