<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @MongoDB\Document
 */
class Card
{

    /**
     * @MongoDB\Id
     * @Groups({"default"})
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     * @Groups({"cardsWithoutId", "default"})
     * @Assert\NotBlank
     */
    protected $title;

    /**
     * @MongoDB\Field(type="string")
     * @Groups({"cardsWithoutId", "default"})
     * @Assert\NotBlank
     */
    protected $content;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }



}