<?php

<<<<<<< HEAD
class Kunde
{
	public $id_kunde = -1;
	public $kundenname = "";
=======
class Anwender
{
	public $id_anwender = -1;
	public $anwendername = "";
>>>>>>> origin/Marius
	public $passwort = "";
	public $salt = "";
	public $nachname = "";
	public $vorname = "";
	public $email = "";
	public $rechnungsanschriftliste = null;
	public $lieferanschriftliste = null;

	function __construct()
	{
		$this->rechnungsanschriftliste = array();
		$this->lieferanschriftliste = array();
	}
}

<<<<<<< HEAD
class Geschaeftskunde extends Kunde
{
	public $id_geschaeftskunde = -1;
=======
class Geschaeftsanwender extends Anwender
{
	public $id_geschaeftsanwender = -1;
>>>>>>> origin/Marius
	public $firmenname = "";
	public $umstid = "";
}

<<<<<<< HEAD
class Anschrift
{
	public $id_anschrift = -1;
	public $strasse = "";
	public $hausnummer = "";
	public $plz = "";
	public $stadt = "";
=======
class Adresse
{
	public $id_adresse = -1;
	public $strasse = "";
	public $hausnummer = "";
	public $plz = "";
	public $ort = "";
	public $land = "";
	public $typ = "R";
>>>>>>> origin/Marius
}

class Profilbild
{
	public $id_profilbild = -1;
<<<<<<< HEAD
	public $pfad = "";
=======
>>>>>>> origin/Marius
	public $dateiname = "";
}

?>