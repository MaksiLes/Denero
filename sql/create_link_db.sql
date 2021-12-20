create database if not exists denero;

create table objects
(
    id int primary key not null auto_increment,
    name text not null ,
    status int not null

);
Create table users
(
    id int not null primary key auto_increment,
    login varchar(50) not null ,
    password varchar(50) not null ,
    object_id int not null ,
    foreign key (object_id) references objects(id)

);

insert into objects (name, status) value
    ( 'Альфа-банк', 1),
    ( 'Россельхозбанк', 3),
    ( 'Сбербанк', 5),
    ( 'Тинькофф-банк', 7),
    ( 'Альфа-банк', 2);

insert into users (login, password, object_id) value
    ( '123', '321', 2),
    ( '234', '432', 2),
    ( '345', '543', 5),
    ( '456', '654', 4),
    ( '567', '765', 2);

SELECT users.* FROM users
inner join objects on users.object_id = objects.id;

