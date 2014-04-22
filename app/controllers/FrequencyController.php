<?php

class FrequencyController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='fullmenu';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','save','getdisciplines','getclasses'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

        
	public function actionSave()
	{        
            //@done s2 - modificar banco para adicionar schedule às faltas
            //@done s2 - regerar os modelos

            set_time_limit(0);
            ignore_user_abort();
        
            $classroomID = $_POST['classroom'];
            $disciplineID = $_POST['disciplines'];
            $month = $_POST['month'];
            $instructorFaults = isset($_POST['day'])?$_POST['day']:array();

            $infos = $this->actionGetClasses($classroomID, $disciplineID, $month);
            $classDays = $infos['days'];

            $disciplineID = ($disciplineID == "Todas as disciplinas")? null : $disciplineID;
            $allDisciolines = ($disciplineID == null);
            
            $classes = null;
            $classes = Frequency::model()->findAllByAttributes(array(
                'classroom_fk'=>$classroomID,
                'discipline_fk'=>$disciplineID,
                'month'=>$month));
            
            //cadastra novas aulas
            if($classes == null){
                $year = date('Y');
                $time = mktime(0, 0, 0, $month, 1, $year);

                $monthDays = date('t', $time);
                for ($day = 1; $day <= $monthDays; $day++) {
                    $time = mktime(0, 0, 0, $month, $day, $year);
                    $weekDay = date('w', $time);
                    $days = $classDays[$weekDay];
                    sort($days);
                    $classDays[$weekDay] = $days;

                    foreach ($days as $schedule) {
                        if ($schedule != 0) {
                            $class = new Frequency();
                            $class->classroom_fk = $classroomID;
                            $class->discipline_fk = $disciplineID;
                            $class->day = $day;
                            $class->month = $month;
                            $class->classtype = 'N';
                            $class->given_class = isset($instructorFaults[$day][$schedule])? 0 : 1;
                            $class->schedule = $schedule;

                            if ($class->validate() && $class->save()) {
                                array_push($classes, $class);
                            }
                        }
                    }
                }
            //atualiza aulas
            }else{
                foreach ($classes as $class) {
                    $day = $class->day;
                    $schedule = $class->schedule;
                    $class->given_class = isset($instructorFaults[$day][$schedule])? 0 : 1;
                    $class->save();
                }
            }
          
            $faults = array();
            //cadastrar faltas
            if(isset($_POST['student'])){
                $studentsFaults = $_POST['student'];
                foreach ($studentsFaults as $studentID => $fault) {
                    foreach($fault as $d => $day){
                        foreach($day as $schedule => $s){
                            $classID = null;
                            foreach($classes as $class){
                                if($class->day == $d && $class->schedule == $schedule){
                                    $classID = $class->id;
                                    break;
                                }
                            }
                            $fault = new ClassFaults;
                            $fault->class_fk = $classID;
                            $fault->student_fk = $studentID;
                            $fault->schedule = $schedule;
                            if ($fault->validate() && $fault->save()) {
                                array_push($faults, $fault);
                            }
                        }
                    }
                }
            }

            set_time_limit(30);
            $this->redirect(array('index'));
            
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $dataProvider = new CActiveDataProvider('Frequency');
            $model = new Frequency;
		$dataProvider=new CActiveDataProvider('Frequency');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
                        'model' => $model,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionGetDisciplines() {
            
            echo CHtml::tag('option', array('value' => null), CHtml::encode('Todas as disciplinas'), true);
            
            if(!isset($_POST['classroom']) || empty($_POST['classroom'])) {return true;}
            $classroom = Classroom::model()->findByPk($_POST['classroom']);
            
            $disciplines = array();
            $disciplinesLabels = array();
            $disciplines = ClassroomController::classroomDiscipline2array($classroom);
            $disciplinesLabels = ClassroomController::classroomDisciplineLabelArray();

            foreach ($disciplines as $i => $discipline) {
                if ($discipline != 0) {
                    echo CHtml::tag('option', array('value' => $i), CHtml::encode($disciplinesLabels[$i]), true);
                }
            }
        }
        
        public function actionGetClasses($classroom = null, $discipline = null, $month = null){
            $classroom = $classroom==null? $_POST['classroom'] : $classroom;
            $discipline = $discipline==null? $_POST['disciplines'] : $discipline;
            $month = $month == null? $_POST['month'] : $month;
            
            $discipline = ($discipline == "Todas as disciplinas") ? null : $discipline;
            $allDisciplines = ($discipline == null);
            
            $classes = null;

            $classes = Frequency::model()->findAllByAttributes(array(
                'classroom_fk'=>$classroom,
                'discipline_fk'=>$discipline,
                'month'=>$month));
            if($allDisciplines){
                $classboards = ClassBoard::model()->findAllByAttributes(array(
                    'classroom_fk'=>$classroom));
            }else{
                $classboards = ClassBoard::model()->findAllByAttributes(array(
                    'classroom_fk'=>$classroom,
                    'discipline_fk'=>$discipline));
            }
            
            
            $return = array('days'=> array(), 'faults'=> array(), 'students'=>array());
            
            $classDays = array();
            for($i=0; $i<=6;$i++){
                $classDays[$i] = array();
            }
            
            foreach($classboards as $cb){

                $schedulesStringArray = array();

                $schedulesStringArray[0] = $cb->week_day_sunday;
                $schedulesStringArray[1] = $cb->week_day_monday;
                $schedulesStringArray[2] = $cb->week_day_tuesday;
                $schedulesStringArray[3] = $cb->week_day_wednesday;
                $schedulesStringArray[4] = $cb->week_day_thursday;
                $schedulesStringArray[5] = $cb->week_day_friday;
                $schedulesStringArray[6] = $cb->week_day_saturday;

                for($i=0; $i<=6;$i++){
                    $temp = $schedulesStringArray[$i];
                    if ($temp == "") {
                        $temp = array();
                    }else{
                        $temp = $temp[0] == ';' ? substr($temp, 1) : $temp;
                        $temp = $temp[0] == '0' ? substr($temp, 1) : $temp;
                        $temp = $temp[0] == ';' ? substr($temp, 1) : $temp;

                        $temp = $temp == "" ? array() : explode(';', $temp);
                    }              
                    if(count($temp) >= 1){
                        if($allDisciplines){
                            $classDays[$i] = array(1);
                        }else{
                            $classDays[$i] = array_merge($classDays[$i], $temp);
                            $classDays[$i] = array_unique($classDays[$i]);
                        }
                    }else{
                        $classDays[$i] = ($classDays[$i] == array() || $classDays[$i] == array(0)) 
                                ? array(0) 
                                : $classDays[$i];
                    };
                }
            }
            
            $return['days'] = $classboards == null ? null : $classDays;
            
            if($classes == null){
                
                $cr = Classroom::model()->findByPk($classroom);
                
                //@done s2 - Trocar o ano atual pelo da turma
                $year = $cr->school_year; //$year = date('Y');
                $time = mktime(0,0,0,$month,1,$year);
                
                $monthDays = date('t', $time);
                for($day=1; $day<= $monthDays; $day++){
                    $time = mktime(0,0,0,$month,$day,$year);
                    $weekDay = date('w', $time);
                    $days = $classDays[$weekDay];
                    sort($days);
                    $classDays[$weekDay] = $days;
                }
            }
            else{
                foreach($classes as $c){
                    $schedule = $allDisciplines ? 1 : $c->schedule;
                    
                    if($c->given_class == 1){
                        $return['faults'][$c->day][$schedule] = isset($return['faults'][$c->day][$schedule])
                                                                 ? $return['faults'][$c->day][$schedule]
                                                                 : array();
                        
                        $faults = ClassFaults::model()->findAllByAttributes(array('class_fk' => $c->id, 'schedule' => $schedule));
                        
                        foreach($faults as $f){
                            $return['faults'][$c->day][$schedule] = isset($return['faults'][$c->day][$schedule])
                                                                     ? $return['faults'][$c->day][$schedule] 
                                                                     : array();
                            $return['faults'][$c->day][$schedule] = array_merge($return['faults'][$c->day][$schedule], array($f->student_fk));
                        }
                    }else{
                        $return['instructorFaults'][$c->day] = isset($return['instructorFaults'][$c->day])
                                                    ? $return['instructorFaults'][$c->day]
                                                    : array();
                        $return['instructorFaults'][$c->day] = array_merge($return['instructorFaults'][$c->day], array($schedule));
                    }
                }
            }
            
            $criteria = new CDbCriteria();   
            $criteria->with = array('studentFk');
            $criteria->together = true;
            $criteria->order = 'name';
            $enrollments = StudentEnrollment::model()->findAllByAttributes(array('classroom_fk' => $classroom),$criteria);
            $return['students'] = array();
            foreach($enrollments as $e){
                $return['students']['name'] = isset($return['students']['name'])
                                    ? $return['students']['name']
                                    : array();
                $return['students']['id'] = isset($return['students']['id'])
                                    ? $return['students']['id']
                                    : array();
                $return['students']['name'] = array_merge($return['students']['name'], array($e->studentFk->name));
                $return['students']['id'] = array_merge($return['students']['id'], array($e->student_fk));
            }
            echo json_encode($return);
            return $return;
        }

    /**
     * Manages all models.
     */
	public function actionAdmin()
	{
		$model=new Frequency('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Classes']))
			$model->attributes=$_GET['Classes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Classes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Frequency::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Classes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='classes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
