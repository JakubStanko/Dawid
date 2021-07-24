<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class Contact
 * @package App\Entity
 * @ORM\Entity()
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int $id
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * var string $companyName
     */
    private $companyName;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $postCode
     */
    private $postCode;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $city
     */
    private $city;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $street
     */
    private $street;


    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $phone
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $email
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $vat
     */
    private $vat;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $website
     */
    private $website;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $brn
     */
    private $brn;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $ownr
     */
    private $owner;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName(string $companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @param string $postCode
     */
    public function setPostCode(string $postCode)
    {
        $this->postCode = $postCode;
    }

    /**
     * @return string
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $vat
     */
    public function setVat(string $vat)
    {
        $this->vat = $vat;
    }

    /**
     * @return string
     */
    public function getVat(): ?string
    {
        return $this->vat;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string $brn
     */
    public function setBrn(string $brn)
    {
        $this->brn = $brn;
    }

    /**
     * @return string
     */
    public function getBrn(): ?string
    {
        return $this->brn;
    }

    /**
     * @param string $owner
     */
    public function setowner(string $owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getOwner(): ?string
    {
        return $this->owner;
    }
}