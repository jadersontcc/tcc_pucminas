<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Instrutor extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT * FROM instrutor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($instrutor) {
        $stmt = $this->db->prepare("SELECT * FROM instrutor WHERE id = :id");
        $stmt->bindParam("id", $instrutor["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function create ($instrutor) {
        $stmt = $this->db->prepare("INSERT INTO instrutor (nome, rg, cpf, tipoAtividade)
                                    VALUES (:nome, :rg, :cpf, :tipoAtividade)");
        $stmt->bindParam("nome", $instrutor["nome"]);
        $stmt->bindParam("rg", $instrutor["rg"]);
        $stmt->bindParam("cpf", $instrutor["cpf"]);
        $stmt->bindParam("tipoAtividade", $instrutor["tipoAtividade"]);
        return $stmt->execute() ? $this->db->lastInsertId() : false;
    }

    function update ($instrutor) {
        $stmt = $this->db->prepare("UPDATE instrutor
                                    SET nome = :nome, rg = :rg, cpf = :cpf,
                                        tipoAtividade = :tipoAtividade
                                    WHERE id = :id");
        $stmt->bindParam("id", $instrutor["id"]);
        $stmt->bindParam("nome", $instrutor["nome"]);
        $stmt->bindParam("rg", $instrutor["rg"]);
        $stmt->bindParam("cpf", $instrutor["cpf"]);
        $stmt->bindParam("tipoAtividade", $instrutor["tipoAtividade"]);
        return $stmt->execute();
    }

    function delete ($instrutor) {
        $stmt = $this->db->prepare("DELETE FROM instrutor WHERE id = :id");
        $stmt->bindParam("id", $instrutor["id"]);
        return $stmt->execute();
    }

}

?>