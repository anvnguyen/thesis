<?php

/**
 * This is the model class for table "item".
 *
 * The followings are the available columns in table 'item':
 * @property integer $ID
 * @property integer $Website
 * @property integer $Category
 * @property string $Name
 * @property string $Price
 * @property string $OriginalPrice
 * @property integer $Purchases
 * @property string $URL
 * @property string $ImageURL
 * @property integer $Location
 * @property string $Address
 * @property string $Description
 * @property string $Condition
 * @property string $Update
 *
 * The followings are the available model relations:
 * @property Behaviour[] $behaviours
 * @property Category $category
 * @property Website $website
 * @property Location $location
 * @property Itemitem[] $itemitems
 * @property Itemitem[] $itemitems1
 * @property Mostinterest[] $mostinterests
 * @property Useruser[] $userusers
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
			array('Website, Category, Name, Price, OriginalPrice, Purchases, URL, ImageURL, Location, Address, Description, Condition, Update', 'required'),
			array('Website, Category, Purchases, Location', 'numerical', 'integerOnly'=>true),
			array('Name', 'length', 'max'=>200),
			array('Price, OriginalPrice', 'length', 'max'=>10),
			array('URL, ImageURL, Address', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Website, Category, Name, Price, OriginalPrice, Purchases, URL, ImageURL, Location, Address, Description, Condition, Update', 'safe', 'on'=>'search'),
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
			'behaviours' => array(self::HAS_MANY, 'Behaviour', 'itemID'),
			'category' => array(self::BELONGS_TO, 'Category', 'Category'),
			'website' => array(self::BELONGS_TO, 'Website', 'Website'),
			'location' => array(self::BELONGS_TO, 'Location', 'Location'),
			'itemitems' => array(self::HAS_MANY, 'Itemitem', 'itemID1'),
			'itemitems1' => array(self::HAS_MANY, 'Itemitem', 'itemID2'),
			'mostinterests' => array(self::HAS_MANY, 'Mostinterest', 'itemID'),
			'userusers' => array(self::HAS_MANY, 'Useruser', 'itemID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Website' => 'Website',
			'Category' => 'Category',
			'Name' => 'Name',
			'Price' => 'Price',
			'OriginalPrice' => 'Original Price',
			'Purchases' => 'Purchases',
			'URL' => 'Url',
			'ImageURL' => 'Image Url',
			'Location' => 'Location',
			'Address' => 'Address',
			'Description' => 'Description',
			'Condition' => 'Condition',
			'Update' => 'Update',
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
		$criteria->compare('Website',$this->Website);
		$criteria->compare('Category',$this->Category);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('OriginalPrice',$this->OriginalPrice,true);
		$criteria->compare('Purchases',$this->Purchases);
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('ImageURL',$this->ImageURL,true);
		$criteria->compare('Location',$this->Location);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Condition',$this->Condition,true);
		$criteria->compare('Update',$this->Update,true);

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

	public function searchRecommend($itemIDs)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->addInCondition('ID',$itemIDs);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
