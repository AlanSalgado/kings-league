<?php
//importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once 'modelos/usuario.php'; 
require_once 'modelos/institucion.php';

class DAOUsuario {
    
	private $conexion; 
    
    private function conectar(){
        try{
			$this->conexion = Conexion::conectar(); 
		}
		catch(Exception $e)
		{
			die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
		}
    }
    
	public function obtenerTodos() {
		try {
            $this->conectar();
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT idUsuario,nombre,usuario,correo,telefono,idInstitucion,tipoUsuario FROM usuario");
			
			$sentenciaSQL->execute();
            
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila) {
				$obj = new usuario();
                $obj->idUsuario = $fila->idUsuario;
                $obj->nombre = $fila->nombre;
                $obj->usuario = $fila->usuario;
                $obj->correo = $fila->correo;
                $obj->telefono = $fila->telefono;
                $obj->idInstitucion = $fila->idInstitucion;
                $obj->tipoUsuario = $fila->tipoUsuario;
                $lista[] = $obj;
			}            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
    public function obtenerCorreosCoaches() {
		try {   
            $this->conectar();
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT nombre, correo FROM usuario WHERE tipoUsuario = 3");
			
			$sentenciaSQL->execute();
            
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila) {
				$obj = new usuario();   

                $obj->nombre = $fila->nombre;
                $obj->correo = $fila->correo;
				//Agrega el objeto al arreglo, no necesitamos indicar un índice, usa el próximo válido
                $lista[] = $obj;
			}            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
	}
    

    public function obtenerUno($id) {
		try { 
            $this->conectar();
            
			$obj = null; 
            
			$sentenciaSQL = $this->conexion->prepare("SELECT idUsuario,nombre,usuario,correo,telefono,idInstitucion,tipoUsuario FROM usuario WHERE idUsuario=?"); 
            $sentenciaSQL->execute([$id]);
            
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			
            $obj = new usuario();
            
            $obj->idUsuario = $fila->idUsuario;
            $obj->nombre = $fila->nombre;
            $obj->usuario = $fila->usuario;
            $obj->correo = $fila->correo;
            $obj->telefono = $fila->telefono;
            
            $obj->idInstitucion = $fila->idInstitucion;
            $obj->tipoUsuario = $fila->tipoUsuario;
           
            return $obj;
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}

    public function autenticar($user,$pass) {
		try { 
            $this->conectar();
			$obj = null; 
			$sentenciaSQL = $this->conexion->prepare("SELECT idUsuario,nombre,tipoUsuario FROM usuario WHERE usuario=? and password=sha2(?,224)"); 
            $sentenciaSQL->execute(array($user,$pass));
			$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
			if($fila){
                $obj = new usuario();
                $obj->idUsuario = $fila->idUsuario;
                $obj->nombre = $fila->nombre;
                $obj->tipoUsuario = $fila->tipoUsuario;
                return $obj;
            }else{
                return null;
            }
		}
		catch(Exception $e){
            return null;
		}finally{
            Conexion::desconectar();
        }
	}
    
	public function eliminar($id) {
		try {
			$this->conectar();
            $sentenciaSQL = $this->conexion->prepare("DELETE FROM usuario WHERE idUsuario = ?");			          
			$resultado=$sentenciaSQL->execute(array($id));
			return $resultado;
		} catch (PDOException $e) {
			return false;	
		}finally{
            Conexion::desconectar();
        }  
	}

	public function editar(usuario $obj) {
		try {
			$sql = "UPDATE usuario
                    SET
                    nombre = ?,
                    usuario = ?,
                    correo = ?,
                    telefono = ?,
                    password = sha2(?,224),
                    idInstitucion = ?,
                    tipoUsuario = ?
                    WHERE idUsuario = ?;";
            $this->conectar();
            
            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->nombre,
                      $obj->usuario,
                      $obj->correo,
					  $obj->telefono,
                      $obj->password,
                      $obj->idInstitucion,
                      $obj->tipoUsuario,
                      $obj->idUsuario)
					);
            return true;
		} catch (PDOException $e){
            return $e;
		}finally{
            Conexion::desconectar();
        }
	}


    public function editarPassword(Usuario $obj) {
		try {
			$sql = "UPDATE Usuarios
                    SET
                    password = sha2(?,224)
                    WHERE idUsuario = ?;";
            $this->conectar();

            $sentenciaSQL = $this->conexion->prepare($sql);
			$sentenciaSQL->execute(
				array($obj->password,
                      $obj->idUsuario)
					);
            return true;
		} catch (PDOException $e){
            return $e;
		}finally{
            Conexion::desconectar();
        }
	}

    public function agregar(usuario $obj) {
        try {
            $sql = "INSERT INTO usuario(nombre, usuario, correo, telefono, password, tipoUsuario) 
            VALUES (:nombre, :usuario, :correo, :telefono, sha2(:password,224), :tipoUsuario);";
            $this->conectar();
            $this->conexion->prepare($sql)
                ->execute(
                    array(
                        ':nombre'=>$obj->nombre,
                        ':usuario'=>$obj->usuario,
                        ':correo'=>$obj->correo,
                        ':telefono'=>$obj->telefono,
                        ':password'=>$obj->password,
                        ':tipoUsuario'=>$obj->tipoUsuario
                    )
                );
            return 1;
        } catch (Exception $e){
            return $e;
        }finally{
            Conexion::desconectar();
        }
    }


    public function agregarCoach(usuario $obj) {
        try {
            $sql = "INSERT INTO usuario(nombre, usuario, correo, telefono, password, idInstitucion, tipoUsuario) 
            VALUES (:nombre, :usuario, :correo, :telefono, sha2(:password,224), :idInstitucion, :tipoUsuario);";
            $this->conectar();
            $this->conexion->prepare($sql)
                ->execute(
                    array(
                        ':nombre'=>$obj->nombre,
                        ':usuario'=>$obj->usuario,
                        ':correo'=>$obj->correo,
                        ':telefono'=>$obj->telefono,
                        ':password'=>$obj->password,
                        ':idInstitucion'=>$obj->idInstitucion,
                        ':tipoUsuario'=>$obj->tipoUsuario
                    )
                );
            return 1;
        } catch (Exception $e){
            return $e;
        }finally{
            Conexion::desconectar();
        }
    }


    public function getInstituciones(){
        try {
            $this->conectar();
			$lista = array();
			$sentenciaSQL = $this->conexion->prepare("SELECT idInstitucion, nombre FROM institucion;");
			$sentenciaSQL->execute();
            $resultado = $sentenciaSQL->fetchAll(PDO::FETCH_OBJ);
			foreach($resultado as $fila) {
				$obj = new institucion();
                $obj->idInstitucion = $fila->idInstitucion;
                $obj->nombre = $fila->nombre;
                $lista[] = $obj;
			}            
			return $lista;
		}
		catch(PDOException $e){
			return null;
		}finally{
            Conexion::desconectar();
        }
    }

    
}
