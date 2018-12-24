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

    public function &findNode($value, &$subtree)
    {
        if(is_null($subtree)){
            return false;
        }

        if($subtree->value > $value){
            return $this->findNode($value, $subtree->lft);
        } else if ($subtree->value < $value) {
            return $this->findNode($value, $subtree->rgt);
        } else {
            return $subtree;
        }
    }

    public function delete($value)
    {
        $node = $this->findNode($value, $this->root);
        if(!empty($node)) {
            $this->deleteNode($node);
        }

        return $this;
    }

    public function deleteNode(avlTreeNode $node)
    {
        if(is_null($node->lft) && is_null($node->rgt)){
            $node = null;
        } else if(is_null($node->lft)){
            $node = $node->rgt;
        } else if(is_null($node->rgt)) {
            $node = $node->lft;
        } else {
            if(is_null($node->rgt->lft)){
                $node->rgt->lft = $node->lft;
                $node = $node->rgt;
            } else {
                $node->value = $node->rgt->lft->value;
                $this->deleteNode($node->rgt->lft);
            }
        }


    }

}

