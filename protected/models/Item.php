<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $ID
 * @property string $Name
 * @property string $Price
 * @property integer $Category
 * @property string $ImageURL
 * @property string $Update
 * @property integer $Purchases
 * @property integer $Website
 * @property string $URL
 * @property integer $Location
 * @property string $Address
 *
 * The followings are the available model relations:
 * @property Category $category
 * @property Website $website
 * @property Location $location
 */
class Item extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, Price, Category, ImageURL, Update, Purchases, Website, URL, Location, Address', 'required'),
			array('Category, Purchases, Website, Location', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>200),
			array('Price', 'length', 'max'=>10),
			array('ImageURL, URL, Address', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Name, Price, Category, ImageURL, Update, Purchases, Website, URL, Location, Address', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'Category'),
			'website' => array(self::BELONGS_TO, 'Website', 'Website'),
			'location' => array(self::BELONGS_TO, 'Location', 'Location'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => 'Product',
			'Price' => 'Price',
			'Category' => 'Category',
			'ImageURL' => 'Image',
			'Update' => 'Update',
			'Purchases' => 'Purchases',
			'Website' => 'Website',
			'URL' => 'URL',
			'Location' => 'Location',
			'Address' => 'Address',
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
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('Category',$this->Category);
		$criteria->compare('ImageURL',$this->ImageURL,true);
		$criteria->compare('Update',$this->Update,true);
		$criteria->compare('Purchases',$this->Purchases);
		$criteria->compare('Website',$this->Website);
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('Location',$this->Location);
		$criteria->compare('Address',$this->Address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Item the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
