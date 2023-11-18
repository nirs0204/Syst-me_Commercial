
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
-- Liste des besoin_achat approuvés mais ne sont pas dans besoin_achat_final
SELECT ba.*
FROM besoin_achat ba
LEFT JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
WHERE baf.id_besoin_achat_final IS NULL;



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