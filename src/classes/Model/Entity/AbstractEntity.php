<?php

namespace SlimTest\Model\Entity;

abstract class AbstractEntity {

    /** @var  int */
    protected $id;

    public function __construct(array $sqlResult = null)
    {
        // no id -> new entry
        if(isset($sqlResult['id'])) {
            $this->id = $sqlResult['id'];
        }
    }

    public function getId() {
        return $this->id;
    }

}