<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use date;

/**
 * class Recommendation
 * @package App\Entity
 * @ORM\Entity()
 */
class Recommendation
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @Assert\Length(min="2",max="15")
     * @ORM\Column(type="string")
     * @var string
     */
    private $Name;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $Recommendation;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $Date;

    public function __construct()
    {
        $this->Date = new \DateTime();
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string
     */
    public function setName(string $Name)
    {
        $this->Name = $Name;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * @param string
     */
    public function setRecommendation(string $Recommendation)
    {
        $this->Recommendation = $Recommendation;
    }

    /**
     * @return string
     */
    public function getRecommendation(): ?string
    {
        return $this->Recommendation;
    }

    /**
     * @return DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->Date;
    }
}