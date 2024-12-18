<?php
namespace projtecweb\myapi\Validaciones;

use projtecweb\myapi\DataBase;

class Validaciones extends DataBase {

    public function Login($jsonOBJ) {
        try {
            $username = $jsonOBJ->username ?? null;
            $password = $jsonOBJ->password ?? null;

            if (!$username || !$password) {
                throw new \Exception('Faltan datos de inicio de sesión');
            }

            $query = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($this->conexion, $query);
            if (!$stmt) {
                throw new \Exception('Error en la consulta: ' . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if ($user && password_verify($password, $user['password'])) {
                return json_encode(['success' => 'Inicio de sesión exitoso', 'user_id' => $user['id']], JSON_PRETTY_PRINT);
            } else {
                throw new \Exception('Credenciales incorrectas');
            }
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
        }
    }

    public function Signin($jsonOBJ) {
        try {
            $username = $jsonOBJ->username ?? null;
            $password = $jsonOBJ->password ?? null;
            $ubicacion = $jsonOBJ->ubicacion ?? null;

            if (!$username || !$password || !$ubicacion) {
                throw new \Exception('Faltan datos para registrarse');
            }

            $checkQuery = "SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_prepare($this->conexion, $checkQuery);
            if (!$stmt) {
                throw new \Exception('Error en la consulta: ' . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                throw new \Exception('El usuario ya existe');
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO users (username, password, ubicacion) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($this->conexion, $insertQuery);
            if (!$stmt) {
                throw new \Exception('Error en la consulta: ' . mysqli_error($this->conexion));
            }
            mysqli_stmt_bind_param($stmt, 'sss', $username, $hashedPassword, $ubicacion);

            if (mysqli_stmt_execute($stmt)) {
                return json_encode(['success' => 'Usuario registrado exitosamente'], JSON_PRETTY_PRINT);
            } else {
                throw new \Exception('Error al registrar usuario: ' . mysqli_stmt_error($stmt));
            }
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()], JSON_PRETTY_PRINT);
        }
    }

    public function registerCafeteria($username, $password, $ubicacion) {
        if (empty($username) || empty($password) || empty($ubicacion)) {
            return "Todos los campos son obligatorios.";
        }

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_fetch_assoc($result)) {
            return "El nombre de usuario ya está registrado.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, ubicacion) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $hashedPassword, $ubicacion);
        mysqli_stmt_execute($stmt);

        return "Registro exitoso.";
    }

    public function loginCafeteria($username, $password) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            return "Login exitoso. ID del usuario: " . $user['id'];
        }

        return "Usuario o contraseña incorrectos.";
    }

    public function exitencias(){
        $datosCategoria = ["Bebida", "Dulceria", "Postres", "Comida Preparada", "Snacks", "Productos Frescos", "Congelados", "Lacteos", "Saludable", "Otros"];
        $sql ="SELECT SUM(cantidad) as Bebida FROM productos WHERE categoria = ?;";
        $stmt = mysqli_prepare($this->conexion, $sql);
        $pre=[];
        $cantidad= [];
        for($i = 0; $i<10; $i++){
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt,'s', $datosCategoria[$i]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $pre[] = mysqli_fetch_assoc($result);
            $cantidad[]=$pre[$i]["Bebida"];
        }
        
        $cantidad[] = 0;
        $respuesta = [
            "categoria" => $datosCategoria,
            "datos" => $cantidad,
        ];
        return $respuesta;
    }
}
?>


