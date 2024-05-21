<?php
    require_once 'conexion.php';
    require_once 'modelos/concurso.php';


    class DAOConcurso {
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
                $query = $this -> conexion -> prepare("SELECT idConcurso, nombreConcurso, fechaInicio, fechaFin, ubicacion,status FROM concurso");
                $query -> execute();

                $resultado = $query -> fetchAll(PDO::FETCH_OBJ);

                foreach($resultado as $fila){
                    $obj = new concurso();
                    $obj->idConcurso = $fila->idConcurso;
                    $obj->nombreConcurso = $fila->nombreConcurso;
                    $obj->fechaInicio = $fila->fechaInicio;
                    $obj->fechaFin = $fila->fechaFin;
                    $obj->ubicacion = $fila->ubicacion;
                    $obj->status = $fila->status;
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
        public function obtenerTodosActivos() {
            try {
                $this -> conectar();
                $lista = array();
                $query = $this -> conexion -> prepare("SELECT idConcurso, nombreConcurso, fechaInicio, fechaFin, ubicacion,status FROM concurso where status=1");
                $query -> execute();

                $resultado = $query -> fetchAll(PDO::FETCH_OBJ);
                $obj = new concurso();
                $obj->idConcurso = $fila->idConcurso;
                $obj->nombreConcurso = $fila->nombreConcurso;
                $obj->fechaInicio = $fila->fechaInicio;
                $obj->fechaFin = $fila->fechaFin;
                $obj->ubicacion = $fila->ubicacion;
                $obj->status = $fila->status;
                return $obj;
            }
            catch(PDOException $e){
                return null;
            }finally{
                Conexion::desconectar();
            }
        }


        public function agregar(concurso $obj) {
            try {
                $sql = "UPDATE `concurso` SET `status` = '0' WHERE `concurso`.`idConcurso` > 0;
                INSERT INTO concurso(nombreConcurso, fechaInicio, fechaFin, ubicacion, status) 
                        VALUES (:nombreConcurso, :fechaInicio, :fechaFin, :ubicacion, :status);";
                $this->conectar();
                $this->conexion->prepare($sql)
                    ->execute(
                        array(
                            ':nombreConcurso'=>$obj->nombreConcurso,
                            ':fechaInicio'=>$obj->fechaInicio,
                            ':fechaFin'=>$obj->fechaFin,
                            ':ubicacion'=>$obj->ubicacion,
                            ':status'=>1
                        )
                    );
                return 1;
            } catch (Exception $e){
                return $e;
            }finally{
                Conexion::desconectar();
            }
        }

        public function activarDesactivarConcurso(concurso $obj) {
            try {
                $sql = "UPDATE `concurso` SET `status` = '0' WHERE `concurso`.`idConcurso` > 0;
                INSERT INTO concurso(nombreConcurso, fechaInicio, fechaFin, ubicacion, status) 
                        VALUES (:nombreConcurso, :fechaInicio, :fechaFin, :ubicacion, :status);";
                $this->conectar();
                $this->conexion->prepare($sql)
                    ->execute(
                        array(
                            ':nombreConcurso'=>$obj->nombreConcurso,
                            ':fechaInicio'=>$obj->fechaInicio,
                            ':fechaFin'=>$obj->fechaFin,
                            ':ubicacion'=>$obj->ubicacion,
                            ':status'=>1
                        )
                    );
                return 1;
            } catch (Exception $e){
                return $e;
            }finally{
                Conexion::desconectar();
            }
        }

        public function setConcursoActivo($id){
            try {
                $sql = "UPDATE concurso SET status = '0' WHERE idConcurso!=:id; 
                UPDATE concurso SET status = '1' WHERE idConcurso=:id;";
                $this->conectar();
                $this->conexion->prepare($sql)
                    ->execute(
                        array(
                            ':id'=>$id
                        )
                    );
                return 1;
            } catch (Exception $e){
                return $e;
            }finally{
                Conexion::desconectar();
            }
        }
        
        public function obtenerUno($id){
            try{
                $this->conectar();
                $obj = null;

                $query = $this->conexion->prepare("SELECT nombreConcurso, fechaInicio, fechaFin, ubicacion FROM concurso WHERE idConcurso = ?");
                $query->execute([$id]);

                $fila = $query->fetch(PDO::FETCH_OBJ);
                $obj = new concurso();
                $obj->idConcurso=$id;
                $obj->nombreConcurso = $fila->nombreConcurso;
                $obj->fechaInicio = $fila->fechaInicio;
                $obj->fechaFin = $fila->fechaFin;
                $obj->ubicacion = $fila->ubicacion;
                
                return $obj;
            }
            catch(Exception $e){
                return null;
            }
            finally {
                Conexion::desconectar();
            }
        }
        
        public function obtenerActivo(){
            try{
                $this->conectar();
                $obj = null;

                $query = $this->conexion->prepare("SELECT idConcurso,nombreConcurso FROM concurso WHERE status = 1");
                $query->execute();

                $fila = $query->fetch(PDO::FETCH_OBJ);
                $obj = new concurso();
                $obj->idConcurso=$fila->idConcurso;
                $obj->nombreConcurso = $fila->nombreConcurso;
                
                return $obj;
            }
            catch(Exception $e){
                return null;
            }
            finally {
                Conexion::desconectar();
            }
        }


        public function editar(concurso $obj){
            try {
                $sql = "UPDATE concurso
                        SET 
                        nombreConcurso = ?,
                        fechaInicio = ?,
                        fechaFin = ?,
                        ubicacion = ?
                        WHERE idConcurso = ?;";
                $this->conectar();

                $sentencia = $this->conexion->prepare($sql);
                $sentencia->execute(
                    array(
                        $obj->nombreConcurso,
                        $obj->fechaInicio,
                        $obj->fechaFin,
                        $obj->ubicacion,
                        $obj->idConcurso
                    )
                );
                return true;
            }
            catch (PDOException $e){
                return $e;
            }
            finally {
                Conexion::desconectar();
            }
        }

    }
?>