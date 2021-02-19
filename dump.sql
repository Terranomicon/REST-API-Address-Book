create table email
(
    user_id integer,
    type    text,
    email   text
);

alter table email
    owner to postgres;


create table phone_number
(
    user_id     integer,
    number_type text,
    number      text
);

alter table phone_number
    owner to postgres;


create table users
(
    full_name text,
    birthdate date,
    address   text,
    gender    text,
    id        integer generated always as identity
);

alter table users
    owner to postgres;

