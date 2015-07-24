<?php
/* @var $this CoursePlanController */
/* @var $model CoursePlan */
/* @var $form CActiveForm */
?>

<?php
$baseUrl = Yii::app()->baseUrl;
$themeUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl . '/js/courseplan/form/_initialization.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/courseplan/form/functions.js', CClientScript::POS_END);
$cs->registerScriptFile($baseUrl . '/js/courseplan/form/dialogs.js', CClientScript::POS_END);
$cs->registerScriptFile($themeUrl . '/js/jquery/jquery.dataTables.min.js', CClientScript::POS_END);
$cs->registerCssFile($themeUrl . '/css/jquery.dataTables.min.css');
$cs->registerCssFile($themeUrl . '/css/font-awesome.min.css');
$cs->registerCssFile($themeUrl . '/css/dataTables.fontAwesome.css');

$this->setPageTitle('TAG - ' . Yii::t('default', 'Classes Contents'));
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'course-plan-form',
    'enableAjaxValidation' => false,
    'action' => CHtml::normalizeUrl(array('classes/saveClassContents')),
        ));
$school = SchoolIdentification::model()->findByPk(Yii::app()->user->school);
?>

<?php echo $form->errorSummary($model); ?>

<div class="row-fluid hidden-print">
    <div class="span12">
        <h3 class="heading-mosaic"><?php echo Yii::t('default', 'Create Plan'); ?></h3>  
        <div class="buttons span9">
            <a id="save" class='btn btn-icon btn-primary glyphicons circle_ok hidden-print'><?php echo Yii::t('default', 'Save') ?><i></i></a>
        </div>
    </div>
</div>
<div class="innerLR  ">

    <?php if (Yii::app()->user->hasFlash('success')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success') ?>
        </div>
    <?php endif ?>
    <div class="widget widget-tabs border-bottom-none">

        <div class="widget-head  hidden-print">
            <ul class="tab-courseplan">
                <li id="tab-courseplan" class="active" ><a class="glyphicons book_open" href="#" data-toggle="tab"><i></i><?php echo Yii::t('default', 'Course Plan') ?></a></li>
            </ul>
        </div>

        <div class="widget-body form-horizontal">
            <div class="tab-content">
                <div class="tab-pane active" id="courseplan">
                    <div class="row-fluid">
                        <div class=" span5">
                            <div class="control-group">
                                <?php echo CHtml::label(yii::t('default', 'Stage'), 'stage', array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <?php
                                    echo CHtml::dropDownList('stage', '', CHtml::listData(EdcensoStageVsModality::model()->findAll(), 'id', 'name'), array(
                                        'key' => 'id',
                                        'class' => 'select-search-on span12',
                                        'prompt' => 'Selecione o estágio'
                                    ));
                                    ?>
                                </div>

                            </div>
                        </div>
                        <div class=" span5">
                            <div class="control-group">
                                <?php echo CHtml::label(yii::t('default', 'Disciplines'), 'disciplines', array('class' => 'control-label')); ?>

                                <div class="controls"><?php
                                    echo CHtml::dropDownList('disciplines', '', CHtml::listData(EdcensoDiscipline::model()->findAll(), 'id', 'name'), array(
                                        'key' => 'id',
                                        'class' => 'select-search-on span12',
                                        'prompt' => 'Selecione a disciplina',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class=" span10">
                            <div class="control-group">
                                <?php echo CHtml::label(yii::t('default', 'Name'), 'name', array('class' => 'control-label')); ?>
                                <div class="controls">
                                    <?php
                                    echo $form->textField($model, 'name', ['class' => 'span12']);
                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <table id="course-classes" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 10px;"></th>
                                <th class="span1"><?= Yii::t('default', 'Class'); ?></th>
                                <th class="span11"><?= Yii::t('default', 'Objective'); ?></th>
                                <th><?= Yii::t('default', 'Content'); ?></th>
                                <th><?= Yii::t('default', 'Resource'); ?></th>
                                <th><?= Yii::t('default', 'Type'); ?></th>
                                <th></th>
                            </tr>
                        </thead>        
                        <tbody>
                            <tr>
                                <td></td>
                                <td>1</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>2</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>3</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td>Bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla</td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th style="width: 10px;"><a href="#" id="new-course-class" class="btn btn-success btn-small"><i class="fa fa-plus-square"></i><?= Yii::t('default', 'New'); ?></a></th>

                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>

<!-- Modal -->
<div id="add-class-form" class="hide" title="<?php echo Yii::t('default', 'Add content'); ?>">
    <div class="row-fluid">
        <div class="span12">
            <div class="control-group">
                <?php echo CHtml::label(Yii::t('default', 'name'), 'add-content-name', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo CHtml::textField('add-content-name', ''); ?>
                </div>
            </div>
            <div class="control-group">
                <?php echo CHtml::label(Yii::t('default', 'description'), 'add-content-description', array('class' => 'control-label')); ?>
                <div class="controls">
                    <?php echo CHtml::textField('add-content-description', ''); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

<?php //@done s2 - não mostrar "Selecione a disciplina" como disciplina              ?>
<?php //@done s2 - inabilitar checkbox quando vier checado               ?>
<?php //@done s2 - desabilitar a coluna ao clicar em falta do professor              ?>
<?php //@done s2 - reabilitar apenas os que não estão checados               ?>
    var getClassesURL = "<?php echo Yii::app()->createUrl('classes/getClasses') ?>";
    var getContentsURL = "<?php echo Yii::app()->createUrl('classes/getContents') ?>";
    var saveContentURL = "<?php echo Yii::app()->createUrl('classes/saveContent') ?>";

    var btnCreate = "<?php echo Yii::t('default', 'Create'); ?>";
    var btnCancel = "<?php echo Yii::t('default', 'Cancel'); ?>";
    
    var labelClass      = "<?= Yii::t('default', 'Class');?>";
    var labelObjective  = "<?= Yii::t('default', 'Objective');?>";
    var labelContent    = "<?= Yii::t('default', 'Content');?>";
    var labelResource   = "<?= Yii::t('default', 'Resource');?>";
    var labelType       = "<?= Yii::t('default', 'Type');?>";

    var myAddContentForm;

</script>