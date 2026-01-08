Une séquence Oracle permet de générer automatiquement des IDs uniques

 CREATE SEQUENCE recoltes_seq
 START WITH 1
 INCREMENT BY 1
 NOCACHE;


##Création d’un trigger Oracle

Le trigger se charge d’assigner automatiquement l’ID avant insertion :

CREATE OR REPLACE TRIGGER recoltes_bi
BEFORE INSERT ON RECOLTES
FOR EACH ROW
BEGIN
  IF :NEW.ID IS NULL THEN
    SELECT recoltes_seq.NEXTVAL INTO :NEW.ID FROM dual;
  END IF;
END;
/

