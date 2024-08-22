<?php

namespace YiYang\Clinico\core\db;

use YiYang\Clinico\core\Application;


class Database
{

    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        // let PDO shows exception
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        // create Migration Table in DB
        $this->createMigrationsTable();

        //從取得已經applied 的 migration
        $appliedMigrations = $this->getAppliedMigrations();

        // initialize for new coming migrations
        $newMigrations = [];
        // looking for migration files in /migrations folder
        $files = scandir(Application::$ROOT_DIR . '/migrations');

        // 用array_diff 對 $files 中的migraion檔案及已經applied 過的migration檔案取差集
        // 差集 == 要 apply 的 migrations
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        
        foreach($toApplyMigrations as $migration){

            if($migration === '.' || $migration === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up();
            $this->log("Applied migration $migration");

            $newMigrations[] = $migration;

        }

        // var_dump($newMigrations);
        // exit;

        if(!empty($newMigrations)){
            $this->saveMigrations($newMigrations);
        }else{
            $this->log("All migrations are applied");
        }

    }
    
    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        // if only type $statement->fetchAll() ，only returns array
        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {   
        // implode: join array with a string
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str
        ");
        $statement->execute();
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }

    protected function log($message){
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }

}