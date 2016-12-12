<?php

namespace SlimTest\Model\Entity;

class EntryEntity extends AbstractEntity {


    /** @var string */
    private $title;

    /** @var string */
    private $description;


    /**
     * EntryEntity constructor.
     * @param array $sqlResult
     */
    public function __construct(array $sqlResult = null)
    {
        parent::__construct($sqlResult);
        if ($sqlResult) {
            $this->title = $sqlResult['title'];
            $this->description = $sqlResult['description'];
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}