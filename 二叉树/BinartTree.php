<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019/1/14
 * Time: 17:14
 */

namespace tree;


class BinartTree
{

    //根结点
    public $root;

    //深度
    public $depth;

    //结点数
    public $count;

    //叶结点数
     var  $leafCount=0;

    public function __construct(Node $node=null)
    {
        $this->root=$node;
    }

    /**
     * 先序遍历  DLR
     * @param $node
     */
    public static function xsbl($node){
        //结点不为空
        if(!is_null($node)) {
            echo $node->getValue();
            self::xsbl($node->getLnode());
            self::xsbl($node->getRnode());
        }
    }

    /**
     * 中序遍历：优先遍历左结点，左结点不存在，输出根，然后输出右结点
     * @param $node
     */
    public static function zxbl(Node $node){
        if(!is_null($node)){
            //如果存在左结点
            if($node->getLnode()){
                self::zxbl($node->getLnode());
            }
            echo $node->getValue();
            //如果存在右结点
            if($node->getRnode()){
                self::zxbl($node->getRnode());
            }
        }
    }

    /**
     * 后序遍历
     * @param Node $node
     */
    public static function hxbl(Node $node){
        if(!is_null($node)){
            //如果存在左结点
            if($node->getLnode()){
                self::hxbl($node->getLnode());
            }
            //如果存在右结点
            if($node->getRnode()){
                self::hxbl($node->getRnode());
            }
            echo $node->getValue();
        }
    }

    /**
     * 求深度，广度优先搜素
     * @param $node
     * @return int
     */
    public static function depth($node){
        if(!is_null($node)) {

            $l = self::depth($node->getLnode());
            $r = self::depth($node->getRnode());
            $dep=($l>$r?$l:$r)+1;
            return $dep;
        }
        return 0;
    }
    
    //递归求深度，root为第0层
    public function depth2($node,$h=0){
        if(!is_null($node)){
            if($h>$this->depth) {
                $this->depth = $h;
            }
            $this->depth2($node->getLnode(),$h+1);
            $this->depth2($node->getRnode(),$h+1);
            return $this->depth;
        }
    }




    /**
     * 求二叉树的最长子序列
     * @param $node         结点
     * @param int $h        层数
     * @param array $path   存储路径
     * @return array  $path
     */
    public function getMaxChildTree($node,$h=0,&$path=[]){
        if(!is_null($node)){
            $path[$h]=$node->getValue();
            if($h==($this->depth ?? $this->depth2($node,$h))){
                echo "<br>";
                foreach ($path as $value){
                    echo $value;
                }

                //print_r($path);
            }
            $this->getMaxChildTree($node->getLnode(),$h+1,$path);
            $this->getMaxChildTree($node->getRnode(),$h+1,$path);
        }
    }

}

/**
 * Class Node
 * 树的结点
 * @package tree
 */
class Node{
    //值
    private $value;
    //左结点
    private $lnode;
    //右结点
    private $rnode;

    //初始化结点
    public function __construct($value='')
    {
        $this->value=$value;
        $this->lnode=null;
        $this->rnode=null;
    }

    public function setValue($value){
        $this->value=$value;
    }

    public function getValue(){
        return $this->value;
    }

    public function getLnode(){
        return $this->lnode;
    }

    public function setLnode(Node $lnode){
        $this->lnode=$lnode;
    }

    public function getRnode(){
        return $this->rnode;
    }

    public function setRnode(Node $rnode){
        $this->rnode=$rnode;
    }

}


$a=new Node('A');
$b=new Node('B');
$c=new Node('C');
$d=new Node('D');
$e=new Node('E');
$f=new Node('F');
$g=new Node('G');
$h=new Node('H');
$i=new Node('I');
$j=new Node('J');
$l=new Node('L');
$d->setRnode($f);
$d->setLnode($e);
$b->setLnode($d);
$c->setLnode($g);
$f->setLnode($l);
$i->setRnode($j);
$g->setLnode($i);
$g->setRnode($h);
$a->setLnode($b);
$a->setRnode($c);


$tree=new BinartTree($a);
BinartTree::xsbl($tree->root);
echo "<br>";
BinartTree::zxbl($tree->root);
echo "<br>";
BinartTree::hxbl($tree->root);
echo "<br>";
echo BinartTree::depth($tree->root);
echo "<br>";
echo $tree->depth2($tree->root);
echo "<pre>";



echo "该二叉树的最长子树为：";
$tree->getMaxChildTree($tree->root);







