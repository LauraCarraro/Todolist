<?php

class Task
{
    private $id;
    private $nomTache;
    private $descriptionTache;
    private $dateTache;
    private $priorite;
    private $categorie;

    public function __construct($id, $nomTache, $descriptionTache, $dateTache, $priorite, $categorie)
    {
        $this->id = $id;
        $this->nomTache = $nomTache;
        $this->descriptionTache = $descriptionTache;
        $this->dateTache = $dateTache;
        $this->priorite = $priorite;
        $this->categorie = $categorie;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getnomTache()
    {
        return $this->nomTache;
    }

    public function setnomTache($nomTache)
    {
        $this->nomTache = $nomTache;
    }

    public function getdescriptionTache()
    {
        return $this->descriptionTache;
    }

    public function setdescriptionTache($descriptionTache)
    {
        $this->descriptionTache = $descriptionTache;
    }

    public function getdateTache()
    {
        return $this->dateTache;
    }

    public function setdateTache($dateTache)
    {
        $this->dateTache = $dateTache;
    }

    public function getpriorite()
    {
        return $this->priorite;
    }

    public function setpriorite($priorite)
    {
        $this->priorite = $priorite;
    }

    public function getcategorie()
    {
        return $this->categorie;
    }

    public function setcategorie($categorie)
    {
        $this->categorie = $categorie;
    }
}