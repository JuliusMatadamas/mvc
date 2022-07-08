<?php


namespace app\core;


class Database
{
    public \PDO $pdo;

    /**
     * ============================================================================================
     * Database constructor.
     * @param array $config
     * ============================================================================================
     */
    public function __construct(array $config)
    {
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute (\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable ();
        $appliedMigrations = $this->getAppliedMigrations ();
        $newMigrations = [];

        $files = scandir (Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff ($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration)
        {
            if ($migration === '.' || $migration === '..')
            {
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo ($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log ("Applying migration: $migration");
            $instance->up();
            $this->log ("Migration $migration applyied!");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations))
        {
            $this->saveMigrations($newMigrations);
        }
        else
        {
            $this->log ("All migrations are applied");
        }
    }

    /**
     * ============================================================================================
     * Método para crear la tabla migrations en donde se registrarán las migraciones a realizar
     * ============================================================================================
     */
    public function createMigrationsTable()
    {
        $this->pdo->exec ("CREATE TABLE IF NOT EXISTS `migrations` (`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; COMMIT;");
    }

    public function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare ("SELECT migration FROM migrations");
        $statement->execute ();

        return $statement->fetchAll (\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $migrations = implode (",", array_map (fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare ("INSERT INTO migrations (migration) VALUES $migrations");
        $statement->execute ();
    }

    protected function log($message)
    {
        echo "[".date('Y-m-d H:i:s')."] - $message".PHP_EOL;
    }
}