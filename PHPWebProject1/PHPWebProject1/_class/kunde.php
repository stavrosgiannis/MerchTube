<?php

class Anwender
{
	public $id_anwender = -1;
	public $anwendername = "";
	public $passwort = "";
	public $salt = "";
	public $nachname = "";
	public $vorname = "";
	public $email = "";
    public $login = 0;
    public $telefon = "";
    public $frage1 = "";
    public $frage2 = "";
    public $frage3 = "";
	public $rechnungsanschriftliste = null;
	public $lieferanschriftliste = null;

	function __construct()
	{
		$this->rechnungsanschriftliste = array();
		$this->lieferanschriftliste = array();
	}
}

class Geschaeftsanwender extends Anwender
{
	public $id_geschaeftsanwender = -1;
	public $firmenname = "";
	public $umstid = "";
}

class Adresse
{
	public $id_adresse = -1;
	public $strasse = "";
	public $hausnummer = "";
	public $plz = "";
	public $ort = "";
	public $land = "";
	public $typ = "R";
}

class Profilbild
{
	public $id_profilbild = -1;
	public $dateiname = "";
}

?>