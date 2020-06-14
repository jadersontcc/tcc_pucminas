<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Presenca extends Model
{
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM presenca");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByIdCliente($cliente)
    {
        $stmt = $this->db->prepare("SELECT p.idcliente, p.idaula, p.data, a.nome as nomeAula,
                                           i.nome as nomeInstrutor
                                    FROM presenca p
                                    INNER JOIN cliente c on c.id = p.idcliente
                                    INNER JOIN aula a on a.id = p.idAula
                                    INNER JOIN instrutor i on i.id = a.idInstrutor
                                    WHERE c.id = :id");
        $stmt->bindParam("id", $cliente["id"]);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByIdAula($presenca)
    {
        $stmt = $this->db->prepare("SELECT * FROM presenca WHERE idAula = :idAula");
        $stmt->bindParam("idAula", $presenca["idAula"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function checkIfAlreadyPresent($presenca)
    {
        $stmt = $this->db->prepare("SELECT * FROM presenca 
                                    WHERE idAula = :idAula 
                                    AND idCliente = :idCliente 
                                    AND data = :data");
        $stmt->bindParam("idAula", $presenca["idAula"]);
        $stmt->bindParam("idCliente", $presenca["idCliente"]);
        $stmt->bindParam("data", $presenca["data"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($presenca)
    {
        $stmt = $this->db->prepare("INSERT INTO presenca (idCliente, idAula, data)
                                    VALUES (:idCliente, :idAula, :data)");
        $stmt->bindParam("idCliente", $presenca["idCliente"]);
        $stmt->bindParam("idAula", $presenca["idAula"]);
        $stmt->bindParam("data", $presenca["data"]);
        return $stmt->execute();
    }

    public function update($presenca)
    {
        $stmt = $this->db->prepare("UPDATE presenca
                                    SET idCliente = :idCliente, idAula = :idAula
                                    WHERE id = :id");
        $stmt->bindParam("idCliente", $idCliente);
        $stmt->bindParam("idAula", $presenca["idAula"]);
        return $stmt->execute();
    }

    public function deleteByIdCliente($presenca)
    {
        $stmt = $this->db->prepare("DELETE FROM presenca WHERE idCliente = :idCliente");
        $stmt->bindParam("idCliente", $presenca["idCliente"]);
        return $stmt->execute();
    }

    public function deleteByIdAula($presenca)
    {
        $stmt = $this->db->prepare("DELETE FROM presenca WHERE idAula = :idAula");
        $stmt->bindParam("idAula", $presenca["idAula"]);
        return $stmt->execute();
    }
}
