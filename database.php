<?php if (__VER === '__VER') { http_response_code(404); exit; }

    $migration = [
        'id' => "INT(11) NOT NULL AUTO_INCREMENT",
        'type' => "ENUM('". implode("','", $config['fields']['type']). "')",
        'color' => "ENUM('". implode("','", $config['fields']['color']). "')",
        'size' => "ENUM('". implode("','", $config['fields']['size']). "')",
        'stroke' => "INT(11) NULL",
        'price' => "INT(11) NOT NULL DEFAULT 0",
    ];

    $link = mysqli_connect($config['db']['host'], $config['db']['user'], $config['db']['password'], $config['db']['database']);

    if (isset($_GET['action'])) {

        if ($_GET['action'] === 'migration') { // Migration. Create db table if not exists.

            $fields = [];
            foreach ($migration as $name => $type)
                $fields[] = "$name $type";
            $fields = implode(',', $fields);

            $result = mysqli_query($link, "CREATE TABLE IF NOT EXISTS ". $config['db']['table']. " ($fields, PRIMARY KEY (id));");

            if ($result) echo 'Migration successful!';
            else { echo "Error: Migration failed."; http_response_code(400); }

            exit;

        } elseif ($_GET['action'] === 'seed') { // Seeding. Randomly fill rows in migrated table.

            $count = mt_rand(90, 900);
            $fields = array_keys($migration);
            if ($fields[0] === 'id') unset($fields[0]);

            $columns = [];
            for ($i = 0; $i < $count; $i++) {
                $column = [
                    $config['fields']['type'][mt_rand(0, count($config['fields']['type']) -1)],
                    $config['fields']['color'][mt_rand(0, count($config['fields']['color']) -1)],
                    $config['fields']['size'][mt_rand(0, count($config['fields']['size']) -1)],
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

            $query = "INSERT INTO ". $config['db']['table']. " ($fields) VALUES $columns;";

            $result = mysqli_query($link, $query);

            if ($result) echo "Seed successful! Rows added: $count.";
            else { echo "Error: Seed failed."; http_response_code(400); }

            exit;

        }
    }