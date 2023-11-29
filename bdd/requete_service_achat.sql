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

DROP VIEW cmd;
DROP TABLE proforma_final;
DROP TABLE proforma;
DROP VIEW get_Achat;
DROP TABLE  company;
DROP TABLE responsable;
DROP TABLE  condition_achat;
DROP TABLE  bon_commande;
DROP TABLE  utilisateur;
DROP TABLE demande_proforma;
DROP TABLE  fournisseur;
DROP TABLE  besoin_achat_final;
DROP TABLE  besoin_achat;
DROP TABLE  article;
DROP TABLE categorie;
DROP TABLE  employe;
DROP TABLE  poste;
DROP TABLE  departement;




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

--VUE DON'T TOUCH
create view get_achat as (SELECT a.id_article, a.nom, a.id_categorie , c.categorie, sum(ba.quantite) as qtt, min(ba.date_limite) as min_date , max(date_limite) as max_date
FROM besoin_achat ba
JOIN article a ON ba.id_article = a.id_article
JOIN categorie c ON a.id_categorie = c.id_categorie
JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
WHERE ba.etat = 3 AND ba.idbesoin_achat in (baf.idbesoin_achat)
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

SELECT count(*) 
FROM besoin_achat ba
LEFT JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
JOIN employe e ON ba.id_employe = e.id_employe
JOIN article a ON ba.id_article = a.id_article
Join departement d ON ba.id_departement = d.id_departement
WHERE baf.id_besoin_achat_final IS NULL AND ba.etat = 3;


SELECT ba.idbesoin_achat, e.nom AS nom_employe, a.nom AS nom_article, d.nom as nom_departement, ba.quantite, ba.raison, ba.etat, ba.date_limite, ba.priorite
FROM besoin_achat ba
JOIN employe e ON ba.id_employe = e.id_employe
JOIN article a ON ba.id_article = a.id_article
Join departement d ON ba.id_departement = d.id_departement
WHERE ba.etat = 1;


SELECT count(*)
FROM besoin_achat ba
JOIN employe e ON ba.id_employe = e.id_employe
JOIN article a ON ba.id_article = a.id_article
Join departement d ON ba.id_departement = d.id_departement
WHERE  d.id_departement =1  AND ba.etat = 1;


-- proforma && besoin_achat valid

SELECT * FROM proforma p
JOIN fournisseur ON p.id_fournisseur = f.id_fournisseur
JOIN demande_proforma dp ON p.id_demande = dp.id_demande
JOIN article a ON a.id_article = p.id_article
WHERE dp.etat = 5;

SELECT ba.idbesoin_achat FROM besoin_achat ba
JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
WHERE  ba.id_article = 1 AND ba.etat = 3 AND baf.date_finale = CURRENT_DATE;


SELECT baf.idbesoin_achat FROM get_achat ga
JOIN besoin_achat_final baf ON ga.id_article = baf.date_finale
WHERE  ba.id_article = 1 AND ba.etat = 3  AND baf.date_finale = CURRENT_DATE;


SELECT dp.date_actuel FROM demande_proforma dp
where dp.etat = 0
GROUP BY dp.date_actuel;

SELECT dp.id_article , a.nom , dp.quantite
FROM demande_proforma dp
JOIN article a ON dp.id_article = a.id_article
where dp.etat = 0 AND dp.date_actuel = '2023-11-19'
GROUP BY dp.id_article,a.nom,dp.quantite;

SELECT dp.id_fournisseur , f.nom , f.email
FROM demande_proforma dp
JOIN fournisseur f ON dp.id_fournisseur = f.id_fournisseur
where dp.etat = 0 AND date_actuel = '2023-11-20' AND dp.id_article =1;

SELECT dp.id_fournisseur
FROM demande_proforma dp
JOIN fournisseur f ON dp.id_fournisseur = f.id_fournisseur
where dp.etat = 0 AND date_actuel = '2023-11-21' AND dp.id_article =1;

SELECT f.id_fournisseur, dp.etat ,f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt
FROM proforma_final pf
JOIN proforma p ON pf.id_proforma = p.id_proforma
JOIN demande_proforma dp ON pf.id_article = p.id_article
JOIN fournisseur f ON p.id_fournisseur = f.id_fournisseur
JOIN article a ON pf.id_article = a.id_article
WHERE dp.etat = 6
GROUP BY f.id_fournisseur,dp.etat , f.nom , a.nom , p.pu, p.tva, p.remise, pf.qtt ;


SELECT  f.id_fournisseur, f.nom AS nom_fournisseur, a.nom AS nom_article, p.pu, p.tva, p.remise, pf.qtt, ((p.pu * pf.qtt * p.tva) /100 ) as ttl_tva,((p.pu * pf.qtt ) + ((p.pu * pf.qtt * p.tva) /100 ) ) as ttl_ttc , 
FROM proforma_final pf
JOIN proforma p ON pf.id_proforma = p.id_proforma
JOIN demande_proforma dp ON pf.id_article = p.id_article
JOIN fournisseur f ON p.id_fournisseur = f.id_fournisseur
JOIN article a ON pf.id_article = a.id_article
WHERE dp.etat = 6 AND f.id_fournisseur = 7
GROUP BY f.id_fournisseur, f.nom , a.nom , p.pu, p.tva, p.remise, pf.qtt ;

--+remise:
,((p.pu * pf.qtt ) + ((p.pu * pf.qtt * p.tva) /100  ) -  ((p.pu * pf.qtt * p.remise) /100 ) ) as ttl_ttc 

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

select sum(pu*qtt) as ht , sum(ttl_tva) as tva , sum(ttl_ttc) as ttc from cmd where id_fournisseur = 7;



--hierarchie 

SELECT e.id_employe , d.id_departement , p.id_poste FROM responsable r
JOIN departement d ON r.id_departement = d.id_departement
JOIN  poste p ON p.id_poste =  r.id_poste
JOIN employe e ON e.id_poste = p.id_poste
WHERE d.id_departement = 5;


SELECT e.id_employe, d.id_departement, p.id_poste
FROM employe e
JOIN poste p ON p.id_poste = e.id_poste
JOIN departement d ON p.id_departement = d.id_departement
WHERE e.id_poste IN (
    SELECT r.id_poste FROM responsable r
    JOIN departement d ON r.id_departement = d.id_departement
    JOIN poste p ON p.id_poste = r.id_poste
    WHERE p.id_poste NOT IN (6)
);

--CHANGE GET ACHAT

SELECT ba.idbesoin_achat, e.nom , d.nom, a.nom , ba.raison ,  ba.quantite , ba.date_limite
FROM besoin_achat ba
JOIN employe e ON e.id_employe = ba.id_employe
JOIN poste p ON p.id_poste = e.id_poste
JOIN departement d ON d.id_departement = p.id_departement
JOIN article a ON ba.id_article = a.id_article
JOIN categorie c ON a.id_categorie = c.id_categorie
JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_achat
LEFT JOIN demande_proforma dp ON a.id_article = dp.id_article
WHERE  dp.date_actuel= '2023-11-22' AND ba.idbesoin_achat in (baf.idbesoin_achat)
GROUP BY ba.idbesoin_achat, e.nom , d.nom , a.nom , ba.raison ,  ba.quantite , ba.date_limite;


SELECT  ba.idbesoin_achat , baf.idbesoin_achat 
FROM besoin_achat ba
JOIN besoin_achat_final baf ON ba.idbesoin_achat = baf.idbesoin_ac hat
WHERE ba.etat = 3 AND ba.idbesoin_achat in (baf.idbesoin_achat);

SELECT * FROM besoin_achat;
SELECT * FROM besoin_achat_final

 select * from demande_proforma
where dp. ;

 -----
 SELECT p.* FROM Proforma p 
 where p.id_article = 1 AND p.date_demande = '2023-11-21'
 ORDER BY p.ttc ASC ;

 
 SELECT p.* FROM Proforma p 
 where p.id_article = 2 AND p.date_demande = '2023-11-20'
 ORDER BY p.ttc ASC ;


 SELECT p.* FROM Proforma p 
 where p.id_article = 4 AND p.date_demande = '2023-11-20'
 ORDER BY p.ttc ASC ;

 ----SELECT PROFOMA EMPLOYE

 SELECT * FROM Proforma p 
 where id_fournisseur in (SELECT dp.id_fournisseur
FROM demande_proforma dp
JOIN fournisseur f ON dp.id_fournisseur = f.id_fournisseur
where dp.etat = 0 AND date_actuel = '2023-11-20' AND dp.id_article =2)
AND p.id_article = 2;

select p.id_proforma, f.nom as nom_fournisseur, a.nom as nom_article, p.pu, p.tva, p.remise, p.stock
from proforma p
join fournisseur f on p.id_fournisseur = f.id_fournisseur
join article a on p.id_article = a.id_article;

--DISPACTH

SELECT  * FROM proforma_final


-----

SELECT
    f.id_fournisseur,
    f.nom AS nom_fournisseur,
    a.nom AS nom_article,
    p.pu,
    p.tva,
    p.remise,
    pf.qtt,
    ((p.pu * pf.qtt * p.tva) / 100) AS ttl_tva,
    ((p.pu * pf.qtt) + ((p.pu * pf.qtt * p.tva) / 100)) AS ttl_ttc
FROM
    proforma_final pf
JOIN proforma p ON pf.id_proforma = p.id_proforma
JOIN demande_proforma dp ON p.id_fournisseur = dp.id_fournisseur
JOIN fournisseur f ON dp.id_fournisseur = f.id_fournisseur
JOIN article a ON dp.id_article = a.id_article
WHERE
    dp.etat = 8
    and f.id_fournisseur=1
GROUP BY f.id_fournisseur, f.nom , a.nom , p.pu, p.tva, p.remise, pf.qtt ;


SELECT
    f.id_fournisseur,
    pf.id_final,
    f.nom AS nom_fournisseur,
    a.nom AS nom_article,
    p.pu,
    p.tva,
    p.remise,
    pf.qtt,
    ((p.pu * pf.qtt * p.tva) / 100) AS ttl_tva,
    ((p.pu * pf.qtt) + ((p.pu * pf.qtt * p.tva) / 100)) AS ttl_ttc
FROM
    proforma_final pf
JOIN proforma p ON pf.id_proforma = p.id_proforma
JOIN demande_proforma dp ON p.id_fournisseur = dp.id_fournisseur AND p.id_article = dp.id_article
JOIN fournisseur f ON dp.id_fournisseur = f.id_fournisseur
JOIN article a ON dp.id_article = a.id_article
WHERE
    dp.etat = 8;

SELECT id_fournisseur, nom_fournisseur,id_article,id_final, nom_article, pu, tva, remise, qtt ,ttl_tva, ttl_ttc,date_actuel from cmd
WHERE id_fournisseur = 7
GROUP BY id_fournisseur, nom_fournisseur,id_article,id_final, nom_article, pu, tva, remise, qtt ,ttl_tva, ttl_ttc,date_actuel;


--------------
----SELECT----
--------------

--------------
----UPDATE----
--------------

 update demande_proforma set etat=0 where id_demande = 1;
 update demande_proforma set etat=0 where id_demande = 2;
 update demande_proforma set etat=0 where id_demande = 3;

 update proforma set stock=4 where id_proforma = 3;
 update proforma set stock=2 where id_proforma = 2;
 update proforma set stock=3 where id_proforma = 1;

 --------------
----UPDATE----
--------------


SELECT
    pf.id_final,
    p.id_proforma,
    p.id_fournisseur,
    p.id_article,
    pf.date_demande,
    p.date_proforma,
    p.pu,
    p.tva,
    p.remise,
    p.ttc,
    p.stock,
    dp.etat,
    dp.quantite,
    dp.date_actuel
FROM
    proforma_final pf
JOIN proforma p ON pf.id_proforma = p.id_proforma
JOIN demande_proforma dp ON p.id_fournisseur = dp.id_fournisseur AND p.id_article = dp.id_article
WHERE
    dp.etat = 6;

-----------------------

SELECT dp.id_article,a.nom,dp.quantite,dp.date_actuel 
FROM demande_proforma dp
JOIN article a ON a.id_article = dp.id_article
WHERE etat=0
GROUP BY dp.id_article,a.nom,dp.quantite,dp.date_actuel ;
