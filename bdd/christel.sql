CREATE DATABASE commercial;
\c commercial

 create table company (
     id_company serial primary key ,
     nom varchar(255),
     date_creation date,
     logo varchar(45)
 );

create table employe (
    id_employe serial primary key ,
    id_poste int references poste(id_poste),
    id_manager int references employe(id_employe),
    nom varchar(255),
    prenom varchar(255),
    adresse varchar(255),
    contact varchar(255)
);

create table proforma (
    id_proforma serial primary key ,
    id_fournisseur int references fournisseur(id_fournisseur),
    id_article int references article(id_article),
    pu double precision,
    ht double,
    tva double,
    remise double
);

create table departement (
    id_departement serial primary key ,
    nom varchar(255)
);