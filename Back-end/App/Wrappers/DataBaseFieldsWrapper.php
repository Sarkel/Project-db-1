<?php

/**
 * Created by PhpStorm.
 * User: sebas
 * Date: 25.12.2015
 * Time: 22:25
 */

namespace App\Wrappers;
class DataBaseFieldsWrapper
{
    public $tableName;
    public $tableFields;

    private function __construct($tableName, $tableFields){
        $this->tableName = $tableName;
        $this->tableFields = $tableFields;
    }

    public static function getDateBaseProperties($tableAlias){
        $tableName = DataBaseFieldsWrapper::$tables[$tableAlias];
        $tableFields = DataBaseFieldsWrapper::getTabelsFieldsNames()[$tableName];

        return new DataBaseFieldsWrapper($tableName, $tableFields);
    }

    private static function getTabelsFieldsNames(){
        return [
            'Biblioteka.Adres' => DataBaseFieldsWrapper::$adres,
            'Biblioteka.Poczta' => DataBaseFieldsWrapper::$poczta,
            'Biblioteka.Wiadomosc' => DataBaseFieldsWrapper::$wiadomosc,
            'Biblioteka.Uzytkownik' => DataBaseFieldsWrapper::$uzytkownik,
            'Biblioteka.Naleznosc' => DataBaseFieldsWrapper::$naleznosc,
            'Biblioteka.Rodzaj_uzytkownika' => DataBaseFieldsWrapper::$rodzajUzytkownika,
            'Biblioteka.Komentarz' => DataBaseFieldsWrapper::$komentarz,
            'Biblioteka.Avatar' => DataBaseFieldsWrapper::$avatar,
            'Biblioteka.Wypozyczona_ksiazka' => DataBaseFieldsWrapper::$wypozyczonaKsiazka,
            'Biblioteka.Ksiazka' => DataBaseFieldsWrapper::$ksiazka,
            'Biblioteka.Ksiazka_Autor' => DataBaseFieldsWrapper::$ksiazkaAutor,
            'Biblioteka.Wydawnictwo' => DataBaseFieldsWrapper::$wydawnictwo,
            'Biblioteka.Autor' => DataBaseFieldsWrapper::$autor,
            'Biblioteka.Rodzaj_powiazania' => DataBaseFieldsWrapper::$rodzajPowiazania
        ];
    }
    private static $tables = [
        'adres' => 'Biblioteka.Adres',
        'autor' => 'Biblioteka.Autor',
        'avatar' => 'Biblioteka.Avatar',
        'komentarz' => 'Biblioteka.Komentarz',
        'ksiazkaAutor' => 'Biblioteka.Ksiazka_Autor',
        'ksiazka' => 'Biblioteka.Ksiazka',
        'naleznosc' => 'Biblioteka.Naleznosc',
        'poczta' => 'Biblioteka.Poczta',
        'rodzajPowiazania' => 'Biblioteka.Rodzaj_powiazania',
        'rodzajUzytkownika' => 'Biblioteka.Rodzaj_uzytkownika',
        'uzytkownik' => 'Biblioteka.Uzytkownik',
        'wiadomosc' => 'Biblioteka.Wiadomosc',
        'wydawnictwo' => 'Biblioteka.Wydawnictwo',
        'wypozyczonaKsiazka' => 'Biblioteka.Wypozyczona_ksiazka'
    ];
    private static $adres = [
        'id' => 'Adres_ID',
        'kodPocztowy' => 'Kod_pocztowy',
        'ulica' => 'Ulica',
        'numerDomu' => 'Numer_domu',
        'numerMieszkania' => 'Numer_mieszkania'
    ];

    private static $autor = [
        'id' => 'Autor_ID',
        'imie' => 'Imie',
        'nazwisko' => 'Nazwisko',
        'krajPochodzenia' => 'Kraj_pochodzenia'
    ];

    private static $avatar = [
        'id' => 'Avatar_ID',
        'uri' => 'Url',
        'opis' => 'Opis'
    ];

    private static $komentarz = [
        'id' => 'Komentarz_ID',
        'uzytkownik' => 'Urzytkownik',
        'ksiazka' => 'Ksiazka',
        'tekst' => 'Tekst',
        'data' => 'Data',
        'iloscGwizdek' => 'Ilosc_gwiazdek'
    ];

    private static $ksiazkaAutor = [
        'ksiazka' => 'Ksiazka',
        'autor' => 'Autor',
        'rodzajPowiazania' => 'Rodzaj_powiazania'
    ];

    private static $ksiazka = [
        'id' => 'Ksiazka_ID',
        'tytul' => 'Tytu³',
        'rokWydania' => 'Rok_wydania',
        'isbn' => 'ISBN',
        'avatar' => 'Avatar',
        'wydawnictwo' => 'Wydawnictwo',
        'wypozyczona' => 'Wypozyczona'
    ];

    private static $naleznosc = [
        'id' => 'Nalezkosc_ID',
        'uzytkownikWypKsiaz' => 'Uzytkownik_wyp_ksia',
        'ksiazkaWypKsiaz' => 'Ksiazka_wyp_ksia',
        'uzytkownik' => 'Uzytkownik',
        'opis' => 'Opis',
        'wartosc' => 'Wartosc'
    ];

    private static $poczta = [
        'id' => 'Poczta_ID',
        'kodPocztowy' => 'Kod_pocztowy',
        'miejscowosc' => 'Miejscowosc',
        'kraj' => 'Kraj'
    ];

    private static $rodzajPowiazania = [
        'id' => 'Rodzaj_powiazania_ID',
        'nazwa' => 'Nazwa'
    ];

    private static $rodzajUzytkownika = [
        'id' => 'rodzaj_uzytkownika_id',
        'nazwa' => 'nazwa'
    ];

    private static $uzytkownik = [
        'id' => 'Uzytkownik_ID',
        'email' => 'Email',
        'pwd' => 'Has³o',
        'nazwisko' => 'Nazwisko',
        'imie' => 'Imie',
        'avatar' => 'Avatar',
        'adres' => 'Adres',
        'pwdSeed' => 'Pwd_Seed',
        'typ' => 'Typ',
        'komorka' => 'Telefon_komorkowy',
        'stacjonarny' => 'Telefon_stacjonarny',
        'aktywny' => 'Aktywny'
    ];

    private static $wiadomosc = [
        'id' => 'Wiadomosc_ID',
        'adresat' => 'Adresat',
        'odbiorca' => 'Odbiorca',
        'tekst' => 'Tekst',
        'data' => 'Data'
    ];

    private static $wydawnictwo = [
        'id' => 'Wydawnictwo_ID',
        'nazwa' => 'Nazwa',
        'krajPochodzenia' => 'Kraj_pochodzenia'
    ];

    private static $wypozyczonaKsiazka = [
        'uzytkownik' => 'Uzytkownik',
        'ksiazka' => 'Ksiazka',
        'dataWypozyczenia' => 'Data_wypozyczenia',
        'dataOddania' => 'Data_oddania'
    ];
}