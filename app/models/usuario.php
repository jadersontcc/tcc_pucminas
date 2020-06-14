<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Usuario extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT * FROM usuario");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($usuario) {
        $stmt = $this->db->prepare("SELECT * FROM usuario WHERE id = :id");
        $stmt->bindParam("id", $usuario["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getByLoginAndTipo ($login, $tipo) {
        $stmt = $this->db->prepare("SELECT * FROM usuario 
                                    WHERE login = :login AND tipo = :tipo");
        $stmt->bindParam("login", $login);
        $stmt->bindParam("tipo", $tipo);
        $stmt->execute();
        return $stmt->fetch();
    }

    function create ($usuario) {
        $stmt = $this->db->prepare("INSERT INTO usuario (login, senha,nome, rg, cpf)
                                    VALUES (:login, :senha, :nome, :rg, :cpf)");
        $stmt->bindParam("login", $usuario["login"]);
        $stmt->bindParam("senha", $usuario["senha"]);
        $stmt->bindParam("nome", $usuario["nome"]);
        $stmt->bindParam("rg", $usuario["rg"]);
        $stmt->bindParam("cpf", $usuario["cpf"]);
        return $stmt->execute();
    }

    function update ($usuario) {
        $stmt = $this->db->prepare("UPDATE usuario
                                    SET login = :login, senha = :senha 
                                        nome = :nome, cpf = :cpf, rg = :rg
                                    WHERE id = :id");
        $stmt->bindParam("id", $id);
        $stmt->bindParam("login", $usuario["login"]);
        $stmt->bindParam("senha", $usuario["senha"]);
        $stmt->bindParam("nome", $usuario["nome"]);
        $stmt->bindParam("rg", $usuario["rg"]);
        $stmt->bindParam("cpf", $usuario["cpf"]);
        return $stmt->execute();
    }

    function delete ($usuario) {
        $stmt = $this->db->prepare("DELETE FROM usuario WHERE id = :id");
        $stmt->bindParam("id", $usuario["id"]);
        return $stmt->execute();
    }

}

?>