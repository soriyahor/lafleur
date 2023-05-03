<?php

class Client {

    public function __construct($id, $nom, $date, $mail){
        $this->nom = $nom;
        $this->id = $id;
        $this->date = $date;
        $this->mail =$mail;
    }

    private $id;
    private $nom;
    private $date;
    private $mail;
    private $articlesVues;
    private $articles;

    
    /**
     * Get the value of articles
     */ 
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set the value of articles
     *
     * @return  self
     */ 
    public function setArticles($articles)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get the value of articlesVues
     */ 
    public function getarticlesVues()
    {
        return $this->articlesVues;
    }

    /**
     * Set the value of articlesVues
     *
     * @return  self
     */ 
    public function setarticlesVues($articlesVues)
    {
        $this->articlesVues = $articlesVues;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }
}


?>