--tworzenie schematu
CREATE SCHEMA Biblioteka;

--tworzenie tabel
CREATE TABLE Biblioteka.Uzytkownik (
	Uzytkownik_ID serial NOT NULL,
	Email email NOT NULL,
	Hasło TEXT NOT NULL,
	Nazwisko TEXT(255) NOT NULL,
	Imie TEXT(255) NOT NULL,
	Avatar int,
	Adres int NOT NULL,
	Pwd_Seed TEXT NOT NULL,
	Typ int NOT NULL,
	Telefon_komorkowy phoneNumber,
	Telefon_stacjonarny phoneNumber,
	CONSTRAINT Uzytkownik_pk PRIMARY KEY (Uzytkownik_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Ksiazka (
	Ksiazka_ID serial NOT NULL,
	Tytuł TEXT NOT NULL,
	Rok_wydania year NOT NULL,
	ISBN isbn,
	Avatar int NOT NULL,
	Wydawnictwo int NOT NULL,
	Liczba_egzemplarzy int NOT NULL CHECK (Liczba_egzemplarzy >= 0) DEFAULT 0,
	Wypozyczona BOOLEAN NOT NULL DEFAULT FALSE,
	CONSTRAINT Ksiazka_pk PRIMARY KEY (Ksiazka_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Adres (
	Adres_ID serial NOT NULL,
	Kraj TEXT(255) NOT NULL DEFAULT 'Polska',
	Kod_pocztowy TEXT(20) NOT NULL,
	Ulica TEXT(255),
	Numer_domu int NOT NULL CHECK (Numer_domu > 0),
	Numer_mieszkania int CHECK (Numer_mieszkania > 0),
	CONSTRAINT Adres_pk PRIMARY KEY (Adres_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Autor (
	Autor_ID serial NOT NULL,
	Imie TEXT(255) NOT NULL,
	Nazwisko TEXT(255) NOT NULL,
	Kraj_pochodzenia TEXT(255),
	CONSTRAINT Autor_pk PRIMARY KEY (Autor_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Nalezkosc (
	Nalezkosc_ID serial NOT NULL,
	Uzytkownik int NOT NULL,
	Opis TEXT(80) NOT NULL,
	Wartosc numeric(10,2) NOT NULL CHECK (Wartosc > 0),
	CONSTRAINT Nalezkosc_pk PRIMARY KEY (Nalezkosc_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Wypozyczona_ksiazka (
	Wypozyczona_ksiazka_ID serial NOT NULL,
	Uzytkownik int NOT NULL,
	Ksiazka int NOT NULL,
	Data_wypozyczenia DATE NOT NULL,
	Data_oddania DATE NOT NULL,
	CONSTRAINT Wypozyczona_ksiazka_pk PRIMARY KEY (Wypozyczona_ksiazka_ID,Uzytkownik,Ksiazka),
	CONSTRAINT Poprawne_daty CHECK (Data_wypozyczenia <= Data_oddania)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Wydawnictwo (
	Wydawnictwo_ID serial NOT NULL,
	Nazwa TEXT(255) NOT NULL,
	Kraj_pochodzenia TEXT(255) DEFAULT 'Polska',
	CONSTRAINT Wydawnictwo_pk PRIMARY KEY (Wydawnictwo_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Avatar (
	Avatar_ID serial NOT NULL,
	Url url NOT NULL,
	Opis TEXT(80),
	CONSTRAINT Avatar_pk PRIMARY KEY (Avatar_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Ksiazka_Autor (
	Ksiazka_Autor_ID serial NOT NULL,
	Ksiazka int NOT NULL,
	Autor int NOT NULL,
	Rodzaj_powiazania int NOT NULL,
	CONSTRAINT Ksiazka_Autor_pk PRIMARY KEY (Ksiazka_Autor_ID,Ksiazka,Autor)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Poczta (
	Kod_pocztowy TEXT(20) NOT NULL,
	Miejscowosc TEXT(255) NOT NULL,
	CONSTRAINT Poczta_pk PRIMARY KEY (Kod_pocztowy)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Rodzaj_powiazania (
	Rodzaj_powiazania_ID serial NOT NULL,
	Nazwa TEXT(80) NOT NULL,
	CONSTRAINT Rodzaj_powiazania_pk PRIMARY KEY (Rodzaj_powiazania_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Komentarz (
	Komentarz_ID serial NOT NULL,
	Urzytkownik int NOT NULL,
	Ksiazka int NOT NULL,
	Tekst TEXT(255) NOT NULL,
	Data DATE NOT NULL,
	Ilosc_gwiazdek star NOT NULL DEFAULT 0,
	CONSTRAINT Komentarz_pk PRIMARY KEY (Komentarz_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Wiadomosc (
	Wiadomosc_ID serial NOT NULL,
	Adresat int NOT NULL,
	Odbiorca int NOT NULL,
	Tekst TEXT NOT NULL,
	Data DATE NOT NULL,
	CONSTRAINT Wiadomosc_pk PRIMARY KEY (Wiadomosc_ID)
) WITH (
  OIDS=FALSE
);



CREATE TABLE Biblioteka.Rodzaj_uzytkownika (
	Rodzaj_uzytkownika_ID serial NOT NULL,
	Nazwa TEXT NOT NULL,
	CONSTRAINT Rodzaj_uzytkownika_pk PRIMARY KEY (Rodzaj_uzytkownika_ID)
) WITH (
  OIDS=FALSE
);


--tworzenie relacji
ALTER TABLE Biblioteka.Uzytkownik ADD CONSTRAINT Uzytkownik_fk0 FOREIGN KEY (Avatar) REFERENCES Biblioteka.Avatar(Avatar_ID);
ALTER TABLE Biblioteka.Uzytkownik ADD CONSTRAINT Uzytkownik_fk1 FOREIGN KEY (Adres) REFERENCES Biblioteka.Adres(Adres_ID);
ALTER TABLE Biblioteka.Uzytkownik ADD CONSTRAINT Uzytkownik_fk2 FOREIGN KEY (Typ) REFERENCES Biblioteka.Rodzaj_uzytkownika(Rodzaj_uzytkownika_ID);

ALTER TABLE Biblioteka.Ksiazka ADD CONSTRAINT Ksiazka_fk0 FOREIGN KEY (Avatar) REFERENCES Biblioteka.Avatar(Avatar_ID);
ALTER TABLE Biblioteka.Ksiazka ADD CONSTRAINT Ksiazka_fk1 FOREIGN KEY (Wydawnictwo) REFERENCES Biblioteka.Wydawnictwo(Wydawnictwo_ID);

ALTER TABLE Biblioteka.Adres ADD CONSTRAINT Adres_fk0 FOREIGN KEY (Kod_pocztowy) REFERENCES Biblioteka.Poczta(Kod_pocztowy);


ALTER TABLE Biblioteka.Nalezkosc ADD CONSTRAINT Nalezkosc_fk0 FOREIGN KEY (Uzytkownik) REFERENCES Biblioteka.Uzytkownik(Uzytkownik_ID);

ALTER TABLE Biblioteka.Wypozyczona_ksiazka ADD CONSTRAINT Wypozyczona_ksiazka_fk0 FOREIGN KEY (Uzytkownik) REFERENCES Biblioteka.Uzytkownik(Uzytkownik_ID);
ALTER TABLE Biblioteka.Wypozyczona_ksiazka ADD CONSTRAINT Wypozyczona_ksiazka_fk1 FOREIGN KEY (Ksiazka) REFERENCES Biblioteka.Ksiazka(Ksiazka_ID);



ALTER TABLE Biblioteka.Ksiazka_Autor ADD CONSTRAINT Ksiazka_Autor_fk0 FOREIGN KEY (Ksiazka) REFERENCES Biblioteka.Ksiazka(Ksiazka_ID);
ALTER TABLE Biblioteka.Ksiazka_Autor ADD CONSTRAINT Ksiazka_Autor_fk1 FOREIGN KEY (Autor) REFERENCES Biblioteka.Autor(Autor_ID);
ALTER TABLE Biblioteka.Ksiazka_Autor ADD CONSTRAINT Ksiazka_Autor_fk2 FOREIGN KEY (Rodzaj_powiazania) REFERENCES Biblioteka.Rodzaj_powiazania(Rodzaj_powiazania_ID);



ALTER TABLE Biblioteka.Komentarz ADD CONSTRAINT Komentarz_fk0 FOREIGN KEY (Urzytkownik) REFERENCES Biblioteka.Uzytkownik(Uzytkownik_ID);
ALTER TABLE Biblioteka.Komentarz ADD CONSTRAINT Komentarz_fk1 FOREIGN KEY (Ksiazka) REFERENCES Biblioteka.Ksiazka(Ksiazka_ID);

ALTER TABLE Biblioteka.Wiadomosc ADD CONSTRAINT Wiadomosc_fk0 FOREIGN KEY (Adresat) REFERENCES Biblioteka.Uzytkownik(Uzytkownik_ID);
ALTER TABLE Biblioteka.Wiadomosc ADD CONSTRAINT Wiadomosc_fk1 FOREIGN KEY (Odbiorca) REFERENCES Biblioteka.Uzytkownik(Uzytkownik_ID);


