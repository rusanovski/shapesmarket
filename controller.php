<?php if (__VER === '__VER') { http_response_code(404); exit; }

    $where = '';
    $filters = ['type' => 'string', 'color' => 'string', 'size' => 'string', 'stroke' => 'int'];

    foreach ($filters as $filter => $type) {
        if ($_GET[$filter]) {

            $values = implode($type === 'int' ? ',' : "','", $_GET[$filter]);
            if ($type === 'string') $values = "'$values'";

            if ($where !== '') $where .= " AND ";
            $where .= "`$filter` IN ($values)";
        }
    }
    if ($where) $where = "WHERE $where";

    $shapes = mysqli_query($link, "SELECT * FROM ". $config['db']['table']. " $where;");

    foreach ($config['fields'] as $field => $type) {

        if (!$_GET[$field]) {

            $result = mysqli_query($link, "SELECT $field FROM ". $config['db']['table']. " $where GROUP BY `$field`;");
            $filters[$field] = mysqli_fetch_all($result);
            foreach ($filters[$field] as $key => $value) $filters[$field][$key] = $value[0];

        } else unset($filters[$field]);
    }