<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $ID
 * @property string $URL
 * @property string $Message
 * @property string $Code
 * @property string $File
 * @property string $Line
 * @property string $Trace
 * @property string $Time
 * @property string $Status
 */
class Log extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('URL, Message, Code, File, Line, Trace, Time', 'required'),
			array('URL', 'length', 'max'=>1000),
			array('Code, Line, Status', 'length', 'max'=>10),
			array('File', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, URL, Message, Code, File, Line, Trace, Time, Status', 'safe', 'on'=>'search'),
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
			'Message' => 'Message',
			'Code' => 'Code',
			'File' => 'File',
			'Line' => 'Line',
			'Trace' => 'Trace',
			'Time' => 'Time',
			'Status' => 'Status',
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
		$criteria->compare('Message',$this->Message,true);
		$criteria->compare('Code',$this->Code,true);
		$criteria->compare('File',$this->File,true);
		$criteria->compare('Line',$this->Line,true);
		$criteria->compare('Trace',$this->Trace,true);
		$criteria->compare('Time',$this->Time,true);
		$criteria->compare('Status',$this->Status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Log the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function getStatus($status)
	{
		if($status == 'new'){
			return CHtml::label($status, true, array("class" => "badge badge-warning"));
		}else{
			return CHtml::label($status, true, array("class" => "badge badge-info"));
		}
	}

	public static function getTrace($trace)
	{
		$lines = explode(';', $trace);
		$results = '';
		foreach ($lines as $line) {
			$results .= '<p>' . $line . '</p>';			
		}

		return $results;
	}
}
