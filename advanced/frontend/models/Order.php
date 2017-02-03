<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $date
 * @property string $full_name
 * @property string $done
 * @property string $term
 *
 * @property Customer $fullName
 * @property OrderContent[] $orderContents
 */
class Order extends \yii\db\ActiveRecord
{

    public $newOrderContent;
    public $customer;
    public $email;
    public $phone;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'done', 'term'], 'safe'],
            [['full_name'], 'string', 'max' => 100],
            ['email','email'],
            [['phone'],'match' ,'pattern' => '/^(?:0{1,2}|\+)[\d]{2,4}-?[\d\-]{7}$/gm'],
            [['customer'],'string', 'max' => 100],
            //[['full_name'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['full_name' => 'full_name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'customer' => 'ФИО',
            'done' => 'Done',
            'term' => 'Term',
            'email' => 'e-mail',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullName()
    {
        return $this->hasOne(Customer::className(), ['full_name' => 'full_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderContents()
    {
        return $this->hasMany(OrderContent::className(), ['order_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    public function fillNewOrderContent($cart)
    {

        foreach ($cart->get() as $id => $item) {

            if (is_numeric($id)) {

                if (!isset($item['product'])) {
                    $cart->delete($id); //Удаляем глючные
                    continue;
                }
                $this->newOrderContent[$id] = new OrderContent();
                $this->newOrderContent[$id]->product_id = $item['product']->id;
                $this->newOrderContent[$id]->quantity = $item['quantity'];
                $this->newOrderContent[$id]->price = (isset($item['product']->price))
                    ? $item['product']->price->cost : 0;
                $this->newOrderContent[$id]->currency_id = (isset($item['product']->price))
                    ? $item['product']->price->currency_id : '978';
                $this->newOrderContent[$id]->sum = $item['sum'];
            }
        }
    }

    public function loadNewOrderContent($content) {

        if (! isset($content['OrderContent']))
            return false;

        $loaded = false;
        foreach ($content['OrderContent'] as $id => $item) {

            $this->newOrderContent[$id]->quantity = $item['quantity'];
            $loaded = true;
        }
        return $loaded;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        foreach($this->newOrderContent as $item)
        {
            $item->sum = $item->quantity * $item->price;
            $item->order_id = $this->id;
            $item->save();
        }
    }
}
