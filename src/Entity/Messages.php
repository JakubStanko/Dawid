<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use date;

/**
 * Class Messages
 * @package App\Entity
 * @ORM\Entity()
 */
class Messages
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @var int
     */
    private $id;

    /**
     * @Assert\Length(min="2",minMessage="Name sollte ab 2 bis 15 Zeichen haben.")
     * @Assert\Length(max="20",maxMessage="Name sollte ab 2 bis 15 Zeichen haben.")
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;

    /**
     * @Assert\Email(message="Dies '{{ value }}' ist keine E-Mail-Adresse")
     * @ORM\Column(type="string")
     * @var string
     */
    private $email;

    /**
     * @Assert\Length(min="5",minMessage="die Nachricht sollte ab 5 bis 50 Zeichen haben.")
     * @Assert\Length(max="50",maxMessage="die Nachricht sollte ab 5 bis 50 Zeichen haben.")
     * @ORM\Column(type="string")
     * @var string
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $status = 0;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $PersonalData;

    public function __construct()
    {
        $this->date = new \DateTime;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string
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
     * @param string
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param string
     */
    public function setPersonalData(string $PersonalData)
    {
        $this->PersonalData = $PersonalData;
    }

    /**
     * @return string
     */
    public function getPersonalData(): ?string
    {
        return $this->PersonalData;
    }

    /**
     * @param int
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
}