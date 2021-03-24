#CREAZIONE DATABASE "EBIBLIO"



 

select @@default_storage_engine;
SET @@global.sql_mode= 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
SET @@time_zone = 'SYSTEM';

 

drop database if exists EBIBLIO;
create database EBIBLIO;
use  EBIBLIO;

 

#RICORDARE DI ELIMINARE I DEFAULT
create table BIBLIOTECA(
    Nome varchar(255) primary key,
    Email varchar(255),
    SitoWeb varchar(255),
    Indirizzo varchar(255),
    Latitudine decimal(16,12),
    Longitudine decimal(16,12),
    Note varchar(200)
); 

 


create table TELEFONO(
    NomeBiblioteca varchar(255),
    NumeroTelefono varchar(15),
    foreign key(NomeBiblioteca) references BIBLIOTECA(Nome) on delete cascade on update cascade,
    primary key(NomeBiblioteca, NumeroTelefono)
); 
 

 

create table IMMAGINE(
    NomeFoto varchar(255),
    Biblioteca varchar(255),
    foreign key (Biblioteca) references BIBLIOTECA(Nome) on delete cascade on update cascade,
    primary key(NomeFoto, Biblioteca)
);

 


create table POSTO_LETTURA(
    Numero int auto_increment not null,
    Biblioteca varchar(255),
    foreign key(Biblioteca) references BIBLIOTECA(Nome) on delete cascade on update cascade,
    primary key(Numero,Biblioteca),
    ReteEthernet BIT, #0=no, 1=si
    PresaCorrente BIT    #0=no, 1=si 
); 

 

 
create table CARTACEO(
    Codice int auto_increment primary key,
    Titolo varchar(255),
    Edizione varchar(255),
    Genere varchar(255),
    AnnoPubblicazione int
);

 


create table EBOOK(
    Codice int primary key auto_increment not null,
    Titolo varchar(20),
    Edizione varchar(20),
    Genere varchar(20),
    AnnoPubblicazione int,
    Dimensione int,
    PDF varchar(20),
    NumAccessi int default 0
);

 

 
create table RACCOLTA(
    Biblioteca varchar(255),
    Libro int,
    StatoConservazione varchar(9) not null,
    StatoDisponibilita varchar(11) not null,
    Scaffale varchar(255),
    constraint valid_stato_conservazione check(StatoConservazione in ("Ottimo","Buono","Non Buono", "Scadente")),
    constraint valid_stato_disponibilita check(StatoDisponibilita in ("Disponibile","Prenotato","Consegnato")),
    foreign key (Libro) references CARTACEO(Codice) on delete cascade on update cascade,
    foreign key (Biblioteca) references BIBLIOTECA(Nome) on delete cascade on update cascade,
    primary key(Biblioteca, Libro, Scaffale)
);

 

 
create table AUTORE(
    Codice int primary key auto_increment not null,
    Nome varchar(255),
    Cognome varchar(255)
);

 


create table AUTORE_LIBRO(
    Libro int,
    foreign key (Libro) references CARTACEO(Codice),
    foreign key (Libro) references EBOOK(Codice),
    Autore int,
    foreign key(Autore) references AUTORE(Codice),
    primary key(Libro,Autore)
);
 

 

create table AMMINISTRATORE(
    Email varchar(255) primary key,
    Password varchar(255), 
    Nome varchar(255),
    Cognome varchar(255),
    DataNascita date not null,
    LuogoNascita varchar(255) not null,
    Tel varchar(15),
    Qualifica varchar(255),
    BibliotecaGestita varchar(255) references BIBLIOTECA(Nome)  on delete cascade on update cascade
);

 

 
create table UTILIZZATORE(
    Email varchar(255) primary key,
    Password varchar(255), 
    Nome varchar(255),
    Cognome varchar(255),
    DataNascita date not null,
    LuogoNascita varchar(255) not null,
    Tel varchar(15),
    DataCreazione date not null,
    Professione varchar(255),
    Stato varchar(7)not null,
    constraint valid_stato check(Stato in("Attivo","Sospeso"))
);

 

     
create table VOLONTARIO(
    Email varchar(255) primary key,
    Password varchar(255), 
    Nome varchar(255),
    Cognome varchar(255),
    DataNascita date not null,
    LuogoNascita varchar(255) not null,
    Tel varchar(15),
    MezzoTrasporto varchar(5) not null,
    constraint valid_mezzo_trasporto check(MezzoTrasporto in("Piedi","Bici","Auto"))
);

 


create table SEGNALAZIONE(
    Amministratore varchar(255),
    foreign key (Amministratore) references AMMINISTRATORE(Email) on delete cascade on update cascade,
    Utilizzatore varchar(255),
    foreign key (Utilizzatore) references UTILIZZATORE(Email) on delete cascade on update cascade,
    DataSegnalazione datetime not null,
    Note varchar(200),
    primary key(Amministratore,Utilizzatore,DataSegnalazione)
);
 
create table MESSAGGIO(
    Amministratore varchar(255),
    foreign key (Amministratore)references AMMINISTRATORE(Email) on delete cascade on update cascade,
    Utilizzatore varchar(255),
    foreign key(Utilizzatore)references UTILIZZATORE(Email) on delete cascade on update cascade,
    DataInvio datetime not null, 
    Titolo varchar(255),
    Testo varchar(280),
    primary key(Amministratore,Utilizzatore,DataInvio)
);

 

create table PRENOTAZIONE_POSTO_LETTURA(
    Posto int,
    Biblioteca varchar(255),
    Utilizzatore varchar(255),
    foreign key(Utilizzatore) references UTILIZZATORE(Email) on delete cascade on update cascade,
    foreign key(Biblioteca) references BIBLIOTECA(Nome) on delete cascade on update cascade,
    foreign key(Posto) references POSTO_LETTURA(Numero) on delete cascade on update cascade,
    DataPrenotazione date not null,
    Inizio time, # 
    Fine time, 
    primary key(Posto,Biblioteca,Utilizzatore)
);

 

create table PRESTITO(
    Codice int auto_increment not  null,
    Utilizzatore varchar(255),
    foreign key (Utilizzatore) references UTILIZZATORE(Email) on delete cascade on update cascade,
    Libro int,
    Biblioteca varchar(255),
    foreign key (Libro) references CARTACEO(Codice) on delete cascade on update cascade,
    foreign key (Biblioteca) references Biblioteca(Nome) on delete cascade on update cascade,
    DataInizio date not null,
    DataFine date,
    primary key(Codice)
);

 


create table CONSEGNA(
    Codice int auto_increment,
    Volontario varchar(255),
    CodicePrestito int,
    foreign key(CodicePrestito)references PRESTITO(Codice),
    foreign key(Volontario)references VOLONTARIO(Email) on delete cascade on update cascade,
    DataConsegna date not null,
    TipoConsegna varchar(12) default "Affidamento",
    Note varchar(200),
    constraint valid_tipo_consegna check(TipoConsegna in ("Restituzione","Affidamento")),
    primary key(Codice,Volontario,CodicePrestito)
);
 
create table ACCESSO_EBOOK(
    Ebook int,
    foreign key (Ebook) references EBOOK(Codice) on delete cascade on update cascade,
    Utilizzatore varchar(255),
    foreign key(Utilizzatore) references UTILIZZATORE(Email) on delete cascade on update cascade,
    DataAccesso date not null,
    primary key(Ebook,DataAccesso)
    );
 
 
drop trigger if exists fine_prestito;
delimiter //
create trigger fine_prestito
AFTER INSERT
ON CONSEGNA FOR EACH ROW
BEGIN
if NEW.DataConsegna is not null then
UPDATE PRESTITO SET DataFine = ADDDATE(NEW.DataConsegna, INTERVAL 15 DAY)
WHERE PRESTITO.Codice = NEW.CodicePrestito;
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
    
    SELECT COUNT(*) INTO rowNr FROM PRENOTAZIONE_POSTO_LETTURA WHERE (Inizio  BETWEEN NEW.Inizio and NEW.Fine) AND (Fine  BETWEEN NEW.Inizio and NEW.Fine) AND DataPrenotazione = NEW.DataPrenotazione;
    SELECT MIN(Inizio) into not_valid_Inizio FROM PRENOTAZIONE_POSTO_LETTURA WHERE (Inizio  BETWEEN NEW.Inizio and NEW.Fine) AND (Fine  BETWEEN NEW.Inizio and NEW.Fine) AND DataPrenotazione = NEW.DataPrenotazione;
    SELECT MAX(Fine) into not_valid_Fine FROM PRENOTAZIONE_POSTO_LETTURA WHERE (Inizio  BETWEEN NEW.Inizio and NEW.Fine) AND (Fine  BETWEEN NEW.Inizio and NEW.Fine) AND DataPrenotazione = NEW.DataPrenotazione;
    
    SET errMsg = CONCAT('Prenotazione posto lettura nr: ',NEW.Posto,'\n Biblioteca: ',NEW.Biblioteca,'\n Status: Occupato da ',not_valid_Inizio,' a ', not_valid_Fine);
    
    IF(rowNr > 0) THEN
		SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = errMsg;
	END IF;
		
END//
delimiter ;



drop trigger if exists trigger_disponibilita_not_scadente_libro;
delimiter //

create trigger trigger_disponibilita_not_scadente_libro
before insert
on PRESTITO for each row
begin
    
    DECLARE rowNrDisp INT;
    DECLARE rowNrScad INT;
    DECLARE not_valid_titolo varchar(20);
    DECLARE errMsg varchar(255);
    
    SELECT COUNT(*) INTO rowNrDisp FROM Raccolta WHERE Biblioteca = NEW.Biblioteca AND Libro = NEW.Libro 
    AND StatoDisponibilita = "Disponibile";
    
    SELECT COUNT(*) INTO rowNrScad FROM Raccolta WHERE Biblioteca = NEW.Biblioteca AND Libro = NEW.Libro 
    AND StatoConservazione <> "Scadente";
    
    select Titolo into not_valid_titolo from Cartaceo where Codice = new.Libro;
    
    
    IF(rowNrDisp <= 0) THEN
		SET errMsg = concat("Libro :",not_valid_titolo,"\nRisulta non disponibile in Biblioteca :",NEW.Biblioteca);
		SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = errMsg;
	ELSEIF(rowNrScad <= 0) THEN
		SET errMsg = concat("Libro :",not_valid_titolo,"\nRisulta in stato conservazione : Scadente");
        SIGNAL SQLSTATE '45000' 
            SET MESSAGE_TEXT = errMsg;
    ELSE
		UPDATE Raccolta SET StatoDisponibilita = "Prenotato" WHERE Biblioteca = NEW.Biblioteca AND Libro = NEW.Libro 
		AND StatoDisponibilita = "Disponibile";
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


insert into Biblioteca values("Biblioteca Universitaria di Bologna", "bub.info@unibo.it","http://www.bub.unibo.it/","Via Zamboni, 33-35 Bologna 40126 BO",44.496888812159334, 11.35242160179635,"Sospensione visite guidate A seguito del DPCM del 14 gennaio 2021, le visite guidate alle sale monumentali della biblioteca sono sospese a tempo indeterminato. Scopri i luoghi e i tesori della Biblioteca Universitaria direttamente a casa tua. Norme sui servizi della BUB a seguito Ord. Reg. n. 25 del 3 marzo 2021 Fino al 21 marzo i servizi bibliotecari sono attivi solo per utenti Unibo e solo su prenotazione. Riduzione orario di apertura al pubblico della BUB Per contrastare ulteriormente la riduzione del contagio da Covid19, da venerdì 13 marzo e per tutta la durata della fascia rossa BUB sarà chiusa al pubblico nei pomeriggi di lunedì, mercoledì e venerdì. Consulta la pagina degli orari per maggiori informazioni. ");
insert into Telefono values("Biblioteca Universitaria di Bologna", "051/2088300"),
("Biblioteca Universitaria di Bologna", "051/2088385");

insert into Biblioteca values("Biblioteca Universitaria di Bologna. Sezione Archivio storico",
"chiara.cocchi@unibo.it","https://archiviostorico.unibo.it/it/biblioteca/biblioteca","Via Zamboni, 33-35 Bologna 40126 BO",44.4970536922416, 11.352913153256157,"ospensione visite guidate A seguito del DPCM del 14 gennaio 2021, le visite guidate alle sale monumentali della biblioteca sono sospese a tempo indeterminato. Scopri i luoghi e i tesori della Biblioteca Universitaria direttamente a casa tua. Norme sui servizi della BUB a seguito Ord. Reg. n. 25 del 3 marzo 2021 Fino al 21 marzo i servizi bibliotecari sono attivi solo per utenti Unibo e solo su prenotazione. Riduzione orario di apertura al pubblico della BUB Per contrastare ulteriormente la riduzione del contagio da Covid19, da venerdì 13 marzo e per tutta la durata della fascia rossa BUB sarà chiusa al pubblico nei pomeriggi di lunedì, mercoledì e venerdì. Consulta la pagina degli orari per maggiori informazioni.");

insert into Telefono values("Biblioteca Universitaria di Bologna. Sezione Archivio storico","051/2088391"),
("Biblioteca Universitaria di Bologna. Sezione Archivio storico","051/2098615");

insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (1, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (2, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (3, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (4, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (5, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (6, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (7, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (8, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (9, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (10, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (11, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (12, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (13, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (14, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (15, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (16, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (17, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (18, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (19, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (20, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (21, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (22, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (23, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (24, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (25, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (26, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (27, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (28, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (29, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (30, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (31, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (32, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (33, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (34, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (35, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (36, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (37, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (38, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (39, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (40, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (41, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (42, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (43, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (44, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (45, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (46, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (47, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (48, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (49, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (50, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (51, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (52, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (53, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (54, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (55, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (56, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (57, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (58, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (59, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (60, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (61, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (62, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (63, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (64, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (65, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (66, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (67, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (68, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (69, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (70, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (71, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (72, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (73, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (74, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (75, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (76, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (77, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (78, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (79, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (80, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (81, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (82, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (83, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (84, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (85, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (86, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (87, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (88, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (89, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (90, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (91, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (92, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (93, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (94, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (95, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (96, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (97, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (98, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (99, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (100, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (101, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (102, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (103, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (104, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (105, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (106, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (107, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (108, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (109, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (110, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (111, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (112, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (113, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (114, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (115, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (116, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (117, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (118, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (119, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (120, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (121, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (122, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (123, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (124, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (125, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (126, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (127, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (128, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (129, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (130, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (131, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (132, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (133, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (134, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (135, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (136, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (137, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (138, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (139, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (140, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (141, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (142, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (143, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (144, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (145, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (146, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (147, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (148, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (149, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (150, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (151, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (152, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (153, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (154, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (155, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (156, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (157, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (158, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (159, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (160, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (161, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (162, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (163, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (164, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (165, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (166, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (167, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (168, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (169, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (170, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (171, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (172, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (173, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (174, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (175, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (176, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (177, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (178, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (179, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (180, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (181, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (182, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (183, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (184, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (185, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (186, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (187, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (188, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (189, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (190, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (191, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (192, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (193, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (194, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (195, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (196, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (197, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (198, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (199, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (200, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (201, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (202, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (203, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (204, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (205, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (206, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (207, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (208, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (209, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (210, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (211, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (212, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (213, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (214, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (215, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (216, 'Biblioteca Universitaria di Bologna', true, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (217, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (218, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (219, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (220, 'Biblioteca Universitaria di Bologna', false, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (221, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (222, 'Biblioteca Universitaria di Bologna', false, false);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (223, 'Biblioteca Universitaria di Bologna', true, true);
insert into Posto_Lettura (Numero, Biblioteca, ReteEthernet, PresaCorrente) values (224, 'Biblioteca Universitaria di Bologna', true, true);

