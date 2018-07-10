<?php

class Artikel
{
	public $id_artikel = -1;
	public $artikelnummer = "";
	public $marke = "";
	public $modell = "";
	public $beschreibung = "";
	public $preis = "";
	public $bilddatei = "";
	public $kategorie = "";

}

class Farbe extends Artikel
{
public $artikelnummer ="";
public $farbe ="";
}

class Groesse_orbjekt extends Artikel
{
public $artikelnummer ="";
public $groesse ="";
}

class Groesse_kleidung extends Artikel
{
public $artikelnummer ="";
public $groesse ="";
}
?>