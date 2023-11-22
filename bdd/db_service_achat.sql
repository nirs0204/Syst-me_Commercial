
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

CREATE TABLE responsable (
    id_responsable serial primary key,
    id_departement int references departement(id_departement),
    id_poste int references poste(id_poste)
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

-- etat : 
--------- 1 (en attente), 3 (approuvé_department), 5 (rejeté)
--------- 1 (en attente), 3 (approuvé_achat), 5 (rejeté), 6(traitement fournisseur)

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

create table besoin_achat_final(
    id_besoin_achat_final serial primary key,
    idbesoin_achat int references besoin_achat(idbesoin_achat),
    id_employe int references employe(id_employe),
    date_finale date
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
    id_fournisseur int references fournisseur(id_fournisseur),
    id_article int references article(id_article),
    date_demande date,
    date_proforma date,
    pu double precision,
    tva double precision,
    remise double precision,
    ttc double precision,
    stock double precision
);


create table proforma_final(
    id_final serial primary key,
    id_proforma int references proforma(id_proforma),
    id_article int references article(id_article),
    qtt double precision,
    date_demande date
);

create view get_achat as (SELECT a.id_article, a.nom, a.id_categorie , c.categorie, sum(ba.quantite) as qtt, min(ba.date_limite) as min_date , max(date_limite) as max_date
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
JOIN categorie c ON a.id_categorie = c.id_categorie
JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
WHERE ba.etat = 3 AND ba.idbesoin_achat in (baf.idbesoin_achat)
GROUP BY a.id_article,c.id_categorie );

create view cmd as (
    SELECT  f.id_fournisseur, f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt, ((p.pu * pf.qtt * p.tva) /100 ) as ttl_tva,((p.pu * pf.qtt ) + ((p.pu * pf.qtt * p.tva) /100 ) ) as ttl_ttc
FROM proforma_final pf
JOIN proforma p ON pf.id_proforma = p.id_proforma
JOIN demande_proforma dp ON pf.id_article = p.id_article
JOIN fournisseur f ON p.id_fournisseur = f.id_fournisseur
JOIN article a ON pf.id_article = a.id_article
WHERE dp.etat = 6 
GROUP BY f.id_fournisseur, f.nom , a.nom , p.pu, p.tva, p.remise, pf.qtt 
);


update proforma set stock =5 where id_proforma = 5;

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



--------------
----tables----
--------------

