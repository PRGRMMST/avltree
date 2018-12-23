<?php

class avlTreeNode
{
    public $value;
    public $lft;
    public $rgt;

    public function __construct($value)
    {
        $this->value = $value;
        $this->lft = null;
        $this->rgt = null;
    }

    public function dump()
    {
        if(!is_null($this->lft)){
            $this->lft = dump();
        }

        if(!is_null($this->rgt)){
            $this->rgt = dump();
        }
    }
}

class avlTree
{
    protected $root;

    public function __construct()
    {
        $this->root = null;
    }

    public function insert($value)
    {
        $node = new avlTreeNode($value);

        if(is_null($this->root)){
            $this->root = $node;
        } else {
            $this->insertValue($node, $this->root);
        }
    }

    public function insertValue($node, &$subtree)
    {
        if(is_null($subtree)){
           $subtree = $node;
        } else {
            if($node->value > $subtree->value){
                $this->insertValue($node, $subtree->rgt);
            } else if($node->value < $subtree->value) {
                $this->insertValue($node, $subtree->lft);
            } else {
                echo "все тлен";
            }
        }
    }

    public function observeTree()
    {
        $this->root->dump();
    }
}

