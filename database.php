<?php

    $config = [
        'host' => '127.0.0.1',
        'user' => 'root',
        'password' => 'password',
        'database' => 'shapemarket',
        'table' => 'shapes',

        'types' => ['circle', 'triangle', 'rectangle'],
        'colors' => ['red', 'green', 'blue', 'purple', 'yellow', 'orange'],
        'sizes' => ['M', 'L', 'XL'],
    ];

    $migration = [
        'id' => "INT(11) NOT NULL AUTO_INCREMENT",
        'type' => "ENUM('". implode("','", $config['types']). "')",
        'color' => "ENUM('". implode("','", $config['colors']). "')",
        'size' => "ENUM('". implode("','", $config['sizes']). "')",
        'stroke' => "INT(11) NULL",
        'price' => "INT(11) NOT NULL DEFAULT 0",
    ];

    $link = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);

    if ($_GET['action'] === 'migration') {

        $fields = [];
        foreach ($migration as $name => $type)
            $fields[] = "$name $type";
        $fields = implode(',', $fields);

        $result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS $config[table] ($fields, PRIMARY KEY (id));");

        if ($result) echo 'Migration successful!';
        else { echo "Error: Migration failed."; http_response_code(400); }

        exit;

    } elseif ($_GET['action'] === 'seed') {

        $count = mt_rand(90, 900);
        $fields = array_keys($migration);
        if ($fields[0] === 'id') unset($fields[0]);

        $columns = [];
        for ($i = 0; $i < $count; $i++) {
            $column = [
                $config['types'][mt_rand(0, count($config['types']) -1)],
                $config['colors'][mt_rand(0, count($config['colors']) -1)],
                $config['sizes'][mt_rand(0, count($config['sizes']) -1)],
                null,
                mt_rand(1, 100) * 90
            ];

            $exp = ($column[0] === 'triangle' && in_array($column[2], ['M', 'L'])) ? mt_rand(-1, 3) :
                (($column[0] !== 'triangle' && $column[2] === 'M') ? mt_rand(-1, 4) : mt_rand(-1, 5));
            if ($exp < 0) $column[3] = 0;
            else $column[3] = pow(2, $exp);

            foreach ($column as &$value)
                if (gettype($value) === 'string') $value = "'$value'";

            $columns[] = '('. implode(',', $column). ')';
        }
        $fields = implode(',', $fields);
        $columns = implode(",\r\n", $columns);

        $query = "INSERT INTO $config[table] ($fields) VALUES $columns;";

        $result = mysqli_query($link, $query);

        if ($result) echo "Seed successful! Rows added: $count.";
        else { echo "Error: Seed failed."; http_response_code(400); }

        exit;

    }