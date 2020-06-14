DROP DATABASE academia;
CREATE DATABASE IF NOT EXISTS academia;
USE academia;

CREATE TABLE usuario(
    id INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(32) UNIQUE NOT NULL,
    senha VARCHAR(32) NOT NULL,
    nome VARCHAR(128) NOT NULL,
    cpf BIGINT UNIQUE NOT NULL,
    rg BIGINT UNIQUE NOT NULL,
    tipo CHAR(1) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE cliente(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL,
    rg BIGINT UNIQUE NOT NULL,
    cpf BIGINT UNIQUE NOT NULL,
    endereco VARCHAR(128),
    cidade VARCHAR(40),
    uf CHAR(2),
    cep INT,
    PRIMARY KEY(id)
);
ALTER TABLE cliente AUTO_INCREMENT = 100000;

CREATE TABLE periodoFerias(
    id INT NOT NULL AUTO_INCREMENT,
    dias INT NOT NULL,
    dataInicio DATE NOT NULL,
    dataFim DATE NOT NULL,
    idCliente INT NOT NULL,
    FOREIGN KEY(idCliente) REFERENCES cliente(id),
    PRIMARY KEY(id)
);

CREATE TABLE instrutor(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL,
    rg BIGINT UNIQUE NOT NULL,
    cpf BIGINT UNIQUE NOT NULL,
    tipoAtividade CHAR(1) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE pagamento(
    id INT NOT NULL AUTO_INCREMENT,
    data DATE NULL,
    tipo CHAR(1) NOT NULL,
    idCliente INT NOT NULL,
    pago CHAR(1) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idCliente) REFERENCES cliente(id) ON DELETE CASCADE
);

CREATE TABLE aula(
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL,
    horaInicio TIME NOT NULL,
    horaFim TIME NOT NULL,
    dias VARCHAR(8) NOT NULL,
    sala VARCHAR(64) NOT NULL,
    idInstrutor INT NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(idInstrutor) REFERENCES instrutor(id) ON DELETE CASCADE
);

CREATE TABLE presenca(
    idCliente INT NOT NULL,
    idAula INT NOT NULL,
    data DATE NOT NULL,
    FOREIGN KEY(idCliente) REFERENCES cliente(id) ON DELETE CASCADE,
    FOREIGN KEY(idAula) REFERENCES aula(id) ON DELETE CASCADE,
    PRIMARY KEY(idCliente, idAula, data)
);

CREATE TABLE avaliacao(
    id INT NOT NULL AUTO_INCREMENT,
    idUsuario INT NOT NULL,
    idCliente INT NOT NULL,
    data DATE NOT NULL,
    idade INT NOT NULL,
    sexo CHAR(1) NOT NULL,
    peso FLOAT NOT NULL,
    altura FLOAT NOT NULL,
    fumante CHAR(1) NOT NULL,
    diabetico CHAR(1) NOT NULL,
    problemaCardiaco CHAR(1) NOT NULL,
    lesaoOrtopedica CHAR(1) NOT NULL,
    triceps FLOAT NOT NULL,
    suprailiaca FLOAT NOT NULL,
    abdominal FLOAT NOT NULL,
    coxa FLOAT NOT NULL,
    subescapular FLOAT NOT NULL,
    gordura FLOAT NOT NULL,
    nomeArquivo VARCHAR(255) NOT NULL,
    caminhoArquivo VARCHAR(511) NOT NULL,
    tamanhoArquivo INT NOT NULL,
    mime VARCHAR(50) NOT NULL DEFAULT 'text/plain',
    FOREIGN KEY(idUsuario) REFERENCES usuario(id),
    FOREIGN KEY(idCliente) REFERENCES cliente(id),
    PRIMARY KEY(id)
);

INSERT INTO usuario (login, senha, nome, rg, cpf, tipo) VALUES ("arnaldo", "123", "Arnaldo A.", 29450993, 02546569279, "G");
INSERT INTO usuario (login, senha, nome, rg, cpf, tipo) VALUES ("bianca", "456", "Bianca B.", 29450994, 02546569275, "R");
INSERT INTO usuario (login, senha, nome, rg, cpf, tipo) VALUES ("carlos", "789", "Carlos C.", 29450995, 02546569278, "F");

