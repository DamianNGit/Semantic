<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dydaktyka
 *
 * @ORM\Table(name="dydaktyka")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DydaktykaRepository")
 */
class Dydaktyka
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tytul", type="string", length=255)
     */
    private $tytul;

    /**
     * @var string
     *
     * @ORM\Column(name="tresc", type="text")
     */
    private $tresc;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tytul
     *
     * @param string $tytul
     *
     * @return Dydaktyka
     */
    public function setTytul($tytul)
    {
        $this->tytul = $tytul;

        return $this;
    }

    /**
     * Get tytul
     *
     * @return string
     */
    public function getTytul()
    {
        return $this->tytul;
    }

    /**
     * Set tresc
     *
     * @param string $tresc
     *
     * @return Dydaktyka
     */
    public function setTresc($tresc)
    {
        $this->tresc = $tresc;

        return $this;
    }

    /**
     * Get tresc
     *
     * @return string
     */
    public function getTresc()
    {
        return $this->tresc;
    }


    //Moje dodane

    /**
     * @var type
     *
     * @ORM\ManyToOne(targetEntity="Autor", inversedBy="dydaktyka")
     */
    private $autor;

    //tostring
    public function __toString(){
        // to show the name of the Category in the select
        return $this->tytul;
        // to show the id of the Category in the selects
        // return $this->id;
    }

    /**
     * Set autor
     *
     * @param \AppBundle\Entity\Autor $autor
     *
     * @return Dydaktyka
     */
    public function setAutor(\AppBundle\Entity\Autor $autor = null)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Get autor
     *
     * @return \AppBundle\Entity\Autor
     */
    public function getAutor()
    {
        return $this->autor;
    }
}
