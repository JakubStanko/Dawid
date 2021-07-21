<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class HomeBlock
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ServiceRepository")
 */
class Service
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
     * @Assert\Length(max="50")
     * @var string $serviceTitle
     */
    private $serviceTitle;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $textTitle
     */
    private $serviceValue;

    /**
     *
     * @ORM\Column(type="boolean")
     * @var int $visibility
     */
    private $visibility = true;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @param string $serviceTitle
     */
    public function setServiceTitle(string $serviceTitle)
    {
        $this->serviceTitle = $serviceTitle;
    }

    /**
     * @return string
     */
    public function getServiceTitle(): ?string
    {
        return $this->serviceTitle;
    }

    /**
     * @param string $serviceValue
     */
    public function setServiceValue(string $serviceValue)
    {
        $this->serviceValue = $serviceValue;
    }

    /**
     * @return string
     */
    public function getServiceValue(): ?string
    {
        return $this->serviceValue;
    }

    /**
     * @param int $visibility
     */
    public function setVisibility(int $visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * @return int
     */
    public function getVisibility(): ?int
    {
        return $this->visibility;
    }
}