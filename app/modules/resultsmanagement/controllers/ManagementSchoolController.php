<?php

class ManagementSchoolController extends CController
{
	public $headerDescription = "";

	public function actionIndex($sid){
		$school = SchoolIdentification::model()->findByPk($sid);
		$this->render('index', ["school"=>$school,]);
	}

	public function actionPerformance($sid){
		$school = SchoolIdentification::model()->findByPk($sid);
		$media = 5;
		$efficiencies = [];
		for ($i = 1; $i <= 4; $i++){
			$unity = $i;
			$sql = "select b.grade, count(b.grade) count
					  from (select if(a.grade > :media+1, 1, if(a.grade <= :media+1 && a.grade >= :media, 0, -1)) grade
						from (select if(ifnull(g.grade$unity, 0) > :media , ifnull(g.grade$unity, 0), ifnull(g.recovery_grade$unity, 0)) grade from student_enrollment se
							left join grade g on g.enrollment_fk = se.id
							join classroom c on c.id = se.classroom_fk
						  where c.school_year = :year && c.school_inep_fk = :sid
						) a
					  ) b
					group by b.grade
					order by b.grade;";
			$efficiency = yii::app()->db->createCommand($sql)->queryAll(true, [
				":sid" => $sid,
				":year" => yii::app()->user->year,
				':media' => $media
			]);
			$efficiencies[$unity."º Bimestre"] = [];
			$efficiencies[$unity."º Bimestre"]["bad"]=0;
			$efficiencies[$unity."º Bimestre"]["regular"]=0;
			$efficiencies[$unity."º Bimestre"]["good"]=0;
			foreach($efficiency as $e){
				$grade = $e["grade"] == -1 ? "bad" : ($e["grade"] == 0 ? "regular" :  "good");
				$efficiencies[$unity."º Bimestre"][$grade] = $e["count"];
			}
		}$classrooms = Classroom::model()->findAll(["condition" => "school_inep_fk = :sid and school_year = :year", "order"=>"name", "params"=>[":sid"=> $sid,":year"=> yii::app()->user->year]]);
		$classroomOptions = [];
		foreach($classrooms as $classroom)
			$classroomOptions[$classroom->id] = CHtml::encode($classroom->name);
		$classroomOptions["all"] = yii::t("resultsmanagementModule.managementSchool","All Classrooms");
		$this->render('performance', ["school"=>$school,'efficiencies'=>$efficiencies, "classrooms"=>$classroomOptions]);
	}

	public function actionFrequency($sid){
		/* @var $classrooms Classroom[]*/
		$school = SchoolIdentification::model()->findByPk($sid);
		$classrooms = Classroom::model()->findAll(["condition" => "school_inep_fk = :sid and school_year = :year", "order"=>"name", "params"=>[":sid"=> $sid,":year"=> yii::app()->user->year]]);
		$classroomOptions = [];
		foreach($classrooms as $classroom)
			$classroomOptions[$classroom->id] = CHtml::encode($classroom->name);
		$classroomOptions["all"] = yii::t("resultsmanagementModule.managementSchool","All Classrooms");
		$this->render('frequency', ["school"=>$school, "classrooms"=>$classroomOptions]);
	}

	public function actionLoadClassroomInfos($sid,$cid){
		$results = null;
		if($cid == "all"){
			$sql = "SELECT distinct cs.month, IFNULL(d.id,'-1') did, IFNULL(d.name,'Disciplinas Fundamental Menor') discipline FROM classroom as c
					join class cs on (cs.classroom_fk = c.id)
					left join edcenso_discipline d on (cs.discipline_fk = d.id)
				where school_inep_fk = :sid and school_year = :year;";
			$results = yii::app()->db->createCommand($sql)->queryAll(true,[":sid"=>$sid, ":year"=>yii::app()->user->year]);
		}else if(!empty($cid)) {
			$sql = "SELECT distinct cs.month, IFNULL(d.id,'-1') did, IFNULL(d.name,'Disciplinas Fundamental Menor') discipline FROM classroom as c
					join class cs on (cs.classroom_fk = :cid)
					left join edcenso_discipline d on (cs.discipline_fk = d.id);";
			$results = yii::app()->db->createCommand($sql)->queryAll(true,[":cid"=>$cid]);
		}else{
			return false;
		}
		echo json_encode($results);
		return true;
	}

	public function actionLoadChartData($sid, $cid, $mid, $did){
		$cFilter = ($cid != "all" ? "and cr.id = :cid " : " ");
		$mFilter = ($mid != "all" ? "and month = :mid " : " ");
		$dFilter = ($did == "all" ? " " : ($did == "-1" ? " and d.id is null " : "and d.id  = :did "));
		$sql = "Select cr.id cid, cr.name cname, day, month,  d.id did, IFNULL(d.name,'Disciplinas Fundamental Menor') dname, count(cf.class_fk) as faults from class c
					left join class_faults cf on (c.id = cf.class_fk)
					join classroom cr on (cr.id = c.classroom_fk)
					left join edcenso_discipline d on (discipline_fk = d.id)
					where cr.school_year = :year and cr.school_inep_fk = :sid
					$cFilter
					$mFilter
					$dFilter
				group by c.day, c.month, c.discipline_fk
				order by c.month, c.day, c.discipline_fk;";
		$i = 0;
		$params = [":sid" => $sid,":year" => yii::app()->user->year,];
		($cid != "all" ? $params[":cid"] = $cid : $i );
		($mid != "all" ? $params[":mid"] = $mid : $i );
		($did != "all" && $did != "-1" ? $params[":did"] = $did : $i);
		$classes = yii::app()->db->createCommand($sql)->queryAll(true, $params);

		$sql = "Select count(*) from student_enrollment e
					join classroom cr on (cr.id = e.classroom_fk)
					where cr.school_year = :year and cr.school_inep_fk = :sid;";
		$enrollments = yii::app()->db->createCommand($sql)->queryScalar([":sid" => $sid,":year" => yii::app()->user->year,]);

		echo json_encode(["classes"=>$classes,"enrollments"=>$enrollments]);
	}

	public function actionLoadPerformanceClassroomInfos($sid,$cid){
		$results = null;
		$cFilter = ($cid != "all" ? ":cid" : "se.classroom_fk");
		$sql = "select distinct g.bimester unit, g.discipline_fk did, d.name discipline, se.classroom_fk cid from (
				   select grade1 grade, id, 'g1' bimester, discipline_fk, enrollment_fk from grade
				   union ( SELECT grade2 grade, id, 'g2' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT grade3 grade, id, 'g3' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT grade4 grade, id, 'g4' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT recovery_grade1 grade, id, 'r1' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT recovery_grade2 grade, id, 'r2' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT recovery_grade3 grade, id, 'r3' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT recovery_grade4 grade, id, 'r4' bimester, discipline_fk, enrollment_fk FROM grade)
				   union ( SELECT recovery_final_grade grade, id, 'rf' bimester, discipline_fk, enrollment_fk FROM grade)
				 ) g
				  JOIN student_enrollment se on g.enrollment_fk = se.id
				  JOIN classroom c on c.id = $cFilter
				  LEFT JOIN edcenso_discipline d on d.id = g.discipline_fk
				WHERE c.school_inep_fk = :sid && c.school_year = :year;";
		$params = [":sid"=>$sid,":year"=>yii::app()->user->year];
		if($cid != "all") $params[":cid"] = $cid;
		$results = yii::app()->db->createCommand($sql)->queryAll(true,$params);
		echo json_encode($results);
		return true;
	}

	public function actionLoadPerformanceChartData($sid, $cid, $bid, $did){
		$cFilter = ($cid == "all")? " ": " se.classroom_fk in ($cid) && ";
		$bFilter = ($bid == "all")? " ": " g.bimester in ($bid) && ";
		$dFilter = ($did == "all")? " ": " g.discipline_fk in ($did) && ";
		$sql = "select g.id, g.grade, g.bimester, g.discipline_fk did, g.enrollment_fk eid, se.classroom_fk cid from (
					select grade1 grade, id, 'g1' bimester, discipline_fk, enrollment_fk from grade
					union ( SELECT grade2 grade, id, 'g2' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT grade3 grade, id, 'g3' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT grade4 grade, id, 'g4' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT recovery_grade1 grade, id, 'r1' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT recovery_grade2 grade, id, 'r2' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT recovery_grade3 grade, id, 'r3' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT recovery_grade4 grade, id, 'r4' bimester, discipline_fk, enrollment_fk FROM grade)
					union ( SELECT recovery_final_grade grade, id, 'rf' bimester, discipline_fk, enrollment_fk FROM grade)
				) g
				  join student_enrollment se on g.enrollment_fk = se.id
				  join classroom c on c.id = se.classroom_fk
				where
					$cFilter
					$bFilter
					$dFilter
				  c.school_year = :year && c.school_inep_fk = :sid";

		$params = [":sid" => $sid,":year" => yii::app()->user->year,];
		$grades = yii::app()->db->createCommand($sql)->queryAll(true, $params);

		echo json_encode(["grades"=>$grades]);
	}



}



