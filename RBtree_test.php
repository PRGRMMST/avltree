<?php
require_once('RBtree.php');

class NumTree extends RBtree {
    function NumTree($val)
    {
        $this->RBtree();
        $this->data = $val;
        $this->depth = 1;
        $this->color = "black";
    }

    function add($val)
    {
        if( $val == $this->data ) {
            echo "$val already in tree<BR>\n";
            return ;
        }

        if( $val < $this->data ) {
            if( $this->left === NULL )
                $this->left = new NumTree($val);
            else {
                $this->left->add($val);
                $this->balance();
            }
        } else {
            /*assert( $val > $this->data );*/

            if( $this->right === NULL )
                $this->right = new NumTree($val);
            else {
                $this->right->add( $val );
                $this->balance();
            }
        }

        $this->getDepthFromChildren();
    }

    function delete($val)
    {
        if($val == $this->data) {
            if($this->right !== null){
                if($this->right->left !== null){
                    $this->data = $this->right->left->data;
                    $this->right->left->data = null;
                    $this->right->left = null;
                    $this->balance();
                } else {
                    $this->data = $this->right->data;
                    $this->right->data = null;
                    $this->right = null;
                    $this->balance();
                }
            } elseif($this->left !== null) {
                $this->data = $this->left->data;
                $this->left = null;
                $this->left->data = null;
                $this->balance();
            } else {
                $this->data = null;
                $this->depth = null;
                $this->balance();
            }

            echo "$val deleted";
            return;
        }

        if($val < $this->data) {
            if($this->left !== null){
                $this->left->delete($val);
                $this->balance();
            } else {
                echo "$val not found in the tree";
                return;
            }
        } else {
            if($this->right !== null) {
                $this->right->delete($val);
                $this->balance();
            } else {
                echo "$val not found in the tree";
                return;
            }
        }

        $this->getDepthFromChildren();
    }
}

$n = new NumTree( 8 );
echo $n->toString();
$n->add( 9 );
echo $n->toString();
$n->add( 10);
echo $n->toString();
$n->add( 8 );
echo $n->toString();
$n->add( 2 );
echo $n->toString();
$n->add( 15 );
echo $n->toString();
$n->add( 1 );
echo $n->toString();
$n->add( 5 );
echo $n->toString();
$n->add( 3 );
echo $n->toString();
$n->add( 6 );
echo $n->toString();
$n->add( 4 );
echo $n->toString();
$n->add( 7 );
echo $n->toString();
$n->add( 11);
echo $n->toString();
$n->add( 12);
echo $n->toString();
$n->add( 17);
echo $n->toString();
$n->delete( 15);
echo $n->toString();
$n->delete( 4);
echo $n->toString();
?>