<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Autor;

/**
 * Strona
 *
 * @ORM\Table(name="strona")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StronaRepository")
 */
class Strona
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataStworzenia", type="datetime")
     */
    private $dataStworzenia;


    /**
     * @var type
     *
     * @ORM\ManyToOne(targetEntity="Autor", inversedBy="strona")
     */
    private $autor;


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
     * @return Strona
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
     * @return Strona
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

    /**
     * Set dataStworzenia
     *
     * @param \DateTime $dataStworzenia
     *
     * @return Strona
     */
    public function setDataStworzenia($dataStworzenia)
    {
        $this->dataStworzenia = $dataStworzenia;

        return $this;
    }

    /**
     * Get dataStworzenia
     *
     * @return \DateTime
     */
    public function getDataStworzenia()
    {
        return $this->dataStworzenia;
    }


    //Dodawanie daty
    public function __construct()
    {
        $this->dataStworzenia = new \DateTime('now');
    }


    /**
     * Set autor
     *
     * @param \AppBundle\Entity\Autor $autor
     *
     * @return Strona
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





    //tostring
    public function __toString(){
        // to show the name of the Category in the select
        return $this->tytul;
        // to show the id of the Category in the selects
        // return $this->id;
    }

}
