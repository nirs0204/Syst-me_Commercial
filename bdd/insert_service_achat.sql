-- Insert company
INSERT INTO company (nom, date_creation, logo) VALUES
('Company A', '2023-01-01', 'logo1.png'),
('Company B', '2023-02-01', 'logo2.png'),
('Company C', '2023-03-01', 'logo3.png'),
('Company D', '2023-04-01', 'logo4.png');

-- Insert departement
INSERT INTO departement (nom) VALUES
('HR Department'),
('Finance Department'),
('IT Department'),
('Marketing Department');

-- Insert poste
INSERT INTO poste (intitule_poste, id_departement) VALUES
('HR Manager', 1),
('Accountant', 2),
('Software Developer', 3),
('Marketing Specialist', 4);

-- Insert article
INSERT INTO article (nom, type) VALUES
('Laptop', 1),
('Printer', 2),
('Desk Chair', 3),
('Whiteboard', 1);

-- Insert employe
INSERT INTO employe (id_poste, id_manager, nom, prenom, adresse, contact) VALUES
(1, NULL, 'Smith', 'John', '123 Main St', '555-1234'),
(3, 1, 'Johnson', 'Alice', '456 Oak St', '555-5678'),
(2, 1, 'Brown', 'Bob', '789 Pine St', '555-9012'),
(4, 3, 'Davis', 'Eva', '101 Elm St', '555-3456');

-- Insert utilisateur
INSERT INTO utilisateur (id_employe, pseudo, mdp) VALUES
(1, 'jsmith', '123'),
(2, 'ajohnson', '345'),
(3, 'bbrown', '567'),
(4, 'edavis', '789');

-- Insert fournisseur
INSERT INTO fournisseur (nom, email, contact, adresse) VALUES
('Supplier A', 'supplierA@example.com', 'Supplier A Contact', '123 Supplier St'),
('Supplier B', 'supplierB@example.com', 'Supplier B Contact', '456 Supplier St'),
('Supplier C', 'supplierC@example.com', 'Supplier C Contact', '789 Supplier St'),
('Supplier D', 'supplierD@example.com', 'Supplier D Contact', '101 Supplier St');


-- Insert besoin_achat ::: 1 ATTENTE , 3 APPROUVES , 5 REJETES , 
INSERT INTO besoin_achat (id_employe, id_article, id_departement, quantite, raison, etat, date_limite, priorite)
VALUES
(2, 1, 3, 10, 'Besoin pour le département IT', 3, '2023-12-01', 2),
(3, 2, 2, 5, 'Besoin pour le département Finance', 3, '2023-11-24', 1),
(3, 1, 2, 5, 'Besoin pour le département Finance', 3, '2023-11-24', 1),
(4, 3, 4, 8, 'Besoin pour le département Marketing', 3, '2023-11-30', 3),
(1, 4, 1, 3, 'Besoin pour le département HR', 3, '2023-12-10', 4);

