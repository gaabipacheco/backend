  create table users(
  	id int not null auto_increment,
    nome varchar(100),
    raca varchar(100),
    emaildono varchar(100),
    idade int,
    peso double,
    primary key(id),
    unique key `emaildono`(`emaildono`)
    )