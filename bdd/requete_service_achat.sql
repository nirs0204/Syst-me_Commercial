
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

DROP TABLE  company;
DROP TABLE  departement;
DROP TABLE  poste;
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



SELECT ba.id_employe, a.nom, ba.quantite, ba.date_limite
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
WHERE ba.etat = 3 AND ba.date_limite >= CURRENT_DATE;

SELECT  a.nom, sum(ba.quantite), min(ba.date_limite) , max(date_limite)
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
WHERE ba.etat = 3 AND ba.date_limite >= CURRENT_DATE
GROUP BY a.id_article;

--------------
----SELECT----
--------------


