<?php

/**
 * This is the model class for table "website".
 *
 * The followings are the available columns in table 'website':
 * @property integer $ID
 * @property string $Name
 * @property string $URL
 * @property string $LastCrawl
 *
 * The followings are the available model relations:
 * @property Categoryurl[] $categoryurls
 * @property Item[] $items
 * @property Xpath[] $xpaths
 */
class Website extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'website';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name, URL, LastCrawl', 'required'),
			array('Name, URL', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, Name, URL, LastCrawl', 'safe', 'on'=>'search'),
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
			'categoryurls' => array(self::HAS_MANY, 'Categoryurl', 'WebsiteID'),
			'items' => array(self::HAS_MANY, 'Item', 'Website'),
			'xpaths' => array(self::HAS_MANY, 'Xpath', 'WebsiteID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Name' => 'Name',
			'URL' => 'Url',
			'LastCrawl' => 'Last Crawl',
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
		$criteria->compare('URL',$this->URL,true);
		$criteria->compare('LastCrawl',$this->LastCrawl,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Website the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public static function getWebsiteName($id){
		$website = Website::model()->findByPk($id);
		if($website !== NULL){
			return $website->Name;
		}
		return NULL;
	}
}
