<?php

/**
 * This is the model class for table "itemitem".
 *
 * The followings are the available columns in table 'itemitem':
 * @property integer $ID
 * @property integer $itemID1
 * @property integer $itemID2
 * @property double $ratings
 *
 * The followings are the available model relations:
 * @property Item $itemID20
 * @property Item $itemID10
 */
class Itemitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'itemitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('itemID1, itemID2, ratings', 'required'),
			array('itemID1, itemID2', 'numerical', 'integerOnly'=>true),
			array('ratings', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, itemID1, itemID2, ratings', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'itemID20' => array(self::BELONGS_TO, 'Item', 'itemID2'),
			'itemID10' => array(self::BELONGS_TO, 'Item', 'itemID1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'itemID1' => 'Item Id1',
			'itemID2' => 'Item Id2',
			'ratings' => 'Ratings',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('itemID1',$this->itemID1);
		$criteria->compare('itemID2',$this->itemID2);
		$criteria->compare('ratings',$this->ratings);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Itemitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
