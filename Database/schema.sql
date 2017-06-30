create table materia(
  id integer unsigned not null auto_increment,
  sigla varchar(10) unique,
  des varchar(128),
  primary key(id)
);
create table docente(
  id integer unsigned not null auto_increment,
  nombre varchar(256),
  primary key(id)
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
  materia_id integer unsigned not null,
  docente_id integer unsigned not null,
  cod varchar(128),
  fini datetime,
  fin datetime default null,
  estado boolean default 0,
  paralelo varchar(16),
  primary key(id),
  foreign key(materia_id)
  references materia(id)
  on delete cascade,
  foreign key(docente_id)
  references docente(id)
  on delete cascade
);
create table evaluacion(
  id integer unsigned not null auto_increment,
  lista_id integer unsigned not null,
  respuesta_id  integer unsigned not null,
  primary key(id),
  foreign key(respuesta_id)
  references respuesta(id)
  on delete cascade,
  foreign key(lista_id)
  references lista(id)
  on delete cascade
);
