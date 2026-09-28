<?php

require_once "../config/Database.php";
require_once "../models/Usuario.php";

class UsuarioDAO
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function cadastrar(Usuario $usuario)
    {
        $sql = "INSERT INTO usuarios (nome, email, senha)
                VALUES (:nome, :email, :senha)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":nome", $usuario->getNome());
        $stmt->bindValue(":email", $usuario->getEmail());
        $stmt->bindValue(":senha", $usuario->getSenha());

        return $stmt->execute();
    }

    public function buscarPorEmail($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            return new Usuario(
                $dados["id"],
                $dados["nome"],
                $dados["email"],
                $dados["senha"]
            );
        }

        return null;
    }
}