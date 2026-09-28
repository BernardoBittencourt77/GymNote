<?php

require_once "../dao/UsuarioDAO.php";

class UsuarioController
{
    private $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
    }

    public function cadastrar($nome, $email, $senha)
    {
        $usuario = new Usuario(
            null,
            $nome,
            $email,
            $senha
        );

        return $this->usuarioDAO->cadastrar($usuario);
    }

    public function login($email, $senha)
    {
        $usuario = $this->usuarioDAO->buscarPorEmail($email);

        if ($usuario != null && $usuario->getSenha() === $senha) {
            return $usuario;
        }

        return null;
    }
}