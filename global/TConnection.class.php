<?php

/*
 * classe TConnection
 * gerencia conexões com bancos de dados através de arquivos de configuração.
 */

final class TConnection {
    /*
     * método __construct()
     * não existirão instâncias de TConnection, por isto estamos marcando-o como private
     */

    private function __construct() {
        
    }

    /*
     * método open()
     * recebe o nome do banco de dados e instancia o objeto PDO correspondente
     */

    public static function open() {

        $ini      = parse_ini_file('../global/config.ini', true);
        $server   = $ini['database']['server'];
        $database = $ini['database']['database'];
        $username = $ini['database']['username'];
        $password = $ini['database']['password'];
        
        $db       = new PDO("mysql:host=$server;dbname=$database", $username, $password);
        // define para que o PDO lance exceções na ocorrência de erros
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->exec("SET NAMES 'utf8'");
        $db->exec('SET character_set_connection=utf8');
        $db->exec('SET character_set_client=utf8');
        $db->exec('SET character_set_results=utf8');
        // retorna o objeto instanciado.
        return $db;
    }

}

?>
