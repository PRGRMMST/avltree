<?php

class avlTree
{
    public $value;
    public $lft = null;
    public $rgt = null;

    public function __construct($value)
    {
        $this->value = $value;
    }
}

