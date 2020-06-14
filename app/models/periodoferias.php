<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class PeriodoFerias extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT * FROM periodoFerias");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($periodoFerias) {
        $stmt = $this->db->prepare("SELECT * FROM periodoFerias WHERE id = :id");
        $stmt->bindParam("id", $periodoFerias["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getByIdCliente ($periodoFerias) {
        $stmt = $this->db->prepare("SELECT * FROM periodoFerias WHERE idCliente = :idCliente ORDER BY dataInicio");
        $stmt->bindParam("idCliente", $periodoFerias["idCliente"]);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function checkIfDateRangeOverlaps ($periodoFerias) {
        $stmt = $this->db->prepare("SELECT count(*) as count 
                                    FROM periodoFerias 
                                    WHERE idCliente = :idCliente 
                                    AND ((:dataInicio >= dataInicio AND :dataInicio <= dataFim)
                                         OR (:dataFim >= dataInicio AND :dataFim <= dataFim))");
        $periodoFerias["dataInicio"] = date('Y-m-d', strtotime($periodoFerias["dataInicio"]));
        $periodoFerias["dataFim"] = date('Y-m-d', strtotime($periodoFerias["dataFim"]));
        $stmt->bindParam("dataInicio", $periodoFerias["dataInicio"]);
        $stmt->bindParam("dataFim", $periodoFerias["dataFim"]);
        $stmt->bindParam("idCliente", $periodoFerias["idCliente"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getDaysSumByIdCliente ($periodoFerias) {
        $stmt = $this->db->prepare("SELECT SUM(dias) as dias FROM periodoFerias WHERE idCliente = :idCliente");
        $stmt->bindParam("idCliente", $periodoFerias["idCliente"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function create ($periodoFerias) {
        $stmt = $this->db->prepare("INSERT INTO periodoFerias (dataInicio, dataFim, idCliente, dias)
                                    VALUES (:dataInicio, :dataFim, :idCliente, :dias)");
        $periodoFerias["dataInicio"] = date('Y-m-d', strtotime($periodoFerias["dataInicio"]));
        $periodoFerias["dataFim"] = date('Y-m-d', strtotime($periodoFerias["dataFim"]));
        $stmt->bindParam("dias", $periodoFerias["dias"]);
        $stmt->bindParam("dataInicio", $periodoFerias["dataInicio"]);
        $stmt->bindParam("dataFim", $periodoFerias["dataFim"]);
        $stmt->bindParam("idCliente", $periodoFerias["idCliente"]);
        return $stmt->execute() ? $this->db->lastInsertId() : false;
    }

    function update ($periodoFerias) {
        $stmt = $this->db->prepare("UPDATE periodoFerias
                                    SET dataInicio = :dataInicio, dataFim = :dataFim, idCliente = :idCliente,
                                        dias = :dias
                                    WHERE id = :id");
        $stmt->bindParam("id", $periodoFerias["id"]);
        $stmt->bindParam("dias", $periodoFerias["dias"]);
        $stmt->bindParam("dataInicio", $periodoFerias["dataInicio"]);
        $stmt->bindParam("dataFim", $periodoFerias["dataFim"]);
        $stmt->bindParam("idCliente", $periodoFerias["idCliente"]);
        return $stmt->execute();
    }

    function delete ($periodoFerias) {
        $stmt = $this->db->prepare("DELETE FROM periodoFerias WHERE id = :id");
        $stmt->bindParam("id", $periodoFerias["id"]);
        return $stmt->execute();
    }

}

?>