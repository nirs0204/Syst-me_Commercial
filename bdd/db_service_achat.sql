
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

CREATE TABLE categorie(
    id_categorie serial primary key,
    categorie varchar(255)
);

create table article(
    id_article serial primary key,
    id_categorie int references categorie(id_categorie),
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
     mdp varchar(100)
 );

create table fournisseur (
    id_fournisseur serial primary key,
    id_categorie int references categorie(id_categorie),
    nom varchar(255),
    email varchar(255),
    contact varchar(255),
    adresse varchar(255)    
);

-- etat : 1 (en attente), 3 (approuvé), 5 (rejeté)
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

CREATE TABLE demande_proforma(
    id_demande serial primary key,
    id_article int references article(id_article),
    id_fournisseur int references fournisseur(id_fournisseur),
    etat int default 0,
    quantite int,
    date_actuel date default CURRENT_DATE
);

create table proforma (
    id_proforma serial primary key ,
    id_demande int references demande_proforma(id_demande),
    id_fournisseur int references fournisseur(id_fournisseur),
    id_article int references article(id_article),
    pu double precision,
    ht double precision,
    tva double precision,
    remise double precision
);

create table besoin_achat_final(
    id_besoin_achat_final serial primary key,
    idbesoin_achat int references besoin_achat(idbesoin_achat),
    id_employe int references employe(id_employe),
    date_finale date
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

