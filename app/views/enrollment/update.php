<div id="mainPage" class="main">
    <?php
$this->breadcrumbs=array(
	'Student Enrollments'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

    $title=Yii::t('default', 'Update StudentEnrollment: ');
    $contextDesc = Yii::t('default', 'Available actions that may be taken on StudentEnrollment.');
    $this->menu=array(
    array('label'=> Yii::t('default', 'Create a new StudentEnrollment'), 'url'=>array('create'),'description' => Yii::t('default', 'This action create a new StudentEnrollment')),
    array('label'=> Yii::t('default', 'List StudentEnrollment'), 'url'=>array('index'),'description' => Yii::t('default', 'This action list all Student Enrollments, you can search, delete and update')),
    );  
    ?>

    <div class="twoColumn">
        <div class="columnone" style="padding-right: 1em">
            <?php echo $this->renderPartial('_form', array('model'=>$model,'title'=>$title)); ?>        </div>
        <div class="columntwo">
            <?php //echo $this->renderPartial('////common/defaultcontext', array('contextDesc'=>$contextDesc)); ?>        </div>
    </div>
</div>