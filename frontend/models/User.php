<?php

/**
 * This is the model class for table "pp_user".
 *
 * The followings are the available columns in table 'pp_user':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $created_date
 * @property string $last_login
 * @property integer $active
 * @property string $ip_address
 * @property string $modified_date
 * @property string $modified_by
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pp_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, first_name, last_name, created_date', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('username, first_name, last_name, ip_address', 'length', 'max'=>25),
			array('password, email', 'length', 'max'=>50),
			array('modified_by', 'length', 'max'=>20),
			array('last_login, modified_date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, first_name, last_name, created_date, last_login, active, ip_address, modified_date, modified_by', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'created_date' => 'Created Date',
			'last_login' => 'Last Login',
			'active' => 'Active',
			'ip_address' => 'Ip Address',
			'modified_date' => 'Modified Date',
			'modified_by' => 'Modified By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('modified_date',$this->modified_date,true);
		$criteria->compare('modified_by',$this->modified_by,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}