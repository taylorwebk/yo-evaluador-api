create table materia(
  id integer unsigned not null auto_increment,
  sigla varchar(10) unique,
  des varchar(128),
  primary key(id)
);
create table estudiante(
  id integer unsigned not null auto_increment,
  nombre varchar(256),
  ci varchar(16),
  ru varchar(16),
  primary key(id)
);
create table docente(
  id integer unsigned not null auto_increment,
  nombre varchar(256),
  cod varchar(128),
  primary key(id)
);
create table clase(
  id integer unsigned not null auto_increment,
  docente_id integer unsigned,
  materia_id integer unsigned,
  par varchar(4),
  aula varchar(12),
  primary key(id),
  foreign key(docente_id)
  references docente(id)
  on delete cascade,
  foreign key(materia_id)
  references materia(id)
  on delete cascade
);
create table clase_estudiante(
  clase_id integer unsigned,
  estudiante_id integer unsigned,
  primary key(clase_id, estudiante_id),
  foreign key(clase_id)
  references clase(id)
  on delete cascade,
  foreign key(estudiante_id)
  references estudiante(id)
  on delete cascade
);
create table pregunta(
  id integer unsigned not null auto_increment,
  des varchar(256),
  primary key(id)
);
create table respuesta(
  id integer unsigned not null auto_increment,
  pregunta_id integer unsigned not null,
  des varchar(128),
  primary key(id),
  foreign key(pregunta_id)
  references pregunta(id)
  on delete cascade
);
create table lista(
  id integer unsigned not null auto_increment,
  clase_id integer unsigned not null,
  fini datetime,
  fin datetime default null,
  primary key(id),
  foreign key(clase_id)
  references clase(id)
  on delete cascade
);
create table evaluacion(
  id integer unsigned not null auto_increment,
  lista_id integer unsigned not null,
  respuesta_id  integer unsigned not null,
  estudiante_id integer unsigned,
  primary key(id),
  foreign key(respuesta_id)
  references respuesta(id)
  on delete cascade,
  foreign key(lista_id)
  references lista(id)
  on delete cascade,
  foreign key(estudiante_id)
  references estudiante(id)
  on delete cascade
);
