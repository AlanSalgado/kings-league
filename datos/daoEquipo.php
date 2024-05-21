<?php
    require_once 'conexion.php';
    require_once 'modelos/equipo.php';
    require_once 'modelos/concurso.php';
    //session_start();

    class DAOEquipo {
        private $conexion;

        private function conectar(){
            try {
                $this -> conexion = Conexion::conectar();
            }
            catch(Exception $e) {
                die($e->getMessage());
            }
        }

        public function obtenerTodos() {
            try {
                $this -> conectar();

                $lista = array();
                $query = $this -> conexion -> prepare("SELECT * FROM equipo");
                $query -> execute();

                $resultado = $query -> fetchAll(PDO::FETCH_OBJ);

                foreach($resultado as $fila) {
                    $obj = new equipo();
					$obj->idEquipo = $fila->idEquipo;
                    $obj->nombre = $fila->nombreEquipo;
                    $obj->estudiante1 = $fila->estudiante1;
                    $obj->estudiante2 = $fila->estudiante2;
                    $obj->estudiante3 = $fila->estudiante3;
                    $obj->status = $fila->status;
                    $obj->aprobado = $fila->aprobado;
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

        public function obtenerTodosPorCoach($id) {
            try {
                $this -> conectar();

                $lista = array();
                $query = $this -> conexion -> prepare("SELECT idEquipo, nombreEquipo, estudiante1, estudiante2, estudiante3 FROM equipo where idUsuario=?");
                $query -> execute([$id]);

                $resultado = $query -> fetchAll(PDO::FETCH_OBJ);

                foreach($resultado as $fila) {
                    $obj = new equipo();
					$obj->idEquipo = $fila->idEquipo;
                    $obj->nombre = $fila->nombreEquipo;
                    $obj->estudiante1 = $fila->estudiante1;
                    $obj->estudiante2 = $fila->estudiante2;
                    $obj->estudiante3 = $fila->estudiante3;
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

        public function agregar(equipo $obj) {
            try {
                $sql = "INSERT INTO equipo(nombreEquipo, idUsuario, idConcurso, aprobado, estudiante1, estudiante2, estudiante3)
                VALUES (:nombre, :idUsuario, :idConcurso, :aprobado, :estudiante1, :estudiante2, :estudiante3);";
                $this->conectar();
                $user = "";
                if($obj->idUsuario){
                    $user=$obj->idUsuario;
                }else{
                    $user=$_SESSION["idUsuario"];
                }
                $this->conexion->prepare($sql)
                    ->execute(
                        array(
                            ':nombre'=>$obj->nombre,
                            ':idUsuario'=>$user,
                            ':idConcurso'=>$obj->idConcurso,
                            ':aprobado'=>0,
                            ':estudiante1'=>$obj->estudiante1,
                            ':estudiante2'=>$obj->estudiante2,
                            ':estudiante3'=>$obj->estudiante3
                        )
                    );
                return 1;
            } catch (Exception $e){
                return $e;
            }finally{
                Conexion::desconectar();
            }
        }

        public function obtenerListadoConcursos() {
            try {
                $this -> conectar();
                $lista = array();
                $query = $this -> conexion -> prepare("SELECT idConcurso, nombreConcurso FROM concurso");
                $query -> execute();
    
                $resultado = $query -> fetchAll(PDO::FETCH_OBJ);
    
                foreach($resultado as $fila){
                    $obj = new concurso();
                    $obj->idConcurso = $fila->idConcurso;
                    $obj->nombreConcurso = $fila->nombreConcurso;
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
		
		
		public function obtenerUno($id){
			try { 
				$this->conectar();
            
				$obj = null; 
            
				$sentenciaSQL = $this->conexion->prepare("SELECT idEquipo, nombreEquipo, idUsuario, idConcurso, aprobado, estudiante1, estudiante2, estudiante3 FROM equipo WHERE idEquipo=?"); 
				$sentenciaSQL->execute([$id]);
				
				$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
				
				$obj = new equipo();
				
				$obj->idEquipo = $id;
				$obj->nombre = $fila->nombreEquipo;
				$obj->idUsuario = $fila->idUsuario;
				$obj->idConcurso = $fila->idConcurso;
				$obj->aprobado = $fila->aprobado;
				$obj->estudiante1 = $fila->estudiante1;
				$obj->estudiante2 = $fila->estudiante2;
				$obj->estudiante3 = $fila->estudiante3;
			   
				return $obj;
			}
			catch(Exception $e){
				return null;
			}finally{
				Conexion::desconectar();
			}
		}

        public function updateStatus($id){
            try { 
				$this->conectar();
            
				$obj = 0; 
            
				$sentenciaSQL = $this->conexion->prepare("SELECT aprobado FROM equipo WHERE idEquipo=?"); 
				$sentenciaSQL->execute([$id]);
				$fila=$sentenciaSQL->fetch(PDO::FETCH_OBJ);
				$obj = $fila->aprobado;

                if($obj==1){
                    $sentenciaSQL = $this->conexion->prepare("UPDATE equipo SET aprobado = ? WHERE idEquipo = ?");
                    $sentenciaSQL->execute([0,$id]);
                   // return true;
                }else{
                    $sentenciaSQL = $this->conexion->prepare("UPDATE equipo SET aprobado = ? WHERE idEquipo = ?");
                    $sentenciaSQL->execute([1,$id]);
                }
				return $obj;

                
			}
			catch(Exception $e){
				return false;
			}finally{
				Conexion::desconectar();
			}
        }
		
		public function editar(equipo $obj){
		try{
				$sql = "UPDATE equipo SET
						nombreEquipo = :nombre,
						idUsuario = :idUsuario,
						idConcurso = :idConcurso,
						aprobado = :aprobado,
						estudiante1 = :estudiante1,
						estudiante2 = :estudiante2,
						estudiante3 = :estudiante3
						WHERE idEquipo = :idEquipo;";
				$this->conectar();
				$this->conexion->prepare($sql)
					 ->execute(array(
						':nombre'=>$obj->nombre,
					 ':idUsuario'=>$obj->idUsuario,
					 ':idConcurso'=>$obj->idConcurso,
					 ':aprobado'=>$obj->aprobado,
					 ':estudiante1'=>$obj->estudiante1,
					 ':estudiante2'=>$obj->estudiante2,
					 ':estudiante3'=>$obj->estudiante3,
					 ':idEquipo' => $obj->idEquipo));
				return true;
			} catch (Exception $e){
				return false;
			}finally{
				Conexion::desconectar();
			}
		}
		
		public function obtenerTodosAprobados() {
            try {
                $this -> conectar();

                $lista = array();
                $query = $this -> conexion -> prepare("SELECT e.nombreEquipo AS equipo, e.estudiante1 AS estudiante1, e.estudiante2 AS estudiante2, e.estudiante3 AS estudiante3, u.Nombre AS coach, i.nombre AS institucion FROM usuario u JOIN equipo e JOIN institucion i WHERE u.idInstitucion=i.idInstitucion AND u.idUsuario=e.idUsuario AND e.aprobado = 1;");
                $query -> execute();

                $resultado = $query -> fetchAll(PDO::FETCH_OBJ);

                foreach($resultado as $fila) {
                    $obj = new exportar();
                    $obj->nombreEquipo = $fila->equipo;
                    $obj->coach = $fila->coach;
                    $obj->institucion = $fila->institucion;
                    $obj->estudiante1 = $fila->estudiante1;
                    $obj->estudiante2 = $fila->estudiante2;
                    $obj->estudiante3 = $fila->estudiante3;
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
?>