<?php


class migration_0000_table_users
{
    /**
     * ============================================================================================
     * Método up, crea la tabla users si esta no existe en la base de datos
     * ============================================================================================
     */
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "CREATE TABLE IF NOT EXISTS `users` (`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `birthdate` date DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL, `created_at` datetime DEFAULT NULL, `deleted_at` datetime DEFAULT NULL, `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; COMMIT;";
        $db->pdo->exec ($SQL);
    }

    /**
     * ============================================================================================
     * Método down, elimina la tabla users de la base de datos
     * ============================================================================================
     */
    public function down()
    {
        $db = \app\core\Application::$app->db;
        $SQL = "DROP TABLE `users`;";
        $db->pdo->exec ($SQL);
    }
}