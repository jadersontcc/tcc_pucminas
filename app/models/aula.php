<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Aula extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT a.*, i.nome as nomeInstrutor FROM aula a
                                    INNER JOIN instrutor i 
                                    WHERE i.id = a.idInstrutor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($aula) {
        $stmt = $this->db->prepare("SELECT * FROM aula WHERE id = :id");
        $stmt->bindParam("id", $aula["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getByDataAtual () {
        $diaDaSemana = date("w");
        $stmt = $this->db->prepare("SELECT a.*, i.nome as nomeInstrutor FROM aula a
                                    INNER JOIN instrutor i 
                                    WHERE i.id = a.idInstrutor 
                                    AND a.dias LIKE CONCAT('%', :diaDaSemana, '%')");
        $stmt->bindParam("diaDaSemana", $diaDaSemana);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function create ($aula) {
        $stmt = $this->db->prepare("INSERT INTO aula (nome, horaInicio, horaFim,
                                                      idInstrutor, dias, sala)
                                    VALUES (:nome, :horaInicio, :horaFim,
                                            :idInstrutor, :dias, :sala)");
        $stmt->bindParam("nome", $aula["nome"]);
        $stmt->bindParam("horaInicio", $aula["horaInicio"]);
        $stmt->bindParam("horaFim", $aula["horaFim"]);
        $stmt->bindParam("idInstrutor", $aula["idInstrutor"]);
        $stmt->bindParam("dias", $aula["dias"]);
        $stmt->bindParam("sala", $aula["sala"]);
        return $stmt->execute();
    }

    function update ($aula) {
        $stmt = $this->db->prepare("UPDATE aula
                                    SET nome = :nome, horaInicio = :horaInicio, horaFim = :horaFim,
                                        idInstrutor = :idInstrutor, dias = :dias, sala = :sala
                                    WHERE id = :id");
        $stmt->bindParam("id", $aula["id"]);
        $stmt->bindParam("nome", $aula["nome"]);
        $stmt->bindParam("horaInicio", $aula["horaInicio"]);
        $stmt->bindParam("horaFim", $aula["horaFim"]);
        $stmt->bindParam("idInstrutor", $aula["idInstrutor"]);
        $stmt->bindParam("dias", $aula["dias"]);
        $stmt->bindParam("sala", $aula["sala"]);
        return $stmt->execute();
    }

    function delete ($aula) {
        $stmt = $this->db->prepare("DELETE FROM aula WHERE id = :id");
        $stmt->bindParam("id", $aula["id"]);
        return $stmt->execute();
    }

}

?>