<?php

    $where = '';
    $filters = ['type' => 'string', 'color' => 'string', 'size' => 'int', 'stroke' => 'int'];

    foreach ($filters as $filter => $type) {
        if ($_GET[$filter]) {
            $values = implode($type === 'int' ? ',' : "','", $_GET[$filter]);
            if ($type === 'string') $values = "'$values'";
            if ($values) {
                if ($where !== '') $where .= " AND ";
                $where .= "`$filter` IN ($values)";
            }
        }
    }
    if ($where) $where = "WHERE $where";

    $shapes = mysqli_query($link, "SELECT * FROM $config[table] $where;");