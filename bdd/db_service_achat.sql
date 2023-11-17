CREATE DATABASE commercial;
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

create table article(
    id_article serial primary key,
    nom varchar(100),
    type int
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

create table proforma_final(
    id_final serial primary key,
    id_proforma int references proforma(id_proforma),
    id_besoin_achat_final int references besoin_achat_final(id_besoin_achat_final)
);

CREATE TABLE condition_achat (
    id_condition_achat SERIAL PRIMARY KEY,
    payement DECIMAL(20,3),
    livraison DECIMAL(20,3),
    payement_livraison DECIMAL(20,3),
    payement_reste DECIMAL(20,3),
    id_fournisseur INTEGER REFERENCES fournisseur(id_fournisseur)
);

CREATE TABLE bon_commande (
    id_bon_commande SERIAL PRIMARY KEY,
    date_emmission DATE,
    id_fournisseur INTEGER REFERENCES fournisseur(id_fournisseur)
);

CREATE TABLE poste (
    id_poste SERIAL PRIMARY KEY,
    intitule_poste VARCHAR(55),
    id_departement INTEGER REFERENCES departement(id_departement)
);

--------------
----tables----
--------------

--------------
----SELECT----
--------------

SELECT * FROM company;
SELECT * FROM employe;
SELECT * FROM proforma;
SELECT * FROM departement;
SELECT * FROM article;
SELECT * FROM besoin_achat;
SELECT * FROM proforma_final;
SELECT * FROM condition_achat;
SELECT * FROM bon_commande;
SELECT * FROM poste;

--------------
----SELECT----
--------------

-------------------
----DELETE FROM----
-------------------

DELETE FROM company;
DELETE FROM employe;
DELETE FROM proforma;
DELETE FROM departement;
DELETE FROM article;
DELETE FROM besoin_achat;
DELETE FROM proforma_final;
DELETE FROM condition_achat;
DELETE FROM bon_commande;
DELETE FROM poste;

-------------------
----DELETE FROM----
-------------------