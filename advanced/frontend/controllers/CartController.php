<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 02.12.2016
 * Time: 11:43
 */

namespace frontend\controllers;

use app\models\Cart;
use common\models\User;
use frontend\models\Order;
use app\models\Wish;
use app\models\Customer;
use yii;
use yii\web\Controller;
use frontend\models\Product;

class CartController extends Controller
{

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);

    }

    public function actionAdd(){

        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (count($product->toArray()) > 0){

            $session = Yii::$app->session;
            $session->open();
            if (!isset($session['cart'])) {
                $session['cart'] = new Cart();
            }

            return $session['cart']->add($product);
        }

        return 'не найден '.$id;
    }

    public function actionAddwish(){

        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if (count($product->toArray()) > 0){

            $session = Yii::$app->session;
            $session->open();
            if (!isset($session['wish'])) {
                $session['wish'] = new Wish();
            }

            return $session['wish']->add($product);
        }

        return 'не найден '.$id;
    }

    public function actionGetwish(){
        $session = Yii::$app->session;
        $session->open();
        if (!isset($session['wish'])) {
            $session['wish'] = new Wish();
        }

        return $session['wish']->getQuantity();

    }

    public function actionGetcart(){
        $session = Yii::$app->session;
        $session->open();
        if (!isset($session['cart'])) {
            $session['cart'] = new Cart();
        }

        return $session['cart']->getQuantity();

    }

    public function actionGettab() {

        $cartWish = Yii::$app->request->get('cartwish');

        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('modal'.$cartWish, ['cart' => $session[$cartWish]]);
    }

    public function actionClear() {


        try{
            $cartWish = Yii::$app->request->get('cartwish');

            $session = Yii::$app->session;
            $session->open();
            $session[$cartWish]->clear();
            $this->layout = true;

        } catch (yii\base\Exception $e) {
            unset($session['cart']);
            unset($session['wish']);
        }
        return $this->render('empty');
    }
    
    public function actionDelelement(){
        $cartWish = Yii::$app->request->get('cartwish');
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();

        if (isset($session[$cartWish])) {
            return $session[$cartWish]->delete($id);
        }
        return 0;
        //$this->layout = false;
        //return $this->render('modal'.$cartWish,['cart' => $session[$cartWish]]);
    }

    public function actionIswished(){

        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();

        if (isset($session['wish'])) {
            if ($session['wish']->isWished($id)) return 1;
        }
        return 0;
    }

    public function actionIndex(){

        $modelOrder = new Order();

        $session = Yii::$app->session;
        $session->open();

        if (isset($session['cart'])) {
            $modelOrder->fillNewOrderContent($session['cart']);

            $postrequest = Yii::$app->request->post();
            if ($modelOrder->load($postrequest) && $modelOrder->loadNewOrderContent($postrequest)) {

                $customer = Customer::findOne(['full_name' => $modelOrder->customer]);
                if ($customer)
                    $modelOrder->full_name = $customer->full_name;
                else {
                    $customer = new Customer();
                    $customer->full_name = $modelOrder->customer;
                    $customer->email = $modelOrder->email;
                    $customer->phone = $modelOrder->phone;
                    if ($customer->save())
                        $modelOrder->full_name = $customer->full_name;
                    else {
                        echo "Такой пользователь уже существует";
                        return $this->refresh();
                    }
                }
                if ($modelOrder->save()) {
                    Yii::$app->mailer->compose('orderAdmin', ['cart' => $session['cart'],
                        'modelOrder' => $modelOrder,])
                        ->setFrom('porteliano@mail.ru')
                        ->setTo(User::findByUsername('admin')->email)
                        ->setSubject('Заказ ' . $modelOrder->id)
                        ->send();

                    unset($session['cart']);

                    return $this->render('successful');
                }
            }
        }
        else
            return $this->render('empty');

        return $this->render('14_Korzina',
                [
                    'cart' => $session['cart'],
                    'modelOrder' => $modelOrder,
            ]);
    }
    
    public function actionWishlist(){

        $session = Yii::$app->session;
        $session->open();

        return $this->render('13_Wishlist', ['wish' => $session['wish']]);
    }

}