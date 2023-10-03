<?php
// Incluir la clase de conexión a la base de datos
require_once 'clase_conexion.php';

// Clase para autenticar usuarios
class Auth
{
    // Atributo para la conexión a la base de datos (instancia de la clase Conexion)
    // protected: solo se puede acceder desde la misma clase y desde las clases que heredan de ella
    protected PDO $conexion;

    public function __construct(Conexion $conexion) // __construct: se ejecuta al instanciar la clase y recibe como parámetro una instancia de la clase Conexion
    {
        $this->conexion = $conexion->conectar(); // conectar(): función de la clase Conexion
    }

    // Función para registrar un usuario
    public function registrar_usuario($nombre, $apellido, $correo, $clave, $tipo_doc_identidad, $doc_identidad, $fecha_nacimiento): bool // bool: retorna un valor booleano
    {
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT); // password_hash(): encripta la contraseña
        $tipo_usuario = 'Usuario'; // Tipo de usuario por defecto

        // Insertar datos en la tabla usuarios
        $sql = 'INSERT INTO usuarios (Nombre, Apellido, Correo, Clave, Tipo_Doc_Identidad, Doc_Identidad, Tipo_Usuario, Fecha_Nacimiento) 
                VALUES (:nombre, :apellido, :correo, :clave_encriptada, :tipo_doc_identidad, :doc_identidad, :tipo_usuario, :Fecha_Nacimiento)';

        // Preparar la consulta SQL
        $stmt = $this->conexion->prepare($sql);

        // Vincular parámetros
        // bindParam: vincula un parámetro con una variable de la clase PDOStatement (más información en https://www.php.net/manual/es/pdostatement.bindparam.php)
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':clave_encriptada', $clave_encriptada, PDO::PARAM_STR);
        $stmt->bindValue(':tipo_doc_identidad', $tipo_doc_identidad);
        $stmt->bindParam(':doc_identidad', $doc_identidad, PDO::PARAM_INT);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':Fecha_Nacimiento', $fecha_nacimiento, PDO::PARAM_STR);

        // Ejecutar la consulta SQL
        $stmt->execute();

        // Si la consulta se ejecuta correctamente se retorna true, de lo contrario false
        if ($stmt->execute()) {
            echo 'El usuario ha sido registrado correctamente.';
            return true;
        } else {
            echo 'Error al registrar el usuario.';
            return false;
        }
    }

    // Función para registrar un administrador
    public function registrar_administrador($usuario, $clave, $correo, $tipo_usuario): bool // bool: retorna un valor booleano
    {
        // Encriptar la contraseña
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT); // password_hash(): encripta la contraseña

        // Insertar datos en la tabla administradores
        $sql = 'INSERT INTO administradores (Usuario, Clave, Correo, Tipo_Usuario) 
                VALUES (:usuario, :clave, :correo, :tipo_usuario)';

        // Preparar la consulta SQL
        $stmt = $this->conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':clave', $clave_encriptada, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindValue(':tipo_usuario', $tipo_usuario, PDO::PARAM_STR);

        // Ejecutar la consulta SQL
        $stmt->execute();

        // Si la consulta se ejecuta correctamente se retorna true, de lo contrario false
        if ($stmt->execute()) {
            echo 'El usuario ha sido registrado correctamente.';
            return true;
        } else {
            echo 'Error al registrar el usuario.';
            return false;
        }
    }

    // Función para registrar un soporte
    public function registrar_soporte($usuario, $clave, $correo, $tipo_usuario): bool // bool: retorna un valor booleano
    {
        // Encriptar la contraseña
        $clave_encriptada = password_hash($clave, PASSWORD_DEFAULT); // password_hash(): encripta la contraseña

        // Insertar datos en la tabla soporte
        $sql = 'INSERT INTO soporte (Usuario, Clave, Correo, Tipo_Usuario) 
                VALUES (:usuario, :clave, :correo, :tipo_usuario)';

        // Preparar la consulta SQL
        $stmt = $this->conexion->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':clave', $clave_encriptada, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindValue(':tipo_usuario', $tipo_usuario, PDO::PARAM_STR);

        // Ejecutar la consulta SQL
        $stmt->execute();

        // Si la consulta se ejecuta correctamente se retorna true, de lo contrario false
        if ($stmt->execute()) {
            echo 'El usuario ha sido registrado correctamente.';
            return true;
        } else {
            echo 'Error al registrar el usuario.';
            return false;
        }
    }

    // Función determinar si es un administrador
    public function es_administrador($correo): bool // bool: retorna un valor booleano
    {
        $sql = "SELECT COUNT(*) FROM administradores WHERE Correo = :correo"; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR); // Vincular parámetros
        $stmt->execute(); // Ejecutar la consulta SQL
        $count = $stmt->fetchColumn(); // fetchColumn(): devuelve una columna de la siguiente fila de un conjunto de resultados

        return $count > 0; // Si el número de filas es mayor a 0, retorna true, de lo contrario false
    }

    // Función determinar si es un soporte
    public function es_soporte($correo): bool // bool: retorna un valor booleano
    {
        $sql = 'SELECT COUNT(*) FROM soporte WHERE Correo = :correo'; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR); // Vincular parámetros
        $stmt->execute(); // Ejecutar la consulta SQL
        $count = $stmt->fetchColumn(); // fetchColumn(): devuelve una columna de la siguiente fila de un conjunto de resultados

        return $count > 0; // Si el número de filas es mayor a 0, retorna true, de lo contrario false
    }

    // Función para logear un administrador
    public function logear_administrador($correo, $clave): bool // bool: retorna un valor booleano
    {
        $sql = 'SELECT * FROM administradores WHERE Correo = :correo'; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR); // Vincular parámetros
        $stmt->execute(); // Ejecutar la consulta SQL
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch(): obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement
        $clave_encriptada = $result['Clave']; // Obtener la contraseña encriptada

        // Verificar si la contraseña coincide con el hash proporcionado (clave_encriptada)
        if (password_verify($clave, $clave_encriptada)) { // password_verify(): verifica que la contraseña coincida con el hash proporcionado
            // Iniciar sesión y actualizar último inicio de sesión
            $_SESSION['usuario_id'] = $result['ID_Administrador']; // ID del administrador
            $_SESSION['nombre'] = $result['Usuario']; // Nombre del administrador
            $_SESSION['correo'] = $result['Correo']; // Correo del administrador
            $_SESSION['tipo_usuario'] = $result['Tipo_Usuario']; // Tipo de usuario del administrador

            // Actualizar el último inicio de sesión del administrador
            $this->actualizar_ultimo_inicio_sesion_admin($result['ID_Administrador']);

            return true;
        } else {
            return false;
        }

    }

    // Función para logear al equipo de soporte
    public function logear_soporte($correo, $clave): bool // bool: retorna un valor booleano
    {
        $sql = 'SELECT * FROM soporte WHERE Correo = :correo'; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR); // Vincular parámetros
        $stmt->execute(); // Ejecutar la consulta SQL
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // fetch(): obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement
        $clave_encriptada = $result['Clave']; // Obtener la contraseña encriptada

        // Verificar si la contraseña coincide con el hash proporcionado (clave_encriptada)
        if (password_verify($clave, $clave_encriptada)) { // password_verify(): verifica que la contraseña coincida con el hash proporcionado
            // Iniciar sesión y actualizar último inicio de sesión
            $_SESSION['usuario_id'] = $result['ID_Soporte']; // ID del soporte
            $_SESSION['nombre'] = $result['Usuario']; // Nombre del soporte
            $_SESSION['correo'] = $result['Correo']; // Correo del soporte
            $_SESSION['tipo_usuario'] = $result['Tipo_Usuario']; // Tipo de usuario del soporte

            // Actualizar el último inicio de sesión del soporte
            $this->actualizar_ultimo_inicio_sesion_admin($result['ID_Soporte']);

            return true;
        } else {
            return false;
        }

    }

    // Función para logear un usuario
    public function logear_usuario($correo, $clave): bool // bool: retorna un valor booleano
    {
        $sql = "SELECT * FROM usuarios WHERE Correo = :correo"; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR); // Vincular parámetros
        $stmt->execute(); // Ejecutar la consulta SQL
        $fila = $stmt->fetch(PDO::FETCH_ASSOC); // fetch(): obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement
        $clave_encriptada = $fila['Clave']; // Obtener la contraseña encriptada

        // Verificar si la contraseña coincide con el hash proporcionado (clave_encriptada)
        if (password_verify($clave, $clave_encriptada)) { // password_verify(): verifica que la contraseña coincida con el hash proporcionado
            $_SESSION['usuario_id'] = $fila['ID_Usuario']; // ID del usuario
            $_SESSION['nombre'] = $fila['Nombre']; // Nombre del usuario
            $_SESSION['apellido'] = $fila['Apellido']; // Apellido del usuario
            $_SESSION['correo'] = $fila['Correo']; // Correo del usuario
            $_SESSION['tipo_doc_identidad'] = $fila['Tipo_Doc_Identidad']; // Tipo de documento de identidad del usuario
            $_SESSION['doc_identidad'] = $fila['Doc_Identidad']; // Documento de identidad del usuario
            $_SESSION['fecha_nacimiento'] = $fila['Fecha_Nacimiento']; // Fecha de nacimiento del usuario
            $_SESSION['tipo_usuario'] = $fila['Tipo_Usuario']; // Tipo de usuario del usuario

            // Actualizar el último inicio de sesión del usuario
            $this->actualizar_registro_de_sesion($fila['ID_Usuario']); // ID del usuario

            return true;
        } else {
            return false;
        }
    }

    // Función para actualizar el último inicio de sesión de un usuario
    // private: solo se puede acceder desde la misma clase y desde las clases que heredan de ella
    private function actualizar_registro_de_sesion($id_usuario): void // void: no retorna ningún valor
    {
        // Obtener el registro de actividad del usuario
        $sql = "SELECT * FROM actividad WHERE ID_Usuario = ?"; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL

        // Verificar si el usuario tiene un registro de actividad
        if ($stmt->rowCount() == 0) { // rowCount(): devuelve el número de filas afectadas por la última sentencia SQL ejecutada
            // Insertar nuevo registro de actividad si no existe uno
            $sql = "INSERT INTO actividad (ID_Usuario, Inicio_sesion_actual, Descripcion) VALUES (?, DATE_SUB(NOW(), INTERVAL 5 HOUR), 'Registro de sesión')"; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
        } elseif ($stmt->rowCount() == 1) { // Si el usuario tiene un registro de actividad
            // Actualizar el último inicio de sesión tomando el valor de inicio de sesión actual
            $sql = "UPDATE actividad SET Ultimo_inicio_sesion = Inicio_sesion_actual WHERE ID_Usuario = ?"; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
            // Actualizar el inicio de sesión actual y la descripción
            $sql = "UPDATE actividad SET Inicio_sesion_actual = DATE_SUB(NOW(), INTERVAL 5 HOUR), Descripcion = 'Registro de sesión' WHERE ID_Usuario = ?";
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
        }
    }

    // Función para actualizar el último inicio de sesión de un administrador
    // private: solo se puede acceder desde la misma clase y desde las clases que heredan de ella
    private function actualizar_ultimo_inicio_sesion_admin($id_usuario): void // void: no retorna ningún valor
    {

        // Obtener el registro de actividad del usuario administrador
        $sql = 'SELECT * FROM administradores WHERE ID_Administrador = ?'; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL

        // Verificar si el usuario tiene un registro de actividad
        if ($stmt->rowCount() == 0) { // rowCount(): devuelve el número de filas afectadas por la última sentencia SQL ejecutada
            // Insertar nuevo registro de actividad
            $sql = "INSERT INTO administradores (ID_Administrador, Inicio_sesion_actual) VALUES (?, DATE_SUB(NOW(), INTERVAL 5 HOUR))";
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
        } elseif ($stmt->rowCount() == 1) { // Si el usuario tiene un registro de actividad
            // Actualizar el último inicio de sesión tomando el valor de inicio de sesión actual
            $sql = 'UPDATE administradores SET Ultimo_inicio_sesion = Inicio_sesion_actual WHERE ID_Administrador = ?'; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
            // Actualizar el inicio de sesión actual y la descripción
            $sql = "UPDATE administradores SET Inicio_sesion_actual = DATE_SUB(NOW(), INTERVAL 5 HOUR) WHERE ID_Administrador = ?"; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
        }
    }

    // Función para actualizar el último inicio de sesión de un soporte
    // private: solo se puede acceder desde la misma clase y desde las clases que heredan de ella
    private function actualizar_ultimo_inicio_sesion_soporte($id_usuario): void // void: no retorna ningún valor
    {

        // Obtener el registro de actividad del usuario soporte
        $sql = 'SELECT * FROM soporte WHERE ID_Soporte = ?'; // Consulta SQL
        $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
        $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL

        // Verificar si el usuario tiene un registro de actividad
        if ($stmt->rowCount() == 0) { // rowCount(): devuelve el número de filas afectadas por la última sentencia SQL ejecutada
            // Insertar nuevo registro de actividad
            $sql = 'INSERT INTO soporte (ID_Soporte, Inicio_sesion_actual) VALUES (?, DATE_SUB(NOW(), INTERVAL 5 HOUR))'; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
        } elseif ($stmt->rowCount() == 1) { // Si el usuario tiene un registro de actividad
            // Actualizar el último inicio de sesión tomando el valor de inicio de sesión actual
            $sql = 'UPDATE soporte SET Ultimo_inicio_sesion = Inicio_sesion_actual WHERE ID_Soporte = ?'; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
            // Actualizar el inicio de sesión actual
            $sql = 'UPDATE soporte SET Inicio_sesion_actual = DATE_SUB(NOW(), INTERVAL 5 HOUR) WHERE ID_Soporte = ?'; // Consulta SQL
            $stmt = $this->conexion->prepare($sql); // Preparar la consulta SQL
            $stmt->execute([$id_usuario]); // Ejecutar la consulta SQL
        }
    }
}