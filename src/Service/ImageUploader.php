<?php

namespace App\Service;

/**
 * class ImageUploader
 */
class ImageUploader
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $extension
     */
    private $extension;

    /**
     * @var string $folder
     */
    private $folder;

    /**
     * @var string $type;
     */
    private $type;

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
    public function setExtension(string $extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param string
     */
    public function setFolder(string $folder)
    {
        $this->folder = $folder;
    }

    /**
     * @return string
     */
    public function getFolder(): ?string
    {
        return $this->folder;
    }

    /**
     * @param string
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Save file in right folder
     */
    public function save(){
        $location = '../public/'.$this->folder.'/'.$this->type.'-'.$this->name.'.'.$this->extension;
        move_uploaded_file($_FILES['file']['tmp_name'],$location);
    }
}