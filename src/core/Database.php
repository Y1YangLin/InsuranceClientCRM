<?php

namespace YiYang\Clinico\core;

class Database
{

    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        // let PDO show exception
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigrations = array_diff($files, $appliedMigrations);
        
        foreach($toApplyMigrations as $migration){
            if($migration === '.' || $migration === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);

            $instance = new $className();
            echo "Applying migration $migration" . PHP_EOL;
            $instance->up();
            echo "Applied migration $migration" . PHP_EOL;;

            $newMigrations[] = $migration;

            if(!empty($newMigrations))
            {
                $this->saveMigrations($newMigrations);
            }else{
                echo "All migrations are applied ";
            }
            // echo '<pre>';
            // var_dump($className);
            // echo '</pre>';
            // exit;
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
        $this->pdo->prepare("INSERT INTO migrations (migraion) VALUES
            ('m0001_initial.php'),
            ('m0002_something.php'),
        ");
    }

}