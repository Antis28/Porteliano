<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 02.12.2016
 * Time: 14:29
 */

namespace app\models;



class Cart
{

    private $_cart;

    public function __construct()
    {
        $this->_cart['quantity'] = 0;
    }


    public function add($product){

        if (!isset($this->_cart[$product->id]['quantity'])) {
            $this->_cart[$product->id]['quantity'] = 1;
            $this->_cart[$product->id]['sum'] = $product->price->cost;

        }
        else {
            $this->_cart[$product->id]['quantity']++;
            $this->_cart[$product->id]['sum'] += $product->price->cost;
        }
        $this->_cart[$product->id]['product'] = $product;
        $this->_cart['quantity']++;
        if (isset($this->_cart['sum']))
            $this->_cart['sum'] += $product->price->cost;
        else
            $this->_cart['sum'] = $product->price->cost;
        return $this->_cart['quantity'];
    }
    
    public function clear(){
        $this->_cart = [];
//        $this->_cart['quantity'] = 0;
//        $this->_cart['sum'] = 0;
    }

    public function getQuantity(){
        return $this->_cart['quantity'];
    }
    
    public function getSum(){
        return $this->_cart['sum'];
    }

    public function get(){

        return $this->_cart;
    }
    
    public function delete($id){

        if (isset($this->_cart[$id])) {

            unset($this->_cart[$id]);
            $this->_calcQuantity();

        }
    
        return $this->getQuantity();
        
    }

    public function isOrdered($id) {

        return (isset($this->_cart[$id]));
    }

    private function _calcQuantity(){
        $quantity = 0;
        $sum = 0;
        foreach ($this->_cart as $id => $item) {
            if (is_numeric($id)) {
                $quantity += $item['quantity'];
                $sum += $item['sum'];
            }
        }
        $this->_cart['quantity'] = $quantity;
        $this->_cart['sum'] = $sum;
    }

}