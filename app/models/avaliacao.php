<?php

/*
 * Every class derriving from Model has access to $this->db
 * $this->db is a PDO object
 * Has a config in /core/config/database.php
 */
class Avaliacao extends Model {

    function getAll () {
        $stmt = $this->db->prepare("SELECT a.*, c.nome FROM avaliacao a
                                    INNER JOIN cliente c ON c.id = a.idCliente");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getById ($avaliacao) {
        $stmt = $this->db->prepare("SELECT * FROM avaliacao WHERE id = :id");
        $stmt->bindParam("id", $avaliacao["id"]);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    function getByIdCliente ($avaliacao) {
        $stmt = $this->db->prepare("SELECT * FROM avaliacao WHERE idCliente = :idCliente");
        $stmt->bindParam("idCliente", $avaliacao["idCliente"]);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    function getLastByIdCliente ($avaliacao) {
        $stmt = $this->db->prepare("SELECT data FROM avaliacao 
                                    WHERE idCliente = :idCliente
                                    ORDER BY data DESC LIMIT 1");
        $stmt->bindParam("idCliente", $avaliacao["idCliente"]);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    function getByIdUsuario ($avaliacao) {
        $stmt = $this->db->prepare("SELECT * FROM avaliacao WHERE idUsuario = :idUsuario");
        $stmt->bindParam("idUsuario", $avaliacao["idUsuario"]);
        $stmt->execute();
        return $stmt->fetch();
    }

    function create ($avaliacao) {
        $stmt = $this->db->prepare("INSERT INTO avaliacao (idade, sexo, peso, altura, fumante, diabetico, problemaCardiaco,
                                                           lesaoOrtopedica, triceps, suprailiaca, abdominal, coxa,
                                                           subescapular, gordura,
                                                           caminhoArquivo, mime, nomeArquivo, tamanhoArquivo,
                                                           data, idCliente, idUsuario)
                                    VALUES (:idade, :sexo, :peso, :altura, :fumante, :diabetico, :problemaCardiaco,
                                            :lesaoOrtopedica, :triceps, :suprailiaca, :abdominal, :coxa,
                                            :subescapular, :gordura,
                                            :caminhoArquivo, :mime, :nomeArquivo, :tamanhoArquivo,
                                            :data, :idCliente, :idUsuario)");
        $avaliacao["data"] = date('Y-m-d', strtotime($avaliacao["data"]));
        $stmt->bindParam("idade", $avaliacao["idade"]);
        $stmt->bindParam("sexo", $avaliacao["sexo"]);
        $stmt->bindParam("peso", $avaliacao["peso"]);
        $stmt->bindParam("altura", $avaliacao["altura"]);
        $stmt->bindParam("fumante", $avaliacao["fumante"]);
        $stmt->bindParam("diabetico", $avaliacao["diabetico"]);
        $stmt->bindParam("problemaCardiaco", $avaliacao["problemaCardiaco"]);
        $stmt->bindParam("lesaoOrtopedica", $avaliacao["lesaoOrtopedica"]);
        $stmt->bindParam("triceps", $avaliacao["triceps"]);
        $stmt->bindParam("suprailiaca", $avaliacao["suprailiaca"]);
        $stmt->bindParam("abdominal", $avaliacao["abdominal"]);
        $stmt->bindParam("coxa", $avaliacao["coxa"]);
        $stmt->bindParam("subescapular", $avaliacao["subescapular"]);
        $stmt->bindParam("gordura", $avaliacao["gordura"]);
        $stmt->bindParam("caminhoArquivo", $avaliacao["caminhoArquivo"]);
        $stmt->bindParam("mime", $avaliacao["mime"]);
        $stmt->bindParam("nomeArquivo", $avaliacao["nomeArquivo"]);
        $stmt->bindParam("tamanhoArquivo", $avaliacao["tamanhoArquivo"]);
        $stmt->bindParam("data", $avaliacao["data"]);
        $stmt->bindParam("idCliente", $avaliacao["idCliente"]);
        $stmt->bindParam("idUsuario", $avaliacao["idUsuario"]);
        return $stmt->execute() ? $this->db->lastInsertId() : false;
    }

    function update ($avaliacao) {
        $stmt = $this->db->prepare("UPDATE avaliacao
                                    SET idade = :idade, sexo = :sexo, peso = :peso, altura = :altura,
                                        fumante = :fumante, diabetico = :diabetico, problemaCardiaco = :problemaCardiaco,
                                        lesaoOrtopedica = :lesaoOrtopedica, triceps = :triceps, suprailiaca = :suprailiaca,
                                        abdominal = :abdominal, coxa = :coxa, subescapular = :subescapular, gordura = :gordura,
                                        caminhoArquivo = :caminhoArquivo, mime = :mime, nomeArquivo = :nomeArquivo,
                                        tamanhoArquivo = :tamanhoArquivo, data = :data, 
                                        idCliente = :idCliente, idUsuario = :idUsuario
                                    WHERE id = :id");
        $avaliacao["data"] = date('Y-m-d', strtotime($avaliacao["data"]));
        $stmt->bindParam("id", $avaliacao["id"]);
        $stmt->bindParam("idade", $avaliacao["idade"]);
        $stmt->bindParam("sexo", $avaliacao["sexo"]);
        $stmt->bindParam("peso", $avaliacao["peso"]);
        $stmt->bindParam("altura", $avaliacao["altura"]);
        $stmt->bindParam("fumante", $avaliacao["fumante"]);
        $stmt->bindParam("diabetico", $avaliacao["diabetico"]);
        $stmt->bindParam("problemaCardiaco", $avaliacao["problemaCardiaco"]);
        $stmt->bindParam("lesaoOrtopedica", $avaliacao["lesaoOrtopedica"]);
        $stmt->bindParam("triceps", $avaliacao["triceps"]);
        $stmt->bindParam("suprailiaca", $avaliacao["suprailiaca"]);
        $stmt->bindParam("abdominal", $avaliacao["abdominal"]);
        $stmt->bindParam("coxa", $avaliacao["coxa"]);
        $stmt->bindParam("subescapular", $avaliacao["subescapular"]);
        $stmt->bindParam("gordura", $avaliacao["gordura"]);
        $stmt->bindParam("caminhoArquivo", $avaliacao["caminhoArquivo"]);
        $stmt->bindParam("mime", $avaliacao["mime"]);
        $stmt->bindParam("nomeArquivo", $avaliacao["nomeArquivo"]);
        $stmt->bindParam("tamanhoArquivo", $avaliacao["tamanhoArquivo"]);
        $stmt->bindParam("data", $avaliacao["data"]);
        $stmt->bindParam("idCliente", $avaliacao["idCliente"]);
        $stmt->bindParam("idUsuario", $avaliacao["idUsuario"]);
        return $stmt->execute();
    }

    function delete ($avaliacao) {
        $stmt = $this->db->prepare("DELETE FROM avaliacao WHERE id = :id");
        $stmt->bindParam("id", $avaliacao["id"]);
        return $stmt->execute();
    }

}

?>