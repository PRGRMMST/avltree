<?php
class RBtree {

    public $left;
    public $right;
    public $data;
    public $color;
    public $depth;  //глубина

    public function RBtree()
    {
        $this->left = null;
        $this->right = null;
        $this->data = null;
        $this->color = "black";
        $this->depth = 0;
    }

    public function balance()
    {
        $ldepth = $this->left !== null ? $this->left->depth : 0;
        $rdepth = $this->right !== null ? $this->right->depth : 0;

        if($ldepth > $rdepth+1) {
            $lldepth = $this->left->left !== null ? $this->left->left->depth : 0;
            $lrdepth = $this->left->right !== null ? $this->left->right->depth : 0;

            if($lldepth < $lrdepth) {
                $this->left->rotateRR();
            }

            $this->rotateLL();
        } elseif ($ldepth+1 < $rdepth) {
            $rrdepth = $this->right->right !== null ? $this->right->right->depth : 0;
            $rldepth = $this->right->left !== null ? $this->right->left->depth : 0;

            if($rldepth >$rrdepth) {
                $this->right->rotateLL();
            }

            $this->rotateRR();
        }
    }

    public function rotateLL()
    {
        $data_before =& $this->data;
        $right_before =& $this->right;

        $this->data =& $this->left->data;
        $this->right =& $this->left;
        $this->left =& $this->left->left;
        $this->right->left =& $this->right->right;
        $this->right->right =& $right_before;
        $this->right->data =& $data_before;
        $this->right->updateInNewLocation();
        $this->updateInNewLocation();
    }

    public function rotateRR()
    {
        $data_before =& $this->data;
        $left_before =& $this->left;

        $this->data =& $this->right->data;
        $this->left =& $this->right;
        $this->right =& $this->right->right;
        $this->left->right =& $this->left->left;
        $this->left->left =& $left_before;
        $this->left->data =& $data_before;
        $this->left->updateInNewLocation();
        $this->updateInNewLocation();
    }

    public function updateInNewLocation()
    {
        $this->getDepthFromChildren();
    }

    public function getDepthFromChildren()
    {
        $this->depth = $this->data !== NULL ? 1 : 0;
        if( $this->left !== NULL )
            $this->depth = $this->left->depth+1;
        if( $this->right !== NULL && $this->depth <= $this->right->depth )
            $this->depth = $this->right->depth+1;

        if(isset($this->left->left) && isset($this->left->right))
            $this->left->color = $this->color == "red" ? "black" : "red";

        if(isset($this->right->left) && isset($this->right->right))
            $this->right->color = $this->color == "red" ? "black" : "red";
    }

    public function toString()
    {
        $s = "<table border><tr>\n".$this->toTD(0)."</tr>\n";
        $depth = $this->depth-1;
        for( $d = 0; $d < $depth; ++$d ) {
            $s .= "<tr>";

            $s .= $this->left !== NULL
                ? $this->left->toTD( $d )
                : "<td></td>";

            $s .= $this->right !== NULL
                ? $this->right->toTD( $d )
                : "<td></td>";

            $s .= "</tr>\n";
        }

        $s .= "</table>\n";
        return $s;
    }

    public function toTD($depth)
    {
        if($this->depth !== null and $this->depth !== 0)
        {
            if( $depth == 0 ) {
                $s = "<td align=center colspan=".$this->getNLeafs().">";
                $s .= $this->data . "$this->color" ."[".$this->depth."]</td>\n";
            } else {
                if( $this->left !== NULL ) {
                    $s = $this->left->toTD( $depth-1);
                } else {
                    $s="<td></td>";
                }

                if( $this->right !== NULL ) {
                    $s .= $this->right->toTD( $depth-1);
                } else {
                    if( $this->left !== NULL )
                        $s.="<td></td>";
                }
            }

            return $s;
        }

    }

    public function getNLeafs()
    {
        if ($this->left !== NULL) {
            $nleafs = $this->left->getNLeafs();

            if ($this->right !== NULL)
                $nleafs += $this->right->getNLeafs();
            else
                ++$nleafs;
        } else {
            if ($this->right !== NULL)
                $nleafs = $this->right->getNLeafs() + 1;
            else
                $nleafs = 1;
        }

        return $nleafs;
    }
}