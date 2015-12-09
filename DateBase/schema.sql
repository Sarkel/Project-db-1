CREATE TABLE "Uzytkownik" (
	"Uzytkownik_ID" serial NOT NULL,
	"Email" TEXT(255) NOT NULL,
	"Hasło" TEXT NOT NULL,
	"Nazwisko" TEXT(255) NOT NULL,
	"Imie" TEXT(255) NOT NULL,
	"Avatar" int,
	"Adres" int NOT NULL,
	"Kontakt" serial NOT NULL,
	"Pwd_Seed" TEXT NOT NULL,
	"Typ" int NOT NULL,
	"Telefon_komorkowy" TEXT(20),
	"Telefon_stacjonarny" TEXT(20),
	CONSTRAINT Uzytkownik_pk PRIMARY KEY ("Uzytkownik_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Ksiazka" (
	"Ksiazka_ID" serial NOT NULL,
	"Tytuł" TEXT NOT NULL,
	"Rok_wydania" DATE NOT NULL,
	"ISBN" TEXT(20),
	"Avatar" int NOT NULL,
	"Wydawnictwo" int NOT NULL,
	"Liczba_egzemplarzy" int NOT NULL DEFAULT '0',
	"Wypozyczona" BOOLEAN NOT NULL DEFAULT 'false',
	CONSTRAINT Ksiazka_pk PRIMARY KEY ("Ksiazka_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Adres" (
	"Adres_ID" serial NOT NULL,
	"Kraj" TEXT(255) NOT NULL DEFAULT 'Polska',
	"Kod_pocztowy" TEXT(20) NOT NULL,
	"Ulica" TEXT(255),
	"Numer_domu" int NOT NULL,
	"Numer_mieszkania" int,
	CONSTRAINT Adres_pk PRIMARY KEY ("Adres_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Autor" (
	"Autor_ID" serial NOT NULL,
	"Imie" TEXT(255) NOT NULL,
	"Nazwisko" TEXT(255) NOT NULL,
	"Kraj_pochodzenia" TEXT(255),
	CONSTRAINT Autor_pk PRIMARY KEY ("Autor_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Nalezkosc" (
	"Nalezkosc_ID" serial NOT NULL,
	"Uzytkownik" int NOT NULL,
	"Opis" TEXT(80) NOT NULL,
	"Wartosc" numeric(10,2) NOT NULL,
	CONSTRAINT Nalezkosc_pk PRIMARY KEY ("Nalezkosc_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Wypozyczona_ksiazka" (
	"Wypozyczona_ksiazka_ID" serial NOT NULL,
	"Uzytkownik" int NOT NULL,
	"Ksiazka" int NOT NULL,
	"Data_wypozyczenia" DATE NOT NULL,
	"Data_oddania" DATE NOT NULL,
	CONSTRAINT Wypozyczona_ksiazka_pk PRIMARY KEY ("Wypozyczona_ksiazka_ID","Uzytkownik","Ksiazka")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Wydawnictwo" (
	"Wydawnictwo_ID" serial NOT NULL,
	"Nazwa" TEXT(255) NOT NULL,
	"Kraj_pochodzenia" TEXT(255) DEFAULT 'Polska',
	CONSTRAINT Wydawnictwo_pk PRIMARY KEY ("Wydawnictwo_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Avatar" (
	"Avatar_ID" serial NOT NULL,
	"Url" TEXT(255) NOT NULL,
	"Opis" TEXT(80),
	CONSTRAINT Avatar_pk PRIMARY KEY ("Avatar_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Ksiazka-Autor" (
	"Ksiazka_Autor_ID" serial NOT NULL,
	"Ksiazka" int NOT NULL,
	"Autor" int NOT NULL,
	"Rodzaj_powiazania" int NOT NULL,
	CONSTRAINT Ksiazka-Autor_pk PRIMARY KEY ("Ksiazka_Autor_ID","Ksiazka","Autor")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Poczta" (
	"Kod_pocztowy" TEXT(20) NOT NULL,
	"Miejscowosc" TEXT(255) NOT NULL,
	CONSTRAINT Poczta_pk PRIMARY KEY ("Kod_pocztowy")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Rodzaj_powiazania" (
	"Rodzaj_powiazania_ID" serial NOT NULL,
	"Nazwa" TEXT(80) NOT NULL,
	CONSTRAINT Rodzaj_powiazania_pk PRIMARY KEY ("Rodzaj_powiazania_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Komentarz" (
	"Komentarz_ID" serial NOT NULL,
	"Urzytkownik" int NOT NULL,
	"Ksiazka" int NOT NULL,
	"Tekst" TEXT(255) NOT NULL,
	"Data" DATE NOT NULL,
	"Ilosc_gwiazdek" int NOT NULL DEFAULT '0',
	CONSTRAINT Komentarz_pk PRIMARY KEY ("Komentarz_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Wiadomosc" (
	"Wiadomosc_ID" serial NOT NULL,
	"Adresat" int NOT NULL,
	"Odbiorca" int NOT NULL,
	"Tekst" TEXT NOT NULL,
	"Data" DATE NOT NULL,
	CONSTRAINT Wiadomosc_pk PRIMARY KEY ("Wiadomosc_ID")
) WITH (
  OIDS=FALSE
);



CREATE TABLE "Rodzaj_uzytkownika" (
	"Rodzaj_uzytkownika_ID" serial NOT NULL,
	"Nazwa" serial NOT NULL,
	CONSTRAINT Rodzaj_uzytkownika_pk PRIMARY KEY ("Rodzaj_uzytkownika_ID")
) WITH (
  OIDS=FALSE
);



ALTER TABLE "Uzytkownik" ADD CONSTRAINT "Uzytkownik_fk0" FOREIGN KEY (Avatar) REFERENCES Avatar(Avatar_ID);
ALTER TABLE "Uzytkownik" ADD CONSTRAINT "Uzytkownik_fk1" FOREIGN KEY (Adres) REFERENCES Adres(Adres_ID);
ALTER TABLE "Uzytkownik" ADD CONSTRAINT "Uzytkownik_fk2" FOREIGN KEY (Kontakt) REFERENCES Kontakt(Kontakt_ID);
ALTER TABLE "Uzytkownik" ADD CONSTRAINT "Uzytkownik_fk3" FOREIGN KEY (Typ) REFERENCES Rodzaj_uzytkownika(Rodzaj_uzytkownika_ID);

ALTER TABLE "Ksiazka" ADD CONSTRAINT "Ksiazka_fk0" FOREIGN KEY (Avatar) REFERENCES Avatar(Avatar_ID);
ALTER TABLE "Ksiazka" ADD CONSTRAINT "Ksiazka_fk1" FOREIGN KEY (Wydawnictwo) REFERENCES Wydawnictwo(Wydawnictwo_ID);

ALTER TABLE "Adres" ADD CONSTRAINT "Adres_fk0" FOREIGN KEY (Kod_pocztowy) REFERENCES Poczta(Kod_pocztowy);


ALTER TABLE "Nalezkosc" ADD CONSTRAINT "Nalezkosc_fk0" FOREIGN KEY (Uzytkownik) REFERENCES Uzytkownik(Uzytkownik_ID);

ALTER TABLE "Wypozyczona_ksiazka" ADD CONSTRAINT "Wypozyczona_ksiazka_fk0" FOREIGN KEY (Uzytkownik) REFERENCES Uzytkownik(Uzytkownik_ID);
ALTER TABLE "Wypozyczona_ksiazka" ADD CONSTRAINT "Wypozyczona_ksiazka_fk1" FOREIGN KEY (Ksiazka) REFERENCES Ksiazka(Ksiazka_ID);



ALTER TABLE "Ksiazka-Autor" ADD CONSTRAINT "Ksiazka-Autor_fk0" FOREIGN KEY (Ksiazka) REFERENCES Ksiazka(Ksiazka_ID);
ALTER TABLE "Ksiazka-Autor" ADD CONSTRAINT "Ksiazka-Autor_fk1" FOREIGN KEY (Autor) REFERENCES Autor(Autor_ID);
ALTER TABLE "Ksiazka-Autor" ADD CONSTRAINT "Ksiazka-Autor_fk2" FOREIGN KEY (Rodzaj_powiazania) REFERENCES Rodzaj_powiazania(Rodzaj_powiazania_ID);



ALTER TABLE "Komentarz" ADD CONSTRAINT "Komentarz_fk0" FOREIGN KEY (Urzytkownik) REFERENCES Uzytkownik(Uzytkownik_ID);
ALTER TABLE "Komentarz" ADD CONSTRAINT "Komentarz_fk1" FOREIGN KEY (Ksiazka) REFERENCES Ksiazka(Ksiazka_ID);

ALTER TABLE "Wiadomosc" ADD CONSTRAINT "Wiadomosc_fk0" FOREIGN KEY (Adresat) REFERENCES Uzytkownik(Uzytkownik_ID);
ALTER TABLE "Wiadomosc" ADD CONSTRAINT "Wiadomosc_fk1" FOREIGN KEY (Odbiorca) REFERENCES Uzytkownik(Uzytkownik_ID);


