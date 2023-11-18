
CREATE USER commerce WITH PASSWORD 'systcom';
CREATE DATABASE commercial;
GRANT ALL PRIVILEGES ON DATABASE commercial TO commerce;

psql -U commerce -d commercial


psql -U commerce -d commercial
\c commercial

--------------
----tables----
--------------
create table company (
     id_company serial primary key ,
     nom varchar(255),
     date_creation date,
     logo varchar(45)
 );

 create table departement (
    id_departement serial primary key ,
    nom varchar(255)
);

CREATE TABLE poste (
    id_poste SERIAL PRIMARY KEY,
    intitule_poste VARCHAR(55),
    id_departement INTEGER REFERENCES departement(id_departement)
);

create table article(
    id_article serial primary key,
    nom varchar(100),
    type int
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


 create table utilisateur (
     id_utilisateur serial primary key ,
     id_employe int references employe(id_employe),
     pseudo varchar(255),
     mdp date
 );

create table fournisseur (
    id_fournisseur serial primary key,
    nom varchar(255),
    email varchar(255),
    contact varchar(255),
    adresse varchar(255)
);


create table besoin_achat(
    idbesoin_achat serial primary key,
    id_employe int references employe(id_employe),
    id_article int references article(id_article),
    id_departement int references departement(id_departement),
    quantite int,
    raison varchar(255),
    etat int,
    date_limite date,
    priorite int
);

CREATE TABLE condition_achat (
    id_condition_achat SERIAL PRIMARY KEY,
    payement DECIMAL(20,3),
    livraison DECIMAL(20,3),
    payement_livraison DECIMAL(20,3),
    payement_reste DECIMAL(20,3),
    id_fournisseur INTEGER REFERENCES fournisseur(id_fournisseur)
);

create table proforma (
    id_proforma serial primary key ,
    id_fournisseur int references fournisseur(id_fournisseur),
    id_article int references article(id_article),
    pu double precision,
    ht double precision,
    tva double precision,
    remise double precision
);

create table proforma_final(
    id_final serial primary key,
    id_proforma int references proforma(id_proforma),
    id_besoin_achat_final int references besoin_achat_final(id_besoin_achat_final)
);

CREATE TABLE bon_commande (
    id_bon_commande SERIAL PRIMARY KEY,
    date_emmission DATE,
    id_fournisseur INTEGER REFERENCES fournisseur(id_fournisseur)
);



--------------
----tables----
--------------

