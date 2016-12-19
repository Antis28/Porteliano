<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 21.11.2016
 * Time: 12:51
 */

namespace frontend\models;

use app\models\Manufacturer;
use app\models\Material;
use app\models\Section;
use app\models\Style;
use frontend\models\GreenyImages;
use app\models\Wish;

use yii;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


class Product extends ActiveRecord
{

    private $_session;

    public function afterFind()
    {
        parent::afterFind();
        $this->_session = Yii::$app->session;
        $this->_session->open();
    }

    public function getProducts($section = null, $num = null){

        $condition = ($section == null) ? []
            : 'product.section_id = '.$section.' OR section.parent_id = '.$section ;

        $products['products'] = $this->find()
            ->innerJoin('section', 'product.section_id = section.id')
            ->where($condition)->limit($num)->orderBy('date DESC')->each();
        return $products;
    }

    public function getProductsBySection($id = null, $num = null, $notin = null)
    {

        //TODO Нужно выделить класс .everything

        $notInCondition = '';
        if ($notin != null ) {

            $notInCondition = 'product.id NOT IN ( ';
            $first = true;
            foreach( $notin as $addItem)
            {
                if (! $first) {
                    $notInCondition .= ' , ';


                }
                $notInCondition .= $addItem;
                $first = false;
            }
            $notInCondition .= ' )';
        }


        $id = ($id == null) ? '3': $id;
        $products['section'] = Section::findOne(['id' => $id]);

        $condition = ($id == null) ? []
            : 'product.section_id = '.$id.' OR section.parent_id = '.$id ;


        $products['products'] = $this->find()
            ->innerJoin('section', 'product.section_id = section.id')
            //->innerJoin('select * from price limit 1', 'price.product_id = product.id')
            ->where($condition)->andWhere($notInCondition)->limit($num)->each();
        
        $materials = $this->find()->
            select('material_id id, material.title title')->distinct()
            ->innerJoin('section', 'product.section_id = section.id')
            ->innerJoin('material','material_id = material.id')
            ->where($condition)->each();

        $products['materials'][] = ['label' => 'Любой', 'url' => '#',
            'linkOptions'=> ['data-toggle' =>'dropdown',
                'data-id' => '0',
                'class' => 'everything',
                'table' => 'materials',],];
        foreach ($materials as $item) {

            $products['materials'][$item['id']]  = ['label' => $item['title'], 'url' => '#',
                'linkOptions'=> ['data-toggle' =>'dropdown',
                    'data-id' => $item['id'],
                    'table' => 'material',
                ],
            ];
        }

        $styles = $this->find()->
        select('style_id id, style.title title')->distinct()
            ->innerJoin('section', 'product.section_id = section.id')
            ->innerJoin('style','style_id = style.id')
            ->where($condition)->each();

        $products['styles'][] = ['label' => 'Любой', 'url' => '#',
            'linkOptions'=> ['data-toggle' =>'dropdown',
                'data-id' => '0',
                'class' => 'everything',
                'table' => 'styles',],];
        foreach ($styles as $item) {

            $products['styles'][$item['id']]  = ['label' => $item['title'], 'url' => '#',
                'linkOptions'=> ['data-toggle' =>'dropdown',
                'data-id' => $item['id'],
                    'table' => 'style',],];
        }

        $manufacturers = $this->find()->
        select('manufacturer_id id, manufacturer.title title')->distinct()
            ->innerJoin('section', 'product.section_id = section.id')
            ->innerJoin('manufacturer','manufacturer_id = manufacturer.id')
            ->where($condition)->each();

        $products['manufacturers'][] = ['label' => 'Любой', 'url' => '#',
            'linkOptions'=> ['data-toggle' =>'dropdown',
                'data-id' => '0',
                'class' => 'everything',
                'table' => 'manufacturer',],];

        foreach ($manufacturers as $item) {

            $products['manufacturers'][$item['id']]  = ['label' => $item['title'], 'url' => '#',
                'linkOptions'=> ['data-toggle' =>'dropdown',
                    'data-id' => $item['id'],
                    'table' => 'manufacturer',],];
        }
        
        return $products;

    }

    public function getMaterials(){

        return $this->hasOne(Material::className(), ['id' => 'material_id']);
        
    }

    public function getSection(){

        return $this->hasOne(Section::className(), ['id' => 'section_id']);

    }

    public function getStyle(){

        return $this->hasOne(Style::className(), ['id' => 'style_id']);

    }

    public function getManufacturer(){

        return $this->hasOne(Manufacturer::className(), ['id' => 'manufacturer_id']);

    }
    

    public function getNewProducts($quantity){

        return [];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Price::className(), ['product_id' => 'id']);
    }

    public function getPrice(){

        return $this->hasMany(Price::className(), ['product_id' => 'id'] )->orderBy('date desc')->one();
    }

    public function getImage() {

        $img = '/img/Image-Capture-icon.png';
        if ( $this->img == '' ) {
            $old_pic = $this->hasOne(GreenyImages::className(), ['imageID' => 'productImageID'])->one();
            //return $old_pic;
            if (isset($old_pic->src))
            {
                $img = '/img/'.$old_pic->src;
            }
        }
        else
        {
            $img = "/frontend/web/img/products/" . $this->manufacturer->title . '/' . $this->img;
        }

        return $img;
    }

    public function getFilteredProducts($params, $quantity, $notin = null){

        $notInCondition = '';
        if ($notin != null ) {

            $notInCondition = 'product.id NOT IN ( ';
            $first = true;
            foreach( $notin as $addItem)
            {
                if (! $first) {
                    $notInCondition .= ' , ';


                }
                $notInCondition .= $addItem;
                $first = false;
            }
            $notInCondition .= ' )';
        }

        $id = (isset($params['section'])) ? $params['section'] : 3;
        $products = $this->getProductsBySection($id,$quantity);

        $order = 'price.cost';
        if (isset($params['order'])) {
            if ($params['order'] == 'abc')
                $order = 'product.title';
            else
                $order = 'price.cost';
        }
        $conditionPrice = '';
        if (isset($params['price'])) {
            switch ($params['price']){
                case '1' :
                $conditionPrice = 'price.cost < 500' ;
            break;
                case '2' :
                    $conditionPrice = 'price.cost > 500 and price.cost < 1000';
                    break;
                case '3' :
                    $conditionPrice = 'price.cost > 1000 and price.cost < 2000';
                    break;
                case '4':
                    $conditionPrice = 'price.cost > 2000';
                    break;
                default:
                    $conditionPrice = '';

            }
        }

        $query = $this->find()
            ->innerJoin('section', 'product.section_id = section.id ')
            ->innerJoin('(select distinct price.cost, price.product_id from price order by date DESC ) price ',
                'price.product_id = product.id')
            ->where(['product.section_id' => $id])
            ->orWhere(['section.parent_id' => $id])->andWhere($conditionPrice)->andWhere($notInCondition)
            ->limit($quantity)
            ->orderBy($order);

        $query = (isset($params['style'])) ? $query->andWhere(['product.style_id' => $params['style']]) : $query;
        $query = (isset($params['manufacturer'])) ? $query->andWhere(['product.manufacturer_id' => $params['manufacturer']]) : $query;
        $query = (isset($params['material'])) ? $query->andWhere(['product.material_id' => $params['material']]) : $query;

        $products['products'] = $query->each($quantity);

        return $products;
    }

    public function isWished(){

        if (isset($this->_session['wish'])) {
            if ($this->_session['wish']->isWished($this->id)) return true;
        }

        return false;
    }

    public function isOrdered(){

        if (isset($this->_session['cart'])) {
            if ($this->_session['cart']->isOrdered($this->id)) return true;
        }

        return false;

    }

}
