<?php

require_once('avl.php');

class NumTree extends AVLTree {
    function NumTree( $val ) {
        $this->AVLTree();
        $this->data = $val;
        $this->depth = 1;
    }

    function add( $val ) {
        if( $val == $this->data ) {
            echo "$val already in tree<BR>\n";
            return ;
        }

        if( $val < $this->data ) {
            if( $this->left === NULL )
                $this->left = new NumTree($val);
            else {
                $this->left->add( $val );
                $this->balance();
            }
        } else {
            assert( $val > $this->data );

            if( $this->right === NULL )
                $this->right = new NumTree($val);
            else {
                $this->right->add( $val );
                $this->balance();
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
$n->add( 2 );
echo $n->toString();
$n->add( 1 );
echo $n->toString();
$n->add( 5 );
echo $n->toString();
$n->add( 3 );
echo $n->toString();
$n->add( 6 );
//$noisy=TRUE;
echo $n->toString();
$n->add( 4 );
echo $n->toString();
$n->add( 7 );
echo $n->toString();
$n->add( 11);
echo $n->toString();
$n->add( 12);
echo $n->toString();
?>