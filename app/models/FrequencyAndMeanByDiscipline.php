<?php

/**
 * This is the model class for table "frequency_and_mean_by_discipline".
 *
 * The followings are the available columns in table 'frequency_and_mean_by_discipline':
 * @property integer $id
 * @property integer $enrollment_fk
 * @property double $annual_average
 * @property double $final_average
 * @property integer $school_days
 * @property integer $absences
 * @property double $frequency
 *
 * The followings are the available model relations:
 * @property StudentEnrollment $enrollmentFk
 */
class FrequencyAndMeanByDiscipline extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'frequency_and_mean_by_discipline';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enrollment_fk, school_days, absences', 'required'),
			array('enrollment_fk, school_days, absences', 'numerical', 'integerOnly'=>true),
			array('annual_average, final_average, frequency', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, enrollment_fk, annual_average, final_average, school_days, absences, frequency', 'safe', 'on'=>'search'),
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
			'enrollmentFk' => array(self::BELONGS_TO, 'StudentEnrollment', 'enrollment_fk'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'enrollment_fk' => 'Enrollment Fk',
			'annual_average' => 'Annual Average',
			'final_average' => 'Final Average',
			'school_days' => 'School Days',
			'absences' => 'Absences',
			'frequency' => 'Frequency',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('enrollment_fk',$this->enrollment_fk);
		$criteria->compare('annual_average',$this->annual_average);
		$criteria->compare('final_average',$this->final_average);
		$criteria->compare('school_days',$this->school_days);
		$criteria->compare('absences',$this->absences);
		$criteria->compare('frequency',$this->frequency);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FrequencyAndMeanByDiscipline the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}