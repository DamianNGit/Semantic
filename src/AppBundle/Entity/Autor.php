<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

//dziediczenie po FOSUSERBUNDLE
use FOS\UserBundle\Model\User as BaseUser;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Autor
 *
 * @ORM\Table(name="autor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AutorRepository")
 */
class Autor extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="imie", type="string", length=255)
     *
     * @Assert\NotBlank(message="Podaj imię.", groups={"Registration", "Profile"})
     */
    private $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwisko", type="string", length=255)
     *
     * @Assert\NotBlank(message="Podaj nazwisko.", groups={"Registration", "Profile"})
     */
    private $nazwisko;


    /**
     * @var type
     *
     * @ORM\OneToMany(targetEntity="Strona", mappedBy="autor")
     */
    private $strona;




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
     * Set imie
     *
     * @param string $imie
     *
     * @return Autor
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     *
     * @return Autor
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Add strona
     *
     * @param \AppBundle\Entity\Strona $strona
     *
     * @return Autor
     */
    public function addStrona(\AppBundle\Entity\Strona $strona)
    {
        $this->strona[] = $strona;

        return $this;
    }

    /**
     * Remove strona
     *
     * @param \AppBundle\Entity\Strona $strona
     */
    public function removeStrona(\AppBundle\Entity\Strona $strona)
    {
        $this->strona->removeElement($strona);
    }

    /**
     * Get strona
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStrona()
    {
        return $this->strona;
    }



    //konstruktor
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->strona = new \Doctrine\Common\Collections\ArrayCollection();
    }


    //tostring
    public function __toString(){
        // to show the name of the Category in the select
        return $this->username;
        // to show the id of the Category in the selects
        // return $this->id;
    }



    // do dydaktyki

    /**
     * @var type
     *
     * @ORM\OneToMany(targetEntity="Dydaktyka", mappedBy="autor")
     */
    private $dydaktyka;

}
