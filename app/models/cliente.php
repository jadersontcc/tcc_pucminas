<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Cliente extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT c.*, p.data FROM cliente c
                                    INNER JOIN (
                                        SELECT p.idcliente, MIN(p.data) as data
                                        FROM pagamento p 
                                        WHERE p.pago != '1'
                                        GROUP BY p.idCliente)
                                    p ON p.idcliente = c.id");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getInadiplentes () {
        $hoje = date("Y-m-d");
        $stmt = $this->db->prepare("SELECT c.*, p.data FROM cliente c
                                    INNER JOIN (
                                        SELECT p.idcliente, MIN(p.data) as data
                                        FROM pagamento p 
                                        WHERE p.pago != '1'
                                        GROUP BY p.idCliente)
                                    p ON p.idcliente = c.id
                                    WHERE p.data < :hoje");
        
        $stmt->bindParam("hoje", $hoje);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($cliente) {
        $stmt = $this->db->prepare("SELECT * FROM cliente WHERE id = :id");
        $stmt->bindParam("id", $cliente["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function isInadimplente ($cliente) {
        $stmt = $this->db->prepare("SELECT * FROM pagamento WHERE idcliente = :idcliente");
        $stmt->bindParam("idcliente", $cliente["id"]);
        $stmt->execute();
        $pagamento = $stmt->fetch();
    }

    function create ($cliente) {
        $stmt = $this->db->prepare("INSERT INTO cliente (nome, rg, cpf, endereco,
                                                         cidade, uf, cep)
                                    VALUES (:nome, :rg, :cpf, :endereco,
                                            :cidade, :uf, :cep)");
        $stmt->bindParam("nome", $cliente["nome"]);
        $stmt->bindParam("rg", $cliente["rg"]);
        $stmt->bindParam("cpf", $cliente["cpf"]);
        $stmt->bindParam("endereco", $cliente["endereco"]);
        $stmt->bindParam("cidade", $cliente["cidade"]);
        $stmt->bindParam("uf", $cliente["uf"]);
        $stmt->bindParam("cep", $cliente["cep"]);
        return $stmt->execute() ? $this->db->lastInsertId() : false;
    }

    function update ($cliente) {
        $stmt = $this->db->prepare("UPDATE cliente
                                    SET nome = :nome, cpf = :cpf, rg = :rg,
                                        endereco = :endereco, cidade = :cidade,
                                        uf = :uf, cep = :cep
                                    WHERE id = :id");
        $stmt->bindParam("id", $cliente["id"]);
        $stmt->bindParam("nome", $cliente["nome"]);
        $stmt->bindParam("rg", $cliente["rg"]);
        $stmt->bindParam("cpf", $cliente["cpf"]);
        $stmt->bindParam("endereco", $cliente["endereco"]);
        $stmt->bindParam("cidade", $cliente["cidade"]);
        $stmt->bindParam("uf", $cliente["uf"]);
        $stmt->bindParam("cep", $cliente["cep"]);
        return $stmt->execute();
    }

    function delete ($cliente) {
        $stmt = $this->db->prepare("DELETE FROM cliente WHERE id = :id");
        $stmt->bindParam("id", $cliente["id"]);
        return $stmt->execute();
    }

}

?>