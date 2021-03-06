
drop trigger if exists consegnato_disponibile;
delimiter //
create trigger consegnato_disponibile
AFTER INSERT
ON CONSEGNA FOR EACH ROW
BEGIN

DECLARE codLibro INT;
DECLARE codPrestito INT;
DECLARE not_valid_Fine TIME;
    
if (NEW.TipoConsegna = 'Restituzione') then
	select CodicePrestito into codPrestito from consegna where Volontario = NEW.Volontario and DataConsegna = NEW.DataConsegna and TipoConsegna = 'Restituzione' and CodicePrestito = new.CodicePrestito;
    select Libro into codLibro from Prestito where Codice = codPrestito;
    
    update cartaceo set StatoPrestito='Disponibile' where codice = codLibro;
end if;
END//
delimiter;


drop event if exists scadenza_prestito;

CREATE EVENT scadenza_prestito
ON SCHEDULE EVERY 1 DAY 
STARTS CURRENT_TIMESTAMP
DO
	UPDATE CARTACEO SET StatoPrestito = "Disponibile" WHERE CODICE IN(SELECT LIBRO FROM Prestito WHERE DATAFINE >= CURDATE()) AND StatoPrestito <> "Disponibile";
    
drop trigger if exists fine_prestito_prenotato_consegnato;
delimiter //
create trigger fine_prestito_prenotato_consegnato
AFTER UPDATE
ON CONSEGNA FOR EACH ROW
BEGIN

DECLARE codLibro INT;
DECLARE codPrestito INT;
DECLARE not_valid_Fine TIME;

if NEW.DataConsegna is not null then
UPDATE PRESTITO SET DataFine = ADDDATE(NEW.DataConsegna, INTERVAL 15 DAY), DataInizio = NEW.DataConsegna
WHERE PRESTITO.Codice = NEW.CodicePrestito;


select CodicePrestito into codPrestito from consegna where Volontario = NEW.Volontario and DataConsegna = NEW.DataConsegna and TipoConsegna = 'Affidamento' and CodicePrestito = new.CodicePrestito;
    select Libro into codLibro from Prestito where Codice = codPrestito;
    
    update cartaceo set StatoPrestito='Consegnato' where codice = codLibro;


end if;
END//
delimiter;
 
 


#La prenotazione di un posto lettura è possibile solo a condizione che 
#la biblioteca abbia effettivamente posti lettura 
#disponibili per la data/orario richiesto

drop trigger if exists trigger_prenotazione_posto_lettura;
delimiter //

create trigger trigger_prenotazione_posto_lettura
before insert
on PRENOTAZIONE_POSTO_LETTURA for each row
begin
	DECLARE errMsg VARCHAR(255);
    DECLARE rowNr INT;
    DECLARE not_valid_Inizio TIME;
    DECLARE not_valid_Fine TIME;
    
    SELECT COUNT(*) INTO rowNr FROM PRENOTAZIONE_POSTO_LETTURA WHERE (Inizio  BETWEEN NEW.Inizio and NEW.Fine) AND (Fine  BETWEEN NEW.Inizio and NEW.Fine) AND DataPrenotazione = NEW.DataPrenotazione AND Posto = NEW.Posto AND Biblioteca = NEW.Biblioteca;
    SELECT MIN(Inizio) into not_valid_Inizio FROM PRENOTAZIONE_POSTO_LETTURA WHERE (Inizio  BETWEEN NEW.Inizio and NEW.Fine) AND (Fine  BETWEEN NEW.Inizio and NEW.Fine) AND DataPrenotazione = NEW.DataPrenotazione AND Biblioteca = NEW.Biblioteca;
    SELECT MAX(Fine) into not_valid_Fine FROM PRENOTAZIONE_POSTO_LETTURA WHERE (Inizio  BETWEEN NEW.Inizio and NEW.Fine) AND (Fine  BETWEEN NEW.Inizio and NEW.Fine) AND DataPrenotazione = NEW.DataPrenotazione AND Biblioteca = NEW.Biblioteca;
    
    SET errMsg = CONCAT('Prenotazione posto lettura nr: ',NEW.Posto,'\n Biblioteca: ',NEW.Biblioteca,'\n Status: Occupato da ',not_valid_Inizio,' a ', not_valid_Fine);
    
    IF(rowNr > 0) THEN
		SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = errMsg;
	END IF;
		
END//
delimiter ;




drop trigger if exists trigger_prestito_not_scadente_libro;
delimiter //

create trigger trigger_prestito_not_scadente_libro
before insert
on PRESTITO for each row
begin
    
    DECLARE rowNrDisp INT;
    DECLARE rowNrScad INT;
    DECLARE not_valid_titolo varchar(20);
    DECLARE errMsg varchar(255);
    
    SELECT COUNT(*) INTO rowNrDisp FROM Cartaceo WHERE Codice = NEW.Libro
    AND StatoPrestito = "Disponibile" AND StatoConservazione <> "Scadente";
    
    select Titolo into not_valid_titolo from Cartaceo where Codice = new.Codice;
    
    
    IF(rowNrDisp <= 0) THEN
		  SET errMsg = concat("Libro :",not_valid_titolo,"\nRisulta non disponibile in Biblioteca selezionata");
		  SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = "Libro non risulta prenotabile a causa dello stato prestito o conservazione";
    ELSE
		    UPDATE Cartaceo SET StatoPrestito = "Prenotato" WHERE Codice = NEW.Libro AND StatoPrestito = "Disponibile" AND StatoConservazione <> "Scadente";
	END IF;
    
END//
delimiter ;



drop trigger if exists trigger_sospensione_utilizzatore;
delimiter //

create trigger trigger_sospensione_utilizzatore
after insert
on Segnalazione for each row
begin
    
    DECLARE rowNrUtiliz INT;
    DECLARE rowNrScad INT;
    DECLARE not_valid_titolo varchar(20);
    DECLARE errMsg varchar(255);
    
    SELECT count(Utilizzatore) into rowNrUtiliz FROM Segnalazione where Utilizzatore = NEW.Utilizzatore;
    
    IF(rowNrUtiliz >= 3) THEN
		UPDATE Utilizzatore SET Stato ="Sospeso" where Email = NEW.Utilizzatore;
	END IF;
    
END//
delimiter ;