--wiadomosc
CREATE OR REPLACE FUNCTION Biblioteka.validate_message() RETURNS TRIGGER AS '
	DECLARE
		o timestamp;
		ct timestamp;
	BEGIN
		o := old.Data;
		ct := (SELECT now());
		IF ((TG_OP = ''UPDATE'') AND (ct - o < 300)) THEN
			RAISE NOTICE ''Update is avaliable.'';
			RETURN NEW;
		ELSEIF ((TG_OP = ''DELETE'') AND (ct - o < 300)) THEN
			RAISE NOTICE ''Delete is avaliable.'';
			RETURN OLD;
		ELSE
			RAISE NOTICE ''Record connot be changed.'';
			RETURN NULL;
		END IF;
	END;
' LANGUAGE plpgsql;

CREATE TRIGGER Wiadomosc_trigger BEFORE UPDATE OR DELETE ON Biblioteka.Wiadomosc FOR EACH ROW EXECUTE PROCEDURE Biblioteka.validate_message();



--ksiazka
CREATE OR REPLACE FUNCTION Biblioteka.validate_book() RETURNS TRIGGER AS '
	DECLARE
		bookId integer;
	BEGIN
		bookId := old.Ksiazka_ID;
		IF (TG_OP = ''DELETE'') THEN
			DELETE FROM Biblioteka.Komentarz AS k WHERE k.Ksiazka = bookId;
			DELETE FROM Biblioteka.Ksiazka_Autor AS ka WHERE ka.Ksiazka = bookId;
			RAISE NOTICE ''Relations removed.'';
			RETURN OLD;   
		END IF;
	END;
' LANGUAGE plpgsql;

CREATE TRIGGER Ksiazka_trigger BEFORE DELETE ON Biblioteka.Ksiazka FOR EACH ROW EXECUTE PROCEDURE Biblioteka.validate_book();



--autor
CREATE OR REPLACE FUNCTION Biblioteka.validate_author() RETURNS TRIGGER AS '
	DECLARE
		authorId integer;
	BEGIN
		authorId := old.Autor_ID;
		IF (TG_OP = ''DELETE'') THEN
			DELETE FROM Biblioteka.Ksiazka_Autor AS ka WHERE ka.Autor = authorId;
			RAISE NOTICE ''Relations removed.'';
			RETURN OLD;   
		END IF;
	END;
' LANGUAGE plpgsql;

CREATE TRIGGER Autor_trigger BEFORE DELETE ON Biblioteka.Autor FOR EACH ROW EXECUTE PROCEDURE Biblioteka.validate_author();



--wypozyczona_ksiazka
CREATE OR REPLACE FUNCTION Biblioteka.validate_borrowed_book() RETURNS TRIGGER AS '
	DECLARE
		bookId integer;
	BEGIN
		IF (TG_OP = ''INSERT'') THEN
			bookId := new.Ksiazka;
			UPDATE Biblioteka.Ksiazka AS k SET k.Wypozyczona = TRUE WHERE k.Ksiazka_ID = bookId;
			RAISE NOTICE ''Status changed.'';
			RETURN OLD;  
		ELSEIF (TG_OP = ''DELETE'') THEN
			bookId := old.Ksiazka;
			UPDATE Biblioteka.Ksiazka AS k SET k.Wypozyczona = TRUE WHERE k.Ksiazka_ID = bookId;
			RAISE NOTICE ''Status changed.'';
			RETURN OLD;  
		END IF;
	END;
' LANGUAGE plpgsql;

CREATE TRIGGER Wypozyczona_ksiazka_trigger BEFORE INSERT OR DELETE ON Biblioteka.Wypozyczona_ksiazka FOR EACH ROW EXECUTE PROCEDURE Biblioteka.validate_borrowed_book();


--uzytkownik
CREATE OR REPLACE FUNCTION Biblioteka.vlidate_user() RETURNS TRIGGER AS '
	DECLARE
		oStatus boolean;
		nStatus boolean;
		userId integer;
		postCode integer;
		street varchar(255);
		homeNo integer;
		flatNo integer;
		adressID integer;
	BEGIN
		IF (TG_OP = ''UPDATE'') THEN
			oStatus := old.Aktywny;
			nStatus := new.Aktywny;
			userId := old.Uzytkownik_ID;
			IF (oStatus != nStatus) THEN
				IF (EXISTS (SELECT n.Nalezkosc_ID FROM Biblioteka.Nalezkosc AS n WHERE n.Uzytkownik = userId)) THEN
					RETURN NULL;
				ELSEIF (EXISTS (SELECT * FROM Wypozyczona_ksiazka AS wk WHERE wk.Uzytkownik = userId)) THEN
					RETURN NULL;
				ELSE
					RETURN NEW;
				END IF;
			ELSE
				RETURN NEW;
			END IF;
		ELSEIF (TG_OP = ''INSERT'') THEN

			SELECT at.Kod_pocztowy INTO postCode FROM Biblioteka.Adres_temp AS at;
			SELECT at.Ulica INTO street FROM Biblioteka.Adres_temp AS at;
			SELECT at.Numer_domu INTO homeNo FROM Biblioteka.Adres_temp AS at;
			SELECT at.Numer_mieszkania INTO flatNo FROM Biblioteka.Adres_temp AS at;

			INSERT INTO Biblioteka.Adres (Kod_pocztowy, Ulica, Numer_domu, Numer_mieszkania) VALUES (postCode, street, homeNo, flatNo);
			
			SELECT a.Adres_ID INTO adressID FROM Biblioteka.Adres AS a 
				WHERE a.Kod_pocztowy = postCode AND a.Ulica = street AND a.Numer_domu = homeNo AND a.Numer_mieszkania = flatNo;
			new.Adres := adressID;
			RETURN NEW;
		END IF; 
	END;
' LANGUAGE plpgsql;

CREATE TRIGGER Uzytkownik_trigger BEFORE UPDATE OR INSERT ON Biblioteka.Uzytkownik FOR EACH ROW EXECUTE PROCEDURE Biblioteka.vlidate_user();