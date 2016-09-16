drop database a11gusli;
create database a11gusli;
use a11gusli;


CREATE table Vapen(
IDnr int(11) NOT NULL auto_increment,
Tillverkat char(10),
Farlighetstyp varchar(20),
Inkopsplats varchar(20),
Vapentyp varchar(20),

PRIMARY KEY (IDnr)
) ENGINE=INNODB;






CREATE TABLE Alien(
IDkod char(25),
pnr char(10),
Anamn varchar(15),
Planet varchar(20),
Ras varchar(10),
Kannetecken varchar(15),
Farlighetsgrad varchar(15),
CHECK   (pnr LIKE '[0-9][0-9][0-9][0-9][0-9][0-9]-[0-9][0-9][0-9][0-9]'),
PRIMARY KEY(IDkod,pnr)

)
ENGINE=INNODB;




CREATE TABLE Skepp(
SkeppID char(13),
Kannetecken varchar(20),
Sittplatser char(10),
Tillverkat varchar(20),

PRIMARY KEY (SkeppID)

)
ENGINE = INNODB;



CREATE TABLE Agentvapen(
Namn char (25),
Nr char (10),
Beskrivning varchar (20),
Primary key (Namn,Nr)
)ENGINE = INNODB;




CREATE TABLE Faltagent(
ID int(11) NOT NULL auto_increment,
Fnamn varchar(20),
Fnr char(5) ,
Kompetens varchar(30),
Specialitet varchar (30),
Antaloperationer int  NOT NULL,
Lyckadeoperationer int NOT NULL,
Lon INT,
Ursprungsnamn varchar(20),


Primary key(ID),
Key(Fnamn,Fnr)

) Engine = INNODB;



CREATE TABLE Gruppledare(
Gnamn varchar(20) ,
Gnr char(5),
Aoperationer int,
Loperationer int,
Lon INT,
Ursprungsnamn varchar(20),


Primary key (Gnamn,Gnr)
)
 Engine=INNODB;



CREATE TABLE Handledare(
Hnamn varchar (20),
Hnr char(5),
Incident int,
Observationer int,
Operationer int,
Lon INT,
Ursprungsnamn varchar(20),

Primary key(Hnamn,Hnr)

)Engine=INNODB;



CREATE TABLE Desinformation(
Dnamn varchar(20),
Dnr char (5),
Specialiter varchar (20),
Antalkampanjer int,
Lon INT,
Ursprungsnamn varchar(20),


Primary key (Dnamn,Dnr)

)Engine=INNODB;



CREATE TABLE Items(
ANamn varchar(20),
ANr char (5),
INamn char (25),
INr char (10),

Foreign Key (ANamn,ANr) REFERENCES Faltagent(Fnamn,Fnr),
Foreign Key (INamn,INr) REFERENCES Agentvapen(Namn,Nr),
PRIMARY KEY (ANamn,ANr,INamn,INr)
)ENGINE = INNODB;



CREATE INDEX ALIEN on Alien(IDkod ASC) USING BTREE;

CREATE INDEX VAPEN on Vapen(IDnr ASC) USING BTREE;

CREATE INDEX SKEPP on Skepp(SkeppID ASC) USING BTREE;


CREATE TABLE Vapenlogg(
IDnr int(11) NOT NULL auto_increment,
Tillverkat char(10),
Farlighetstyp varchar(20),
Inkopsplats varchar(20),
Vapentyp varchar(20),

PRIMARY KEY (IDnr)
) ;


   DELIMITER //                                                                                                                                          
                                                                                                                                                         
   CREATE PROCEDURE GETVapenid(id varchar(30))                                                                                                                         
   BEGIN                                                                                                                                                 
       Insert into Vapenlogg(Tillverkat,Farlighetstyp,Inkopsplats,Vapentyp) Values (id,NOW());
SELECT IDnr
from Vapen
where IDnr=id;                                                                                                                
   END;                                                                                                                                                  
   //                                                                                                                                                    
                                                                                                                                                        
  DELIMITER ;                                                                                                                                           
                                                                                                                                                        
 -- Execute procedure                                                                                                                                  


DELIMITER //

CREATE TRIGGER LOGGTRIGGER after insert on Vapen

FOR EACH ROW BEGIN 

INSERT into Vapenlogg(Tillverkat,Farlighetstyp,Inkopsplats,Vapentyp)  
VALUES (NEW.IDnr,NOW());
END;
//

DELIMITER;



                                                                                                                                                        
   DELIMITER //                                                                                                                                          
                                                                                                                                                         
   CREATE PROCEDURE GETFALT()                                                                                                                         
   BEGIN                                                                                                                                                 
       SELECT * FROM Faltagent;                                                                                                                 
   END;                                                                                                                                                  
   //                                                                                                                                                    
                                                                                                                                                        
  DELIMITER ;                                                                                                                                           
                                                                                                                                                        
 -- Execute procedure                                                                                                                                  
 CALL GETFALT(); 


DELIMITER //
CREATE TRIGGER INPUTCHECK BEFORE INSERT ON Faltagent
FOR EACH ROW begin

IF(NEW.Lon <0) then
UPDATE Faltagent SET Lon_MAY_NOT_BE_ZERO =0;
END IF;
END;
