<?php

namespace CCleanBundle\Entity;

use CCleanBundle\Traits\Stampable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="CCleanBundle\Repository\ClientRepository")
 */
class Client
{
    use Stampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="CCcleanBundle\Testimonial", mappedBy="client_id")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255, nullable=true)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="adress1", type="text", nullable=true)
     */
    private $adress1;

    /**
     * @var string
     *
     * @ORM\Column(name="zip1", type="string", length=255, nullable=true)
     */
    private $zip1;

    /**
     * @var string
     *
     * @ORM\Column(name="city1", type="string", length=255, nullable=true)
     */
    private $city1;

    /**
     * @var string
     *
     * @ORM\Column(name="adress2", type="text", nullable=true)
     */
    private $adress2;

    /**
     * @var string
     *
     * @ORM\Column(name="zip2", type="string", length=255, nullable=true)
     */
    private $zip2;

    /**
     * @var string
     *
     * @ORM\Column(name="city2", type="string", length=255, nullable=true)
     */
    private $city2;

    /**
     * @var string
     *
     * @ORM\Column(name="tel1", type="string", length=255, nullable=true)
     */
    private $tel1;

    /**
     * @var string
     *
     * @ORM\Column(name="tel2", type="string", length=255, nullable=true)
     */
    private $tel2;

    /**
     * @var string
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Client
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Client
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set adress1
     *
     * @param string $adress1
     * @return Client
     */
    public function setAdress1($adress1)
    {
        $this->adress1 = $adress1;

        return $this;
    }

    /**
     * Get adress1
     *
     * @return string 
     */
    public function getAdress1()
    {
        return $this->adress1;
    }

    /**
     * Set zip1
     *
     * @param string $zip1
     * @return Client
     */
    public function setZip1($zip1)
    {
        $this->zip1 = $zip1;

        return $this;
    }

    /**
     * Get zip1
     *
     * @return string 
     */
    public function getZip1()
    {
        return $this->zip1;
    }

    /**
     * Set city1
     *
     * @param string $city1
     * @return Client
     */
    public function setCity1($city1)
    {
        $this->city1 = $city1;

        return $this;
    }

    /**
     * Get city1
     *
     * @return string 
     */
    public function getCity1()
    {
        return $this->city1;
    }

    /**
     * Set adress2
     *
     * @param string $adress2
     * @return Client
     */
    public function setAdress2($adress2)
    {
        $this->adress2 = $adress2;

        return $this;
    }

    /**
     * Get adress2
     *
     * @return string 
     */
    public function getAdress2()
    {
        return $this->adress2;
    }

    /**
     * Set zip2
     *
     * @param string $zip2
     * @return Client
     */
    public function setZip2($zip2)
    {
        $this->zip2 = $zip2;

        return $this;
    }

    /**
     * Get zip2
     *
     * @return string 
     */
    public function getZip2()
    {
        return $this->zip2;
    }

    /**
     * Set city2
     *
     * @param string $city2
     * @return Client
     */
    public function setCity2($city2)
    {
        $this->city2 = $city2;

        return $this;
    }

    /**
     * Get city2
     *
     * @return string 
     */
    public function getCity2()
    {
        return $this->city2;
    }

    /**
     * Set tel1
     *
     * @param string $tel1
     * @return Client
     */
    public function setTel1($tel1)
    {
        $this->tel1 = $tel1;

        return $this;
    }

    /**
     * Get tel1
     *
     * @return string 
     */
    public function getTel1()
    {
        return $this->tel1;
    }

    /**
     * Set tel2
     *
     * @param string $tel2
     * @return Client
     */
    public function setTel2($tel2)
    {
        $this->tel2 = $tel2;

        return $this;
    }

    /**
     * Get tel2
     *
     * @return string 
     */
    public function getTel2()
    {
        return $this->tel2;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Client
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Client
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
