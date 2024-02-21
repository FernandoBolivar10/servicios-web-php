<?php

class TareasDB
{
    protected $mysqli;
    
    const LOCALHOST = 'localhost';
    const USER      = 'root';
    const PASSWORD  = '';
    const DATABASE  = 'agenda';
    
    /*
     *  Constructor de clase inicializada la variable mysqli
     */
    public function __construct()
    {
        try{
            $this->mysqli = new mysqli(self::LOCALHOST, self::USER, self::PASSWORD, self::DATABASE);
        }catch(mysqli_sql_exception $e){
            http_response_code(500);
            exit;
        }
    }
    /*
     * Funcion que retorna un registro por medio de una id
     */
    public function getOneById($id = 0)
    {
        // Se prepara la consulta con prepare por medio de la conexion que tenemos
        $sql = '
            SELECT
                *
            FROM
                tareas
            WHERE
                id = ?
        ';
        
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $tarea  = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        
        return $tarea;
    }
    /*
     * Esta funcion retorna una lista
     */
    public function getList()
    {
        $sql = '
            SELECT
                *
            FROM
                tareas
        ';
        
        $result = $this->mysqli->query($sql);
        // Aqui se ejecuta la consulta
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        $result->close();
        
        return $tareas;
    }
    /*
     * Eesta funcion guarda un registro
     */
    public function create($titulo, $descripcion, $prioridad)
    {
        $sql = '
            INSERT INTO
                tareas(titulo, descripcion, prioridad)
            VALUES(?, ?, ?)
        ';
        
        $stmt   = $this->mysqli->prepare($sql);
        $stmt->bind_param('ssi', $titulo, $descripcion, $prioridad);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
    /*
     * Esta funciin elimina un registro
     */
    public function delete($id=0)
    {
        $sql = '
            DELETE FROM
                tareas
            WHERE
                id = ?
        ';
        
        $stmt   = $this->mysqli->prepare($sql);
        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        
        return $result;
    }
    /*
     * Esta funciin actualiza un registro
     */
    public function update($id, $titulo, $descripcion, $prioridad)
    {
        if($this->verifyExistById($id)){
            $sql = '
                UPDATE
                    tareas
                SET
                    titulo = ?,
                    descripcion = ?,
                    prioridad = ?
                WHERE
                    id = ?
            ';
            
            $stmt   = $this->mysqli->prepare($sql);
            $stmt->bind_param('ssii', $titulo, $descripcion, $prioridad, $id);
            $result = $stmt->execute();
            $stmt->close();
            
            return $result;
        }
        return false;
    }
    /*
     * Esta funcion verifica que exista un registro por id
     */
    public function verifyExistById($id)
    {
        $sql = '
            SELECT
                *
            FROM
                tareas
            WHERE
                id = ?
        ';
        
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if($stmt->execute()){
            $stmt->store_result();
            if ($stmt->num_rows == 1){
                return true;
            }
        }
        return false;
    }
}

?>