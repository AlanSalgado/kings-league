<?php

class Conexion {
    private static $servidor = 'localhost' ;
    private static $db = 'ccup' ;
    private static $usuario = 'root'; 
    private static $password = '';
    private static $puerto = '3306';
    
    private static $conexion  = null;

    public function __construct() {
        exit('Instancia no permitida');
    }
    
    public static function conectar() {
        if (self::$conexion==null) {     
            try {
                self::$conexion =  new PDO( "mysql:host=".self::$servidor.";port=".self::$puerto.";dbname=".self::$db, self::$usuario, self::$password); 
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                exit($e->getMessage()); 
            }
        }
        return self::$conexion;
    }
    
    public static function desconectar() {
        self::$conexion = null;
    }
}
?>