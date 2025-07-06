CREATE DATABASE projeteBarbearia; 
USE projeteBarbearia;

CREATE TABLE usuarios (
    idUsuario int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    tipoUsuario varchar(15) NOT NULL,
    fotoUsuario varchar(100) NOT NULL,
    nomeUsuario varchar(50) NOT NULL,
    dataNascimentoUsuario date NOT NULL,
    cidadeUsuario varchar(30) NOT NULL,
    telefoneUsuario varchar (20) NOT NULL,
    emailUsuario varchar (50) NOT NULL,
    senhaUsuario varchar(100) 
);


CREATE TABLE servicos (
    idServico int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    fotoServico varchar (100) NOT NULL,
    nomeServico varchar (30) NOT NULL,
    descricaoServico varchar (200) NOT NULL,
    valorServico decimal (10,0) NOT NULL,
    statusServico varchar (10) NOT NULL
);

CREATE TABLE barbeiros (
    idBarbeiro int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    nomeBarbeiro varchar (50) NOT NULL,
    especialidadeBarbeiro varchar (50) NOT NULL,
    dataDisponivelBarbeiro date 
);

CREATE TABLE agenda (
    idAgendamento int (11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    idBarbeiro int (11) NOT NULL,
    idServico int (11) NOT NULL,
    idUsuario int (11) NOT NULL,
    dataAgendamento date NOT NULL,
    horaAgendamento time NOT NULL, 
    valorTotal decimal (5,2) NOT NULL,
    statusAgenda varchar (25), 
    FOREIGN KEY (idBarbeiro) REFERENCES barbeiros(idBarbeiro),
    FOREIGN KEY (idServico) REFERENCES servicos(idServico),
    FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);