CREATE VIEW Biblioteka.all_books AS 
	SELECT k.Ksiazka_ID, k.Tytul, a.Url, Biblioteka.avg_star(k.Ksiazka_ID) 
	FROM Biblioteka.Ksiazka AS k, Biblioteka.Avatar AS a 
	WHERE k.Wypozyczona = false AND a.Avatar_ID = k.Avatar;

CREATE VIEW Biblioteka.all_users AS 
	SELECT u.Uzytkownik_ID, u.Email, u.Nazwisko, u.Imie, av.Url, ad.Ulica, ad.Numer_domu, ad.Numer_mieszkania, p.Kod_pocztowy, p.Miejscowosc, p.Kraj, 
		ty.Nazwa, u.Telefon_komorkowy, u.Telefon_stacjonarny, u.Aktywny 
	FROM Biblioteka.Uzytkownik AS u, Biblioteka.Avatar AS av, Biblioteka.Adres AS ad, Biblioteka.Poczta AS p, Biblioteka.Rodzaj_uzytkownika AS ty 
	WHERE u.Typ = ty.Rodzaj_uzytkownika_ID 
		AND u.Adres = ad.Adres_ID 
		AND u.Avatar = av.Avatar_ID 
		AND ad.Kod_pocztowy = p.Poczta_ID
	ORDER BY u.Nazwisko;