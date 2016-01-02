--get avarage star number
CREATE OR REPLACE FUNCTION Biblioteka.avg_star() RETURNS NUMERIC AS '
	SELECT avg(kom.Ilosc_gwiazdek) 
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Komentarz AS kom 
	WHERE k.Ksiazka_ID = kom.Ksiazka;
' LANGUAGE sql;

--get entire debet for user
CREATE OR REPLACE FUNCTION Biblioteka.get_debet() RETURNS NUMERIC(10, 2) AS '
	SELECT sum(n.Wartosc) 
	FROM Biblioteka.Uzytkownik AS u, Biblioteka.Naleznosc AS n 
	WHERE n.Naleznosc_ID = u.Uzytkownik_ID;
' LANGUAGE sql;

--search books by title, autor first and last name
CREATE OR REPLACE FUNCTION Biblioteka.search_books(TEXT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 NUMERIC) AS '
	SELECT k.Ksiazka_ID, k.Tytul, av.Url, Biblioteka.avg_star() 
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Avatar AS av, Biblioteka.Ksiazka_Autor AS ka, Biblioteka.Autor AS a 
	WHERE k.Wypozyczona = false 
		AND av.Avatar_ID = k.Avatar 
		AND ka.Ksiazka = k.Ksiazka_ID 
		AND ka.Autor = a.Autor_ID 
		AND (k.Tytul LIKE $1 || ''%''  OR a.Imie LIKE $1 || ''%'' OR a.Nazwisko LIKE $1 || ''%'') 
	ORDER BY k.Tytul;
' LANGUAGE sql;

--get detail information about selected book
CREATE OR REPLACE FUNCTION Biblioteka.detail_book(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 TEXT, f5 TEXT, f6 TEXT, f7 NUMERIC, f8 TEXT, f9 TEXT, f10 TEXT) AS '
	SELECT k.Ksiazka_ID, k.Tytul, k.Rok_wydania, k.isbn, av.Url, wy.Nazwa, Biblioteka.avg_star(), a.Imie, a.Nazwisko, rp.Nazwa
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Avatar AS av, Biblioteka.Wydawnictwo AS wy, Biblioteka.Ksiazka_Autor AS ka, Biblioteka.Autor AS a, Biblioteka.Rodzaj_powiazania as rp 
	WHERE k.Ksiazka_ID = $1
		AND av.Avatar_ID = k.Avatar 
		AND ka.Ksiazka = k.Ksiazka_ID 
		AND ka.Autor = a.Autor_ID 
		AND wy.Wydawnictwo_ID = k.Wydawnictwo 
		AND ka.Rodzaj_powiazania = rp.Rodzaj_powiazania_ID;
' LANGUAGE sql; 

--get all books by author
CREATE OR REPLACE FUNCTION Biblioteka.books_by_author(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 TEXT, f5 NUMERIC) AS '
	SELECT k.Ksiazka_ID, k.Tytul, av.Url, rp.Nazwa, Biblioteka.avg_star() 
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Avatar AS av, Biblioteka.Ksiazka_Autor AS ka, Biblioteka.Autor AS a, Biblioteka.Rodzaj_powiazania as rp 
	WHERE a.Autor_ID = $1 
		AND av.Avatar_ID = k.Avatar 
		AND ka.Ksiazka = k.Ksiazka_ID 
		AND ka.Autor = a.Autor_ID 
		AND ka.Rodzaj_powiazania = rp.Rodzaj_powiazania_ID 
	ORDER BY k.Tytul;
' LANGUAGE sql;

--get all books by wydawnictwo
CREATE OR REPLACE FUNCTION Biblioteka.books_by_wydawnictwo(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 NUMERIC) AS '
	SELECT k.Ksiazka_ID, k.Tytul, av.Url, Biblioteka.avg_star() 
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Avatar AS av, Wydawnictwo AS wy 
	WHERE wy.Wydawnictwo_ID = $1 
		AND av.Avatar_ID = k.Avatar 
		AND wy.Wydawnictwo_ID = k.Wydawnictwo 
	ORDER BY k.Tytul;
' LANGUAGE sql;

--get all comments on selected book
CREATE OR REPLACE FUNCTION Biblioteka.comments_by_book(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT,f4 TEXT, f5 TEXT, f6 TIMESTAMP, f7 INT, f8 TEXT) AS '
	SELECT kom.Komentarz_ID, u.Imie, u.Nazwisko, k.Tytul, kom.Tekst, kom.Data, kom.Ilosc_gwiazdek, av.Url 
	FROM Biblioteka.Komentarz AS kom, Biblioteka.Ksiazka AS k, Biblioteka.Uzytkownik AS u, Biblioteka.Avatar AS av 
	WHERE k.Ksiazka_ID = $1 
		AND k.Ksiazka_ID = kom.Ksiazka 
		AND u.Uzytkownik_ID = kom.Urzytkownik 
		AND u.Uzytkownik_ID = av.Avatar_ID 
	ORDER BY kom.Data DESC;
' LANGUAGE sql;

--get all comments by selected user
CREATE OR REPLACE FUNCTION Biblioteka.comments_by_user(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 TIMESTAMP, f5 INT) AS '
	SELECT kom.Komentarz_ID, k.Tytul, kom.Tekst, kom.Data, kom.Ilosc_gwiazdek  
	FROM Biblioteka.Komentarz AS kom, Biblioteka.Ksiazka AS k, Biblioteka.Uzytkownik AS u 
	WHERE u.Uzytkownik_ID = $1 
		AND k.Ksiazka_ID = kom.Ksiazka 
		AND u.Uzytkownik_ID = kom.Urzytkownik  
	ORDER BY kom.Data DESC;
' LANGUAGE sql;

--get user detail information
CREATE OR REPLACE FUNCTION Biblioteka.user_detail(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 TEXT, f5 TEXT, f6 TEXT, f7 INT, f8 INT, f9 TEXT, f10 TEXT, f11 TEXT, f12 TEXT, f13 TEXT, f14 TEXT, f15 BOOLEAN, f16 NUMERIC) AS '
	SELECT u.Uzytkownik_ID, u.Email, u.Nazwisko, u.Imie, av.Url, ad.Ulica, ad.Numer_domu, ad.Numer_mieszkania, p.Kod_pocztowy, p.Miejscowosc, p.Kraj, 
		ty.Nazwa, u.Telefon_komorkowy, u.Telefon_stacjonarny, u.Aktywny, Biblioteka.get_debet() 
	FROM Biblioteka.Uzytkownik AS u, Biblioteka.Avatar AS av, Biblioteka.Adres AS ad, Biblioteka.Poczta AS p, Biblioteka.Rodzaj_uzytkownika AS ty 
	WHERE u.Uzytkownik_ID = $1 
		AND u.Typ = ty.Rodzaj_uzytkownika_ID 
		AND u.Adres = ad.Adres_ID 
		AND u.Avatar = av.Avatar_ID 
		AND ad.Kod_pocztowy = p.Poczta_ID
' LANGUAGE sql;

--get all boos by user
CREATE OR REPLACE FUNCTION Biblioteka.books_by_user(INT) RETURNS TABLE(f1 INT, f2 TEXT, f3 TEXT, f4 TEXT, f5 TEXT, f6 TEXT, f7 NUMERIC, f8 TEXT, f9 TEXT, f10 TEXT) AS '
	SELECT Biblioteka.detail_book(k.Ksiazka_ID)
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Uzytkownik AS u, Biblioteka.Wypozyczona_ksiazka AS wk 
	WHERE u.Uzytkownik_ID = $1 
		AND wk.Uzytkownik = u.Uzytkownik_ID 
		AND wk.Ksiazka = k.Ksiazka_ID
	ORDER BY k.Tytul;
' LANGUAGE sql;

CREATE OR REPLACE FUNCTION Biblioteka.debet_by_user(INT) RETURNS TABLE(f1 INT, f2 INT, f3 TEXT, f4 TEXT, f5 NUMERIC(10, 2)) AS '
	SELECT n.Naleznosc_ID, k.Ksiazka_ID, k.Tytul, n.Opis, n.Wartosc 
	FROM Biblioteka.Uzytkownik AS u, Biblioteka.Ksiazka AS k, Biblioteka.Naleznosc AS n 
	WHERE u.Uzytkownik_ID = $1 
		AND u.Uzytkownik_ID = n.Uzytkownik  
		OR k.Ksiazka_ID = n.Ksiazka 
	ORDER BY n.Wartosc DESC;
' LANGUAGE sql;