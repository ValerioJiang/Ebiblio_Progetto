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
 
 
