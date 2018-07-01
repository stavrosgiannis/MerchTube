<?php

class Kunde
{
	public $id_kunde = -1;
	public $kundenname = "";
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

class Geschaeftskunde extends Kunde
{
	public $id_geschaeftskunde = -1;
	public $firmenname = "";
	public $umstid = "";
}

class Anschrift
{
	public $id_anschrift = -1;
	public $strasse = "";
	public $hausnummer = "";
	public $plz = "";
	public $stadt = "";
}

class Profilbild
{
	public $id_profilbild = -1;
	public $pfad = "";
	public $dateiname = "";
}

?>