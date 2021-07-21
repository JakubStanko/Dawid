<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * class HomeBlock
 * @package App\Entity
 * @ORM\Entity()
 */
class HomeBlock
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
     * var string $blockName
     */
    private $blockName;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $imageTitle
     */
    private $imageTitle;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="100")
     * @var string $textTitle
     */
    private $textTitle;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max="4500")
     * @var string $textValue
     */
    private $textValue;

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
     * @param string $blockName
     */
    public function setBlockName(string $blockName)
    {
        $this->blockName = $blockName;
    }

    /**
     * @return string
     */
    public function getBlockName(): ?string
    {
        return $this->blockName;
    }

    /**
     * @param string $imageTitle
     */
    public function setImageTitle(string $imageTitle)
    {
        $this->imageTitle = $imageTitle;
    }

    /**
     * @return string
     */
    public function getImageTitle(): ?string
    {
        return $this->imageTitle;
    }

    /**
     * @param string $textTitle
     */
    public function setTextTitle(string $textTitle)
    {
        $this->textTitle = $textTitle;
    }

    /**
     * @return string
     */
    public function getTextTitle(): ?string
    {
        return $this->textTitle;
    }

    /**
     * @param string $textValue
     */
    public function setTextValue(string $textValue)
    {
        $this->textValue = $textValue;
    }

    /**
     * @return string
     */
    public function getTextValue(): ?string
    {
        return $this->textValue;
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