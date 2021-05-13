
drop procedure if exists createUtilizzatore;
delimiter \ 
create procedure createUtilizzatore(Email varchar(255), Password varchar(255), Nome varchar(255), Cognome varchar(255), DataNascita Date,  LuogoNascita varchar(255), Telefono varchar(15), Professione varchar(255))
begin 
	INSERT into utilizzatore values(Email,Password,Nome,Cognome,DataNascita, LuogoNascita,Telefono,now(),Professione,'Attivo');
end \
delimiter ; 


drop procedure if exists getUtilByMail;
delimiter \ 
create procedure getUtilByMail(EmailUtil varchar(255))
begin 
	SELECT * FROM Utilizzatore WHERE email = EmailUtil;
end \
delimiter ; 


drop procedure if exists checkEsisAdmin;
delimiter \ 
create procedure checkEsisAdmin(EmailUtil varchar(255))
begin 
	SELECT * from utilizzatore WHERE LOWER(Email) LIKE CONCAT('%',LOWER(EmailUtil),'%') or  LOWER(nome) LIKE CONCAT('%',LOWER(EmailUtil),'%') or LOWER(cognome) LIKE CONCAT('%',LOWER(EmailUtil),'%');
end \
delimiter ; 


drop procedure if exists getAmmi;
delimiter \ 
create procedure getAmmi(EmailAmmi varchar(255))
begin 
	SELECT * from Amministratore where email = EmailAmmi;
end \
delimiter ; 


drop procedure if exists getAllAmmi;
delimiter \ 
create procedure getAllAmmi()
begin 
	SELECT * FROM Amministratore;
end \
delimiter ; 


drop procedure if exists getAllBiblio;
delimiter \ 
create procedure getAllBiblio()
begin 
	SELECT * FROM Biblioteca;
end \
delimiter ; 