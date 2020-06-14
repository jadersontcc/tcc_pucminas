<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Pagamento extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT * FROM pagamento");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($pagamento) {
        $stmt = $this->db->prepare("SELECT * FROM pagamento WHERE id = :id");
        $stmt->bindParam("id", $pagamento["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getByIdCliente ($pagamento) {
        $stmt = $this->db->prepare("SELECT * FROM pagamento WHERE idCliente = :idCliente
                                    ORDER BY data ASC");
        $stmt->bindParam("idCliente", $pagamento["idCliente"]);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getLastByIdCliente ($pagamento) {
        $stmt = $this->db->prepare("SELECT p.* FROM cliente c
        INNER JOIN (
            SELECT p.idCliente, MIN(p.data) as data
            FROM pagamento p 
            WHERE p.pago != '1'
            GROUP BY p.idCliente)
        p ON p.idCliente = c.id
        WHERE p.idCliente = :idCliente");
        $stmt->bindParam("idCliente", $pagamento["idCliente"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function getAfterByDate ($pagamento) {
        $stmt = $this->db->prepare("SELECT p.* FROM pagamento p
                                    WHERE idCliente = :idCliente
                                    AND data >= :data");
        $pagamento["data"] = date('Y-m-d', strtotime($pagamento["data"]));
        $stmt->bindParam("idCliente", $pagamento["idCliente"]);
        $stmt->bindParam("data", $pagamento["data"]);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function create ($pagamento) {
        $stmt = $this->db->prepare("INSERT INTO pagamento (data, pago, tipo, idCliente)
                                    VALUES (:data, :pago, :tipo, :idCliente)");

        $pagamento["data"] = date('Y-m-d', strtotime($pagamento["data"]));
        $stmt->bindParam("data", $pagamento["data"]);
        $stmt->bindParam("tipo", $pagamento["tipo"]);
        $stmt->bindParam("pago", $pagamento["pago"]);
        $stmt->bindParam("idCliente", $pagamento["idCliente"]);
        return $stmt->execute() ? $this->db->lastInsertId() : false;
    }

    function update ($pagamento) {
        $stmt = $this->db->prepare("UPDATE pagamento
                                    SET pago = :pago
                                    WHERE id = :id");
        $stmt->bindParam("id", $pagamento["id"]);
        $stmt->bindParam("pago", $pagamento["pago"]);

        return $stmt->execute();
    }

    function delete ($pagamento) {
        $stmt = $this->db->prepare("DELETE FROM pagamento WHERE id = :id");
        $stmt->bindParam("id", $pagamento["id"]);
        return $stmt->execute();
    }

}

?>