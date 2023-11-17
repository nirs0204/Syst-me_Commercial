/*
    Base de donnée Gestion d'achat
*/

CREATE DATABASE commercial;

------------
-- Tables --
------------
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