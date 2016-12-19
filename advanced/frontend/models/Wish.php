<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 02.12.2016
 * Time: 14:29
 */

namespace app\models;

use app\models\Product;


class Wish
{

    private $_wish;

    public function __construct()
    {
        $this->_wish['quantity'] = 0;
    }

    public function add($product){
        
        $this->_wish[$product->id]['quantity'] = 1;
        $this->_wish[$product->id]['product'] = $product;
        $this->_calcQuantity();

        return $this->_wish['quantity'];
    }
    
    public function clear(){
        $this->_wish = [];
        $this->_wish['quantity'] = 0;
    }

    public function getQuantity(){
        return $this->_wish['quantity'];
    }

    public function get() {

        return $this->_wish;

    }

    public function delete($id){

        if (isset($this->_wish[$id])) {

            unset($this->_wish[$id]);
            $this->_calcQuantity();

        }
        
        return $this->getQuantity();

    }

    public function isWished($id){

        return (isset($this->_wish[$id]));
    }

    private function _calcQuantity(){
        $quantity = 0;
        foreach ($this->_wish as $id => $item) {
            if (is_numeric($id)) {
                $quantity++;
            }
        }
        $this->_wish['quantity'] = $quantity;
    }


}