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


DELETE FROM  company;
DELETE FROM  departement;
DELETE FROM  poste;
DELETE FROM  article;
DELETE FROM  employe;
DELETE FROM  utilisateur;
DELETE FROM  fournisseur;
DELETE FROM  besoin_achat_final;
DELETE FROM  besoin_achat;
DELETE FROM  condition_achat;
DELETE FROM  proforma;
DELETE FROM  proforma_final;
DELETE FROM  bon_commande;

-------------------
----DELETE FROM----
-------------------


-------------------
----DROP TABLE ----
-------------------
DROP VIEW get_Achat;
DROP TABLE  company;
DROP TABLE  poste;
DROP TABLE  departement;
DROP TABLE  article;
DROP TABLE  employe;
DROP TABLE  utilisateur;
DROP TABLE  fournisseur;
DROP TABLE  besoin_achat_final;
DROP TABLE  besoin_achat;
DROP TABLE  condition_achat;
DROP TABLE  proforma;
DROP TABLE  proforma_final;
DROP TABLE  bon_commande;


-------------------
----DROP TABLE ----
-------------------


--------------
----SELECT----
--------------


SELECT * FROM  company;
SELECT * FROM  departement;
SELECT * FROM  poste;
SELECT * FROM  article;
SELECT * FROM  employe;
SELECT * FROM  utilisateur;
SELECT * FROM  fournisseur;
SELECT * FROM  besoin_achat_final;
SELECT * FROM  besoin_achat;
SELECT * FROM  condition_achat;
SELECT * FROM  proforma;
SELECT * FROM  proforma_final;
SELECT * FROM  bon_commande;


SELECT * FROM article a 
JOIN categorie c ON a.id_categorie = c.id_categorie
where a.id_categorie = 1;

SELECT ba.id_employe, a.nom, ba.quantite, ba.date_limite
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
WHERE ba.etat = 3 AND ba.date_limite >= CURRENT_DATE;

SELECT a.nom, a.id_categorie , c.categorie, sum(ba.quantite), min(ba.date_limite) , max(date_limite)
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
JOIN categorie c ON a.id_categorie = c.id_categorie
WHERE ba.etat = 3 AND ba.date_limite >= CURRENT_DATE
GROUP BY a.id_article,c.id_categorie;

create view get_achat as (SELECT a.id_article, a.nom, a.id_categorie , c.categorie, sum(ba.quantite) as qtt, min(ba.date_limite) as min_date , max(date_limite) as max_date
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
JOIN categorie c ON a.id_categorie = c.id_categorie
WHERE ba.etat = 3 AND ba.date_limite >= CURRENT_DATE
GROUP BY a.id_article,c.id_categorie );


 select * from get_achat group by min_date,id_article,nom,id_categorie,categorie,qtt,max_date;

SELECT * FROM get_Achat  WHERE id_article = 1;
SELECT * FROM fournisseur where id_categorie = (SELECT id_categorie FROM get_Achat  WHERE id_article = 1);

-- Liste des besoin_achat approuvés mais ne sont pas dans besoin_achat_final
SELECT ba.*
FROM besoin_achat ba
LEFT JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
WHERE baf.id_besoin_achat_final IS NULL;

SELECT d.id_departement
FROM utilisateur u
JOIN employe e ON u.id_employe = e.id_employe
JOIN poste p ON e.id_poste = p.id_poste
JOIN departement d ON p.id_departement = d.id_departement
WHERE u.id_utilisateur = 1;


SELECT ba.idbesoin_achat, e.nom AS nom_employe, a.nom AS nom_article, ba.id_departement, ba.quantite, ba.raison, ba.etat, ba.date_limite, ba.priorite
FROM besoin_achat ba
JOIN employe e ON ba.id_employe = e.id_employe
JOIN article a ON ba.id_article = a.id_article;

SELECT ba.idbesoin_achat, e.nom AS nom_employe, a.nom AS nom_article, d.nom as nom_departement, ba.quantite, ba.raison, ba.etat, ba.date_limite, ba.priorite
FROM besoin_achat ba
LEFT JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
JOIN employe e ON ba.id_employe = e.id_employe
JOIN article a ON ba.id_article = a.id_article
Join departement d ON ba.id_departement = d.id_departement
WHERE baf.id_besoin_achat_final IS NULL AND ba.etat = 3;


--

SELECT * FROM proforma p
JOIN fournisseur ON p.id_fournisseur = f.id_fournisseur
JOIN demande_proforma dp ON p.id_demande = dp.id_demande
JOIN article a ON a.id_article = p.id_article
WHERE dp.etat = 5;




--------------
----SELECT----
--------------


