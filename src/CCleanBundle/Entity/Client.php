<?php

namespace CCleanBundle\Entity;

use CCleanBundle\Traits\Stampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUser;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @UniqueEntity(fields="mail", message="Cet email est déjà utilisé !")
 * @UniqueEntity(fields="username", message="Ce nom d'utilisateur est déjà utilisé")
 * @ORM\Entity(repositoryClass="CCleanBundle\Repository\ClientRepository")
 */
class Client extends OAuthUser implements UserInterface, \Serializable
{
    use Stampable;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="CCcleanBundle\Testimonial", mappedBy="clientId")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="google_id", type="string", length=255, unique=true, nullable=true)
     */
    protected $googleId;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_id", type="string", length=255, unique=true, nullable=true)
     */
    protected $facebookId;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_id", type="string", length=255, unique=true, nullable=true)
     */
    protected $twitterId;

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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

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
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $mail;

    /**
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="CCleanBundle\Entity\Testimonial", mappedBy="clientId")
     */
    private $testimonials;

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
        if (!$this->getId()) {
            $this->setCreatedAt(new \DateTime());
        } else {
            $this->setUpdatedAt(new \DateTime());
        }
        $this->testimonials = new ArrayCollection();
    }

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
     * @param string $googleId
     */
    public function setGoogleId($googleId)
    {
        $this->googleId = $googleId;
    }

    /**
     * @return string
     */
    public function getGoogleId()
    {
        return $this->googleId;
    }

    /**
     * @param string $facebookId
     */
    public function setFacebookId($facebookId)
    {
        $this->googleId = $facebookId;
    }

    /**
     * @return string
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param string $twitterId
     */
    public function setTwitterId($twitterId)
    {
        $this->twitterId = $twitterId;
    }

    /**
     * @return string
     */
    public function getTwitterId()
    {
        return $this->twitterId;
    }
    /**
     * Set username
     *
     * @param string $username
     * @return Client
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Client
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
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
     * @return Client
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set plainpassword
     *
     * @param string $password
     * @return Client
     */
    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Get plainpassword
     *
     * @return Client
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        // The bcrypt algorithm doesn't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    /**
     * @return Client
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     * @return CLient
     */
    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Client
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Client
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Add testimonials
     *
     * @param \CCleanBundle\Entity\Testimonial $testimonials
     * @return Client
     */
    public function addTestimonial(\CCleanBundle\Entity\Testimonial $testimonials)
    {
        $this->testimonials[] = $testimonials;

        return $this;
    }

    /**
     * Remove testimonials
     *
     * @param \CCleanBundle\Entity\Testimonial $testimonials
     */
    public function removeTestimonial(\CCleanBundle\Entity\Testimonial $testimonials)
    {
        $this->testimonials->removeElement($testimonials);
    }

    /**
     * Get testimonials
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTestimonials()
    {
        return $this->testimonials;
    }
}
