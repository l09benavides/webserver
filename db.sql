create table tbl_usuario (
id INT(10) AUTO_INCREMENT,
cedula VARCHAR(10),
nombre VARCHAR(50),
apellidos VARCHAR(50),
telefono VARCHAR(10),
email VARCHAR(50),
usuario VARCHAR(50),
password VARCHAR(15),
id_rol INT(10),
Primary key(id),
constraint unq_Ced_email Unique(cedula,email),
constraint fk_id_rol foreign key (id_rol) references tbl_roles(id)
);

create table tbl_roles (
id INT(10) AUTO_INCREMENT,
nombre VARCHAR(10),
descripcion VARCHAR(100),
Primary key(id),
);

create table tbl_articulo (
id INT(10) AUTO_INCREMENT,
codigo VARCHAR(10),
marca VARCHAR(45),
descripcion VARCHAR(100),
precio DOUBLE,
cantidad INT(10),
Primary key(id),
);

create table tbl_compra (
id INT(10) AUTO_INCREMENT,
id_usuario INT(10),	
num_factura INT(10),
fecha_compra DateTime,
Primary key(id),
constraint fk_id_usuario foreign key (id_usuario) references tbl_usuario(id),
);

create table tbl_compra_detalle (
id INT(10) AUTO_INCREMENT,
id_compra INT(10),	 
id_articulo INT(10),
cantidad INT(10),
Primary key(id),
constraint fk_id_usuario foreign key (id_compra) references tbl_compra(id),
constraint fx_id_articulo foreign key (id_articulo) references tbl_articulo(id)
);
