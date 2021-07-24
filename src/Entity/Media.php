<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class Media
 * @package App\Entity
 * @ORM\Entity()
 */
class Media
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
     * var string $facebook
     */
    private $facebook;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $twitter
     */
    private $twitter;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $instagram
     */
    private $instagram;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $facebook
     */
    public function setFacebook(string $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @return string
     */
    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    /**
     * @param string $twitter
     */
    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * @return string
     */
    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    /**
     * @param string $instagram
     */
    public function setInstagram(string $instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * @return string
     */
    public function getInstagram(): ?string
    {
        return $this->instagram;
    }
}