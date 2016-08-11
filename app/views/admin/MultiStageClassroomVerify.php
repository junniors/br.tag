<?php
/* @var $this AdminController */
/* @var $student mixed */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/admin/MultiStageClassroomVerify/_initialization.js', CClientScript::POS_END);
$cs->registerScript("vars",
    "var saveMultiStage = '" . $this->createUrl("saveMultiStage") . "'; ", CClientScript::POS_HEAD);
$this->setPageTitle('TAG - ' . Yii::t('default', 'Reports'));

?>

<div class="row-fluid">
	<div class="span12">
        <div class="buttons span9">
            	<a id="save" class='btn btn-icon btn-primary last glyphicons circle_ok'><?php echo Yii::t('default', 'Save') ?><i></i></a>
 		</div>
 	</div> 
</div> 			


<div class="innerLR">
    <p><b>Escola: </b><?= $school->inep_id ?>-<?= $school->name ?></p>

    <p><b>Estado: </b><? echo $school->edcensoUfFk->name; ?></p>

    <p><b>Munic&iacute;pio:</b> <? echo $school->edcensoCityFk->name; ?> </p>

    <p><b>Localiza&ccedil;&atilde;o:</b> <? echo $school->location == 0 ? "Rural" : "Urbana" ?> </p>

    <p><b>Depend&ecirc;ncia Administrativa:</b> <? echo $school->administrative_dependence == 1 ? "Federal" :
            $school->administrative_dependence == 2 ? "Estadual" :
                $school->administrative_dependence == 3 ? "Municipal" : "Estadual"
        ?> <br> </p>

<?



if(count($student) == 0){
	echo "<br><span class='alert alert-primary'> Todos os alunos tiveram a etapa individual configurada para uma turma multi-etapa </span>";
}else{
	echo "<br><span class='alert alert-primary'>Os seguintes alunos não tiveram a etapa individual configurada para uma turma multi-etapa: </span>";

	$ordem = 1;

		$html = "";
        $html .= "<table class= 'table table-bordered table-striped'  style=margin-top:20px;>  ";
        $html .= "<tr>"
            . "<th> <b>Ordem </b> </th>"
            . "<th> <b>Nome Completo </b></th>"
            . "<th> <b> Nome da Turma </b></th>"
            . "<th> <b> Etapa da Turma </b></th>"
            . "<th> <b> Etapa Individual </b></th>"
            . "</tr>";
        echo $html;
        $html = "";

	 foreach ($student as $s) {
	 	 $html .= "<tr>"
               . "<td>" . $ordem . "</td>"
               . "<td>" . $s['studentName'] . "</td>"
               . "<td>" . $s['className'] . "</td>"
               . "<td>" . $s['stage'] . "</td>";
         $html .= "<td>" . "<select data-student-id = '".$s['studentId']."' id = 'stage-value". $ordem. "' class = 'stage-value'>" . "<option value='null'>Selecione...</option> ";
		    foreach ($stage as $st) {
		        $html .=  "<option value = " . $st['id'] . ">" . $st['name'] . "</option>";
		    }

            $html .=  "</select>" . "</td>";
        $ordem++;
	}
	$html .= "</table></div>";
    echo $html;
}

?>

</div>