<?php

use YiYang\Clinico\core\Application;

class m0003_create_policyholders_table{

    public function up()
    {
        $db = Application::$app->db;
        $SQL = "CREATE TABLE policyholders (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                introducer_id INT
            ) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function down()
    {
        $db = Application::$app->db;
        $SQL = "DROP TABLE policyholders;";
        $db->pdo->exec($SQL);
    }

}

?>
