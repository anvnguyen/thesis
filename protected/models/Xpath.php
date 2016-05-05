<?php

/**
 * This is the model class for table "xpath".
 *
 * The followings are the available columns in table 'xpath':
 * @property integer $ID
 * @property string $URL
 * @property integer $WebsiteID
 * @property string $Name
 * @property string $Price
 * @property string $OriginalPrice
 * @property string $ExpiredDate
 * @property string $Purchases
 * @property string $ImageURL
 * @property string $Address
 * @property string $Description
 * @property string $Condition
 *
 * The followings are the available model relations:
 * @property Website $website
 */
class Xpath extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'xpath';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('URL, WebsiteID, Name, Price, OriginalPrice, ExpiredDate, Purchases, ImageURL, Address, Description, Condition', 'required'),
			array('WebsiteID', 'numerical', 'integerOnly'=>true),
			array('URL, Name, Price, OriginalPrice, ExpiredDate, Purchases, ImageURL, Address, Description, Condition', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, URL, WebsiteID, Name, Price, OriginalPrice, ExpiredDate, Purchases, ImageURL, Address, Description, Condition', 'safe', 'on'=>'search'),
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
			'website' => array(self::BELONGS_TO, 'Website', 'WebsiteID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'URL' => 'Url',
			'WebsiteID' => 'Website',
			'Name' => 'Name',
			'Price' => 'Price',
			'OriginalPrice' => 'Original Price',
			'ExpiredDate' => 'Expired Date',
			'Purchases' => 'Purchases',
			'ImageURL' => 'Image Url',
			'Address' => 'Address',
			'Description' => 'Description',
			'Condition' => 'Condition',
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
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('WebsiteID',$this->WebsiteID);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Price',$this->Price,true);
		$criteria->compare('OriginalPrice',$this->OriginalPrice,true);
		$criteria->compare('ExpiredDate',$this->ExpiredDate,true);
		$criteria->compare('Purchases',$this->Purchases,true);
		$criteria->compare('ImageURL',$this->ImageURL,true);
		$criteria->compare('Address',$this->Address,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Condition',$this->Condition,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Xpath the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
