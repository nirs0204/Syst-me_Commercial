-- Insert company
INSERT INTO company (nom, date_creation, logo) VALUES
('Company A', '2023-01-01', 'logo1.png'),
('Company B', '2023-02-01', 'logo2.png'),
('Company C', '2023-03-01', 'logo3.png'),
('Company D', '2023-04-01', 'logo4.png');

-- Insert departement
INSERT INTO departement (nom) VALUES
('Départements des ressources humaines'),
('Département financier'),
('Département IT'),
('Département commercial'),
('département des approvisionnements ');
-- Insert poste
INSERT INTO poste (intitule_poste, id_departement) VALUES
('Responsable RH', 1),
('Comptable', 2),
('Développeur de logiciels', 3),
('Responsable informatique', 3),
('Spécialiste du marketing', 4),
('responsable approvisionnement', 5),
('directeur financier', 2) ;

-- Insertion responsable
INSERT INTO responsable (id_departement, id_poste) VALUES
(1, 1), -- Responsable RH
(2, 7), -- Directeur financier
(3, 4), -- Développeur de logiciels
(4, 5), -- Spécialiste du marketing
(5, 6); -- Responsable approvisionnement


-- Insertion de données dans la table categorie
INSERT INTO categorie (categorie) VALUES
('fourniture de bureau'),
('produit chimique'),
('fourniture immobilier'),
('produit sanitaire'),
('grossiste'),
('service');


-- Insert article
INSERT INTO article (id_categorie,nom, type) VALUES
(1,'Laptop', 1),
(1,'Printer', 1),
(3,'Desk Chair', 1),
(1,'Whiteboard', 1),
(4,'mouth cover', 1),
(4,'hydroalcoholic gel', 1),
(1,'500w bulb', 1),
(2,'acetic acid', 1),
(2,'sodium hydroxide', 1),
(2,'hydrogen peroxide', 1),
(3,'Office cabinet', 1);

-- Insert employe
INSERT INTO employe (id_poste, id_manager, nom, prenom, adresse, contact) VALUES
(1, NULL, 'Smith', 'John', '123 Main St', '555-1234'),
(3, 1, 'Johnson', 'Alice', '456 Oak St', '555-5678'),
(7, 1, 'Brown', 'Bob', '789 Pine St', '555-9012'),
(5, 3, 'Davis', 'Eva', '101 Elm St', '555-3456'),
(4, 1, 'Alice', 'Ruller', '13 Fiu St', '555-1293'),
(6, 1, 'Nicolas', 'Dupuis', '13 Fiu St', '555-1293');

-- Insert utilisateur
INSERT INTO utilisateur (id_employe, pseudo, mdp) VALUES
(1, 'jsmith', '123'),
(2, 'ajohnson', '345'),
(3, 'bbrown', '567'),
(4, 'edavis', '789'),
(5, 'ralice', '102'),
(6, 'fnicolas', '204');

-- Insert fournisseur
INSERT INTO fournisseur (id_categorie,nom, email, contact, adresse, mdp) VALUES
(1,'FRNS A', 'supplierA@example.com', 'Supplier A Contact', '123 Supplier St', '123'),
(2,'FRNS B', 'supplierB@example.com', 'Supplier B Contact', '456 Supplier St', '123'),
(3,'FRNS C', 'supplierC@example.com', 'Supplier C Contact', '789 Supplier St', '123'),
(4,'FRNS D', 'supplierD@example.com', 'Supplier D Contact', '101 Supplier St', '123'),
(5,'FRNS E', 'supplierE@example.com', 'Supplier E Contact', '734 Supplier St', '123'),
(6,'FRNS F', 'supplierF@example.com', 'Supplier F Contact', '203 Supplier St', '123'),

(1, 'FRNS G', 'supplierG@example.com', 'Supplier G Contact', '456 Supplier St', '123'),
(2, 'FRNS H', 'supplierH@example.com', 'Supplier H Contact', '789 Supplier St', '123'),
(3, 'FRNS I', 'supplierI@example.com', 'Supplier I Contact', '101 Supplier St', '123'),
(4, 'FRNS J', 'supplierJ@example.com', 'Supplier J Contact', '222 Supplier St', '123'),
(5, 'FRNS K', 'supplierK@example.com', 'Supplier K Contact', '333 Supplier St', '123'),
(6, 'FRNS L', 'supplierL@example.com', 'Supplier L Contact', '444 Supplier St', '123'),

(1, 'FRNS M', 'supplierM@example.com', 'Supplier M Contact', '555 Supplier St', '123'),
(2, 'FRNS N', 'supplierN@example.com', 'Supplier N Contact', '666 Supplier St', '123'),
(3, 'FRNS O', 'supplierO@example.com', 'Supplier O Contact', '777 Supplier St', '123'),
(4, 'FRNS P', 'supplierP@example.com', 'Supplier P Contact', '888 Supplier St', '123'),
(5, 'FRNS Q', 'supplierQ@example.com', 'Supplier Q Contact', '999 Supplier St', '123'),
(6, 'FRNS R', 'supplierR@example.com', 'Supplier R Contact', '123 Supplier St', '123'),

(1, 'FRNS S', 'supplierS@example.com', 'Supplier S Contact', '456 Supplier St', '123'),
(2, 'FRNS T', 'supplierT@example.com', 'Supplier T Contact', '789 Supplier St', '123'),
(3, 'FRNS U', 'supplierU@example.com', 'Supplier U Contact', '101 Supplier St', '123'),
(4, 'FRNS V', 'supplierV@example.com', 'Supplier V Contact', '222 Supplier St', '123'),
(5, 'FRNS W', 'supplierW@example.com', 'Supplier W Contact', '333 Supplier St', '123'),
(5, 'FRNS Z', 'supplierZ@example.com', 'Supplier Z Contact', '333 Supplier St', '123');


-- Insert besoin_achat ::: 1 ATTENTE , 3 APPROUVES , 5 REJETES , 
INSERT INTO besoin_achat (id_employe, id_article, id_departement, quantite, raison, etat, date_limite, priorite)
VALUES
(2, 1, 3, 10, 'Besoin pour le département IT', 1, '2023-12-01', 2),
(3, 2, 2, 5, 'Besoin pour le département Finance', 1, '2023-11-24', 1),
(3, 1, 2, 5, 'Besoin pour le département Finance', 3, '2023-11-24', 1),
(4, 3, 4, 8, 'Besoin pour le département Marketing', 1, '2023-11-30', 3),
(1, 4, 1, 3, 'Besoin pour le département HR', 1, '2023-12-10', 4);

-- Insert besoin_achat_final
INSERT INTO besoin_achat_final (idbesoin_achat, id_employe, date_finale)
VALUES
(1, 5, CURRENT_DATE),
(2, 5, CURRENT_DATE),
(3, 5, CURRENT_DATE),
(4, 5, CURRENT_DATE),
(5, 5, CURRENT_DATE);

-- Insert Proforma
INSERT INTO proforma (id_fournisseur, id_article, date_demande, date_proforma, pu, tva, remise , ttc , stock)
VALUES
  (1, 2, ' 2023-11-21', '2023-11-22', 25000, 20, 0, 30000, 5 ),
  (7, 2, ' 2023-11-21', '2023-11-23', 30000,20, 0 , 36000,10 ),
  (13, 2, ' 2023-11-21', '2023-11-24', 20000, 20, 0 , 24000, 20 );

INSERT INTO proforma (id_fournisseur, id_article, date_demande, date_proforma, pu, tva, remise , ttc , stock)
VALUES
  (1, 1, ' 2023-11-21', '2023-11-22', 25000, 20, 0, 30000, 20 ),
  (7, 1, ' 2023-11-21', '2023-11-23', 20000, 20, 0 , 24000, 10 ),
  (13, 1, ' 2023-11-21', '2023-11-24', 30000,20, 0 , 36000,5 );

INSERT INTO proforma (id_fournisseur, id_article, date_demande, date_proforma, pu, tva, remise , ttc , stock)
VALUES
  (1, 4, ' 2023-11-21', '2023-11-22', 30000,20, 0 , 36000,10 ),
  (7, 4, ' 2023-11-21', '2023-11-23', 20000, 20, 0 , 24000, 20 ),
  (13, 4, ' 2023-11-21', '2023-11-24', 25000, 20, 0, 30000, 20 );
  
INSERT INTO proforma (id_fournisseur, id_article, date_demande, date_proforma, pu, tva, remise , ttc , stock)
VALUES  
  (3, 3, ' 2023-11-21', '2023-11-22', 25000, 20, 0, 30000, 20 ),
  (9, 3, ' 2023-11-21', '2023-11-23', 30000,20, 0 , 36000,30 ),
  (15, 3, ' 2023-11-21', '2023-11-24', 20000, 20, 0 , 24000, 10 );  


