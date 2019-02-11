CREATE DATABASE Barberia;

USE Barberia;

CREATE TABLE CLIENTES(
    CEDULA INT PRIMARY KEY,
	PRIMER_NOMBRE VARCHAR(100) NOT NULL,
    SEGUNDO_NOMBRE VARCHAR(100) NOT NULL,
    PRIMER_APELLIDO VARCHAR(100) NOT NULL,
    SEGUNDO_APELLIDO  VARCHAR(100) NOT NULL,
    CORREOC VARCHAR(300) NOT NULL,
	TELEFONO INT NOT NULL,
	FECHANACIMIENTO DATE NOT NULL,
    CONTRASENNAC VARCHAR(100) NOT NULL
);

CREATE TABLE SERVICIO(
    ID_SERVICIO INT PRIMARY KEY, 
    PRECIO_SERVICIO DECIMAL (20,2) NOT NULL,
    DESCRIPCIONS VARCHAR(100),
	IMAGEN IMAGE,
	DURACION_SERVICIO DECIMAL (2, 2) NOT NULL,
	FOREIGN KEY (ID_CATEGORIASERVICIO) REFERENCES CATEGORIASERVICIO(ID_CATEGORIASERVICIO)
);



CREATE TABLE CATEGORIASERVICIO (
    ID_CATEGORIASERVICIO AUTO_INCREMENT INT PRIMARY KEY,
    NOMBRE_CATEGORIA VARCHAR (100) NOT NULL
);


CREATE TABLE PRODUCTO (
    ID_PRODUCTO INT AUTO_INCREMENT PRIMARY KEY,
    NOMBRE_PRODUCTO VARCHAR(100) NOT NULL,
    CANTIDAD INT NOT NULL,
	PRECIO_VENTA DECIMAL (20,2) NOT NULL,
	PRECIO_COSTO DECIMAL (20,2) NOT NULL,
	DESCRIPCIONP VARCHAR(100),
	IMAGENP IMAGE
);


CREATE TABLE INVENTARIOGANANCIA(
    ID_PRODUCTO INT PRIMARY KEY,
    PRECIOVENTA VARCHAR(50) NOT NULL,
    CANTIDAD_PRODUCTO INT NOT NULL,
	TOTAL_GANANCIA AS (PRECIOVENTA * CANTIDAD_PRODUCTO),
	FOREIGN KEY(ID_PRODUCTO) REFERENCES PRODUCTO(ID_PRODUCTO) 
);

CREATE TABLE INVENTARIOVENTA(
    ID_PRODUCTO INT PRIMARY KEY,
    PRECIOCOSTO VARCHAR(50) NOT NULL,
    CANTIDAD_PRODUCTO INT NOT NULL,
	TOTAL_COSTO AS (PRECIOCOSTO * CANTIDAD_PRODUCTO),
	FOREIGN KEY(ID_PRODUCTO) REFERENCES PRODUCTO(ID_PRODUCTO) 
);

CREATE TABLE ADMINISTRADOR(
    ID_ADMINISTRADOR INT AUTO_INCREMENT PRIMARY KEY,
    NOMBRE_ADMINISTRADOR VARCHAR(100) NOT NULL,
    CONTRASENNAA VARCHAR(100) NOT NULL,
	EMAILA VARCHAR(100) NOT NULL
);
