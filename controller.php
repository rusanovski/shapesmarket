<?php if (__VER === '__VER') { http_response_code(404); exit; }

    // Delete item when someone buy it.
    if (isset($_POST['delete']) && $_POST['delete'] && is_numeric($_POST['delete'])) {
        mysqli_query($link, "DELETE FROM ". $config['db']['table']. " WHERE id = $_POST[delete];");
    }

    // Generates where query string.
    function where($exclude = null) {
        global $config;
        $where = '';
        $filters = ['type' => 'string', 'color' => 'string', 'size' => 'string', 'stroke' => 'int'];

        foreach ($filters as $filter => $type) {
            if ($exclude && $filter === $exclude) continue;

            if (isset($_GET[$filter]) && $_GET[$filter] && gettype($_GET[$filter]) === 'array') {

                // Protect from SQL injections.
                if ($type === 'string') {
                    foreach ($_GET[$filter] as $i => $value)
                        if (!in_array($value, $config['fields'][$filter])) unset($_GET[$filter][$i]);
                } elseif ($type === 'int') {
                    foreach ($_GET[$filter] as $i => $value)
                        if (!is_numeric($value)) unset($_GET[$filter][$i]);
                }

                if (!count($_GET[$filter])) continue;

                // Build where piece.
                $values = implode($type === 'int' ? ',' : "','", $_GET[$filter]);
                if ($type === 'string') $values = "'$values'";

                if ($where !== '') $where .= " AND ";
                $where .= "`$filter` IN ($values)";
            }
        }

        return $where;
    }

    // Select filtered items from db.
    $where = where();
    if ($where) $where = "WHERE $where";
    $shapes = mysqli_query($link, "SELECT * FROM ". $config['db']['table']. " $where;");

    // Select unavailable fields for filtration.
    $filters = [];
    foreach ($config['fields'] as $field => $type) {

        $where = where($field);
        if ($where) $where = "WHERE $where";
        $result = mysqli_query($link, "SELECT $field FROM ". $config['db']['table']. " $where GROUP BY `$field`;");

        $filters[$field] = [];
        while ($row = mysqli_fetch_row($result)) $filters[$field][] = $row;
        foreach ($filters[$field] as $key => $value) $filters[$field][$key] = $value[0];

    }