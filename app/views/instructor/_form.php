<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'instructor-form',
    'enableAjaxValidation' => false,
        ));
?>

<div class="heading-buttons">
    <?php
    echo $form->errorSummary($modelInstructorIdentification);
    echo $form->errorSummary($modelInstructorDocumentsAndAddress);
    echo isset($error['documentsAndAddress']) ? $error['documentsAndAddress'] : '';
    echo $form->errorSummary($modelInstructorVariableData);
    echo isset($error['variableData']) ? $error['variableData'] : '';
    echo $form->errorSummary($modelInstructorTeachingData);
  
    ?>
    
    <h3><?php echo $title; ?><span> | <?php echo Yii::t('default', 'Fields with * are required.') ?></span></h3>
    <div class="buttons pull-right">
        <button type="button" class="btn btn-icon btn-default glyphicons unshare"><i></i>Voltar</button>
        <?php echo CHtml::submitButton($modelInstructorIdentification->isNewRecord ? Yii::t('default', 'Create') : Yii::t('default', 'Save'), array('class' => 'btn btn-icon btn-primary glyphicons circle_ok')); ?>
    </div>
    <div class="clearfix"></div>
</div>

<div class="innerLR">

    <div class="widget widget-tabs border-bottom-none">

        <div class="widget-head">
            <ul>
                <li class="active"><a class="glyphicons edit" href="#instructor-indentify" data-toggle="tab"><i></i>Identificação</a></li>
                <li><a class="glyphicons settings" href="#instructor-documents" data-toggle="tab"><i></i>Documentos</a></li>
                <li><a class="glyphicons imac" href="#instructor-address" data-toggle="tab"><i></i>Endereço</a></li>
                <li><a class="glyphicons parents" href="#instructor-data" data-toggle="tab"><i></i>Dados Variáveis</a></li>
                <li><a class="glyphicons cutlery" href="#instructor-teaching" data-toggle="tab"><i></i>Dados de Ensino</a></li>
            </ul>
        </div>

        <div class="widget-body form-horizontal">
            <div class="tab-content">

                <!-- Tab content -->
                <div class="tab-pane active" id="instructor-indentify">
                    <div class="row-fluid">
                        <div class=" span6">
                            <?php echo Yii::t('default', 'Campos com * são obrigatórios.') ?>
                        </div>

                        <div class="separator"></div>



                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'Código da Escola–INEP'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorIdentification, 'school_inep_id_fk', CHtml::listData(
                                            SchoolIdentification::model()->findAll(), 'inep_id', 'name'), array(
                                'prompt' => 'Select School',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('Instructor/getClassroom'),
                                    'update' => '#InstructorTeachingData_classroom_id_fk',
                                    )));
                            ?>
                  
                            <?php echo $form->error($modelInstructorIdentification, 'school_inep_id_fk'); ?>
                        </div>

<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'Identificação única do Profissional escolar em sala de Aula(INEP)'); ?>
                            <?php echo $form->textField($modelInstructorIdentification, 'inep_id', array('size' => 12, 'maxlength' => 12), array('disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'inep_id'); ?>
                        </div> -->

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'Nome'); ?>
                            <?php echo $form->textField($modelInstructorIdentification, 'name', array('size' => 60, 'maxlength' => 100)); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'name'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'email'); ?>
                            <?php echo $form->textField($modelInstructorIdentification, 'email', array('size' => 60, 'maxlength' => 100)); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'email'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'nis'); ?>
                            <?php echo $form->textField($modelInstructorIdentification, 'nis', array('size' => 11, 'maxlength' => 11)); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'nis'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'birthday_date'); ?>
                            <?php echo $form->textField($modelInstructorIdentification, 'birthday_date', array('size' => 10, 'maxlength' => 10)); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'birthday_date'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'sex'); ?>
                            <?php echo $form->DropDownlist($modelInstructorIdentification, 'sex', array(1 => 'Masculino', 2 => 'Feminino')); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'sex'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'color_race'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorIdentification, 'color_race', array(0 => "Não Declarada",
                                1 => "Branca", 2 => "Preta", 3 => "Parda", 4 => "Amarela", 5 => "Indígena"));
                            ?>
                            <?php echo $form->error($modelInstructorIdentification, 'color_race'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'mother_name'); ?>
                            <?php echo $form->textField($modelInstructorIdentification, 'mother_name', array('size' => 60, 'maxlength' => 100)); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'mother_name'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'nationality'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorIdentification, 'nationality', array(1 => "Brasileira",
                                2 => "Brasileira nascido no Exterior ou Naturalizado", 3 => "Estrangeira"));
                            ?>
                            <?php echo $form->error($modelInstructorIdentification, 'nationality'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'edcenso_nation_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorIdentification, 'edcenso_nation_fk', CHtml::listData(EdcensoNation::model()->findAll(array('order' => 'name ASC')), 'id', 'name'), array('options' => array(76 => array('selected' => true))
                                , 'disabled' => 'true'));
                            ?>


                            <?php //echo $form->textField($modelInstructorIdentification,'edcenso_nation_fk');   ?>
                            <?php echo $form->error($modelInstructorIdentification, 'edcenso_nation_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'edcenso_uf_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorIdentification, 'edcenso_uf_fk', CHtml::listData(EdcensoUf::model()->findAll(), 'id', 'name'), array(
                                'prompt' => 'Select State',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('Instructor/getcities'),
                                    'update' => '#InstructorIdentification_edcenso_city_fk',
                                // 'data'=>array('edcenso_uf_fk'=>'js:this.value'),
                                    )));
                            ?>                    
                            <?php echo $form->error($modelInstructorIdentification, 'edcenso_uf_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'edcenso_city_fk'); ?>
                            <?php echo $form->DropDownList($modelInstructorIdentification, 'edcenso_city_fk', CHtml::listData(EdcensoCity::model()->findAllByAttributes(array('edcenso_uf_fk' => $modelInstructorIdentification->edcenso_uf_fk)), 'id', 'name')); ?>                    
                            <?php echo $form->error($modelInstructorIdentification, 'edcenso_city_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency'); ?>

                            <?php //echo $form->DropDownList($modelInstructorIdentification, 'deficiency', array(0 => "Não", 1 => "Sim"));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_blindness'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_blindness', array('disabled' => true)); ?>
                            <?php //echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_blindness', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_blindness'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_low_vision'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_low_vision', array('disabled' => true)); ?>
                            <?php // echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_low_vision', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_low_vision'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_deafness'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_deafness', array('disabled' => true)); ?>
                            <?php //echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_deafness', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_deafness'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_disability_hearing'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_disability_hearing', array('disabled' => true)); ?>
                            <?php //echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_disability_hearing', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_disability_hearing'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_deafblindness'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_deafblindness', array('disabled' => true)); ?>
                            <?php // echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_deafblindness', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_deafblindness'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_phisical_disability'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_phisical_disability', array('disabled' => true)); ?>
                            <?php //echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_phisical_disability', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_phisical_disability'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_intelectual_disability'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorIdentification, 'deficiency_type_intelectual_disability', array('disabled' => true)); ?>
                            <?php //echo $form->DropDownList($modelInstructorIdentification, 'deficiency_type_intelectual_disability', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_intelectual_disability'); ?>
                        </div>

                        <div class="formField">
                            <?php //echo $form->labelEx($modelInstructorIdentification, 'deficiency_type_multiple_disabilities');  ?>
                            <?php //echo $form->DropDownList('', array(0 => "Não", 1 => "Sim"),array('disabled'=>'disabled'));  ?>
                <!--                <select id="dt_multiple_disabilities" disabled="disabled">
                                   <option value="0">Não</option> 
                                   <option value="1">Sim</option> 
                                </select>-->
                            <?php echo $form->hiddenField($modelInstructorIdentification, 'deficiency_type_multiple_disabilities'); ?>
                            <?php echo $form->error($modelInstructorIdentification, 'deficiency_type_multiple_disabilities'); ?>
                        </div>
                    </div>
                </div>


                <div class="tab-pane" id="instructor-documents">
                    <div class="row-fluid">
                        <div class=" span6">
                            <?php echo Yii::t('default', 'Campos com * são obrigatórios.') ?>
                        </div>

                        <div class="separator"></div>


<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'school_inep_id_fk'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'school_inep_id_fk', array('size' => 8, 'maxlength' => 8)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'school_inep_id_fk'); ?>
                        </div>-->

<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'inep_id'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'inep_id', array('size' => 12, 'maxlength' => 12)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'inep_id'); ?>
                        </div>-->

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'cpf'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'cpf', array('size' => 11, 'maxlength' => 11)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'cpf'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'area_of_residence'); ?>
                            <?php echo $form->DropDownlist($modelInstructorDocumentsAndAddress, 'area_of_residence', array(1 => 'URBANA', 2 => 'RURAL')); ?>                    
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'area_of_residence'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'cep'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'cep', array('size' => 8, 'maxlength' => 8)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'cep'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'address'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'address', array('size' => 60, 'maxlength' => 100)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'address'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'address_number'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'address_number', array('size' => 10, 'maxlength' => 10)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'address_number'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'complement'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'complement', array('size' => 20, 'maxlength' => 20)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'complement'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'neighborhood'); ?>
                            <?php echo $form->textField($modelInstructorDocumentsAndAddress, 'neighborhood', array('size' => 50, 'maxlength' => 50)); ?>
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'neighborhood'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'edcenso_uf_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorDocumentsAndAddress, 'edcenso_uf_fk', CHtml::listData(EdcensoUf::model()->findAll(), 'id', 'name'), array(
                                'prompt' => 'Select State',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('Instructor/getcities'),
                                    'update' => '#InstructorDocumentsAndAddress_edcenso_city_fk',
                                // 'data'=>array('edcenso_uf_fk'=>'js:this.value'),
                                    )));
                            ?>                    
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'edcenso_uf_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorDocumentsAndAddress, 'edcenso_city_fk'); ?>
                            <?php echo $form->DropDownList($modelInstructorDocumentsAndAddress, 'edcenso_city_fk', CHtml::listData(EdcensoCity::model()->findAllByAttributes(array('edcenso_uf_fk' => $modelInstructorDocumentsAndAddress->edcenso_uf_fk)), 'id', 'name')); ?>                    
                            <?php echo $form->error($modelInstructorDocumentsAndAddress, 'edcenso_city_fk'); ?>
                        </div> 

                    </div>
                </div>

                <div class="tab-pane" id="instructor-address">
                    <div class="row-fluid">
                        <div class=" span6">
                            <?php echo Yii::t('default', 'Campos com * são obrigatórios.') ?>
                        </div>

                        <div class="separator"></div>
                    </div>
                </div>

                <div class="tab-pane" id="instructor-data">
                    <div class="row-fluid">
                        <div class=" span6">
                            <?php echo Yii::t('default', 'Campos com * são obrigatórios.') ?>
                        </div>

                        <div class="separator"></div>




<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'school_inep_id_fk'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'school_inep_id_fk', array('size' => 8, 'maxlength' => 8)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'school_inep_id_fk'); ?>
                        </div>-->

<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'inep_id'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'inep_id', array('size' => 12, 'maxlength' => 12)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'inep_id'); ?>
                        </div>-->

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'scholarity'); ?>
                            <?php
                            echo $form->DropDownlist($modelInstructorVariableData, 'scholarity', array(1 => 'Fundamental Incompleto', 2 => 'Fundamental Completo',
                                3 => 'Ensino Médio - Normal/Magistério', 4 => 'Ensino Médio - Normal/Magistério Indígena',
                                5 => 'Ensino Médio', 6 => 'Superior'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'scholarity'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_situation_1'); ?>
                            <?php echo $form->DropDownlist($modelInstructorVariableData, 'high_education_situation_1', array(1 => 'Concluído', 2 => 'Em andamento'), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_situation_1'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_formation_1'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'high_education_formation_1', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_formation_1'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_course_code_1_fk'); ?>
                            <?php
                            echo $form->DropDownlist($modelInstructorVariableData, 'high_education_course_code_1_fk', CHtml::listData(EdcensoCourseOfHigherEducation::model()->findAll(array('order' => 'id DESC')), 'id', 'name')
                                    , array('prompt' => 'Select Course 1', 'disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_course_code_1_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_initial_year_1'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'high_education_initial_year_1', array('size' => 4, 'maxlength' => 4, 'disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_initial_year_1'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_final_year_1'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'high_education_final_year_1', array('size' => 4, 'maxlength' => 4, 'disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_final_year_1'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_institution_type_1'); ?>
                            <?php echo $form->DropDownList($modelInstructorVariableData, 'high_education_institution_type_1', array(1 => "Pública", 2 => "Privada"), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_institution_type_1'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_institution_code_1_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_institution_code_1_fk', CHtml::listData(EdcensoCourseOfHigherEducation::model()->findAll(), 'id', 'name'), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_institution_code_1_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_situation_2'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_situation_2', array(
                                1 => 'Concluído', 2 => 'Em Andamento'
                                    ), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_situation_2'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_formation_2'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'high_education_formation_2', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_formation_2'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_course_code_2_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_course_code_2_fk', CHtml::listData(EdcensoCourseOfHigherEducation::model()->findAll(), 'id', 'name')
                                    , array('prompt' => 'Select Course 2', 'disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_course_code_2_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_initial_year_2'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'high_education_initial_year_2', array('size' => 4, 'maxlength' => 4, 'disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_initial_year_2'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_final_year_2'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'high_education_final_year_2', array('size' => 4, 'maxlength' => 4, 'disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_final_year_2'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_institution_type_2'); ?>
                            <?php echo $form->DropDownList($modelInstructorVariableData, 'high_education_institution_type_2', array(1 => "Pública", 2 => "Privada"), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_institution_type_2'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_institution_code_2_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_institution_code_2_fk', CHtml::listData(EdcensoCourseOfHigherEducation::model()->findAll(), 'id', 'name'), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_institution_code_2_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_situation_3'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_situation_3', array(
                                1 => 'Concluído', 2 => 'Em Andamento'
                                    ), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_situation_3'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_formation_3'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'high_education_formation_3', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_formation_3'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_course_code_3_fk'); ?>
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_course_code_3_fk', CHtml::listData(EdcensoCourseOfHigherEducation::model()->findAll(), 'id', 'name')
                                    , array('prompt' => 'Select Course 1', 'disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_course_code_3_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_initial_year_3'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'high_education_initial_year_3', array('size' => 4, 'maxlength' => 4, 'disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_initial_year_3'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_final_year_3'); ?>
                            <?php echo $form->textField($modelInstructorVariableData, 'high_education_final_year_3', array('size' => 4, 'maxlength' => 4, 'disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_final_year_3'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_institution_type_3'); ?>
                            <?php echo $form->DropDownList($modelInstructorVariableData, 'high_education_institution_type_3', array(1 => "Pública", 2 => "Privada"), array('disabled' => 'disabled')); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_institution_type_3'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'high_education_institution_code_3_fk'); ?> 
                            <?php
                            echo $form->DropDownList($modelInstructorVariableData, 'high_education_institution_code_3_fk', CHtml::listData(EdcensoCourseOfHigherEducation::model()->findAll(), 'id', 'name'), array('disabled' => 'disabled'));
                            ?>
                            <?php echo $form->error($modelInstructorVariableData, 'high_education_institution_code_3_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'post_graduation_specialization'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'post_graduation_specialization', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'post_graduation_specialization'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'post_graduation_master'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'post_graduation_master', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'post_graduation_master'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'post_graduation_doctorate'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'post_graduation_doctorate', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'post_graduation_doctorate'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'post_graduation_none'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'post_graduation_none', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'post_graduation_none'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_nursery'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_nursery', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_nursery'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_pre_school'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_pre_school', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_pre_school'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_basic_education_initial_years'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_basic_education_initial_years', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_basic_education_initial_years'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_basic_education_final_years'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_basic_education_final_years', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_basic_education_final_years'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_high_school'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_high_school', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_high_school'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_education_of_youth_and_adults'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_education_of_youth_and_adults', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_education_of_youth_and_adults'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_special_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_special_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_special_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_native_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_native_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_native_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_field_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_field_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_field_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_environment_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_environment_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_environment_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_human_rights_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_human_rights_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_human_rights_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_sexual_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_sexual_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_sexual_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_child_and_teenage_rights'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_child_and_teenage_rights', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_child_and_teenage_rights'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_ethnic_education'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_ethnic_education', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_ethnic_education'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_other'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_other', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_other'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorVariableData, 'other_courses_none'); ?>
                            <?php echo CHtml::activeCheckBox($modelInstructorVariableData, 'other_courses_none', array('disabled' => true)); ?>
                            <?php echo $form->error($modelInstructorVariableData, 'other_courses_none'); ?>
                        </div>

                    </div>
                </div>


                <div class="tab-pane" id="instructor-teaching">
                    <div class="row-fluid">
                        <div class=" span6">
                            <?php echo Yii::t('default', 'Campos com * são obrigatórios.') ?>
                        </div>

                        <div class="separator"></div>


<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'school_inep_id_fk'); ?>
                             <?php
                            echo $form->DropDownList($modelInstructorTeachingData, 'school_inep_id_fk', CHtml::listData(
                                            SchoolIdentification::model()->findAll(), 'inep_id', 'name'), array(
                                'prompt' => 'Select School',
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('Instructor/getClassroom'),
                                    'update' => '#InstructorTeachingData_classroom_id_fk',
                                    )));
                            ?>
                            <?php echo $form->error($modelInstructorTeachingData, 'school_inep_id_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'inep_id'); ?>
                            <?php echo $form->textField($modelInstructorTeachingData, 'inep_id', array('size' => 12, 'maxlength' => 12)); ?>
                            <?php echo $form->error($modelInstructorTeachingData, 'inep_id'); ?>
                        </div>-->

<!--                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'classroom_inep_id'); ?>
                            <?php echo $form->textField($modelInstructorTeachingData, 'classroom_inep_id', array('size' => 8, 'maxlength' => 8)); ?>
                            <?php echo $form->error($modelInstructorTeachingData, 'classroom_inep_id'); ?>
                        </div>-->

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'classroom_id_fk'); ?>
                            <?php echo $form->DropDownList($modelInstructorTeachingData, 'classroom_id_fk', CHtml::listData(
                            Classroom::model()->findAllByAttributes(array('school_inep_fk'=>$modelInstructorTeachingData->school_inep_id_fk)), 'id', 'name')); ?>
                            <?php echo $form->error($modelInstructorTeachingData, 'classroom_id_fk'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'role'); ?>
                            <?php
                            echo $form->DropDownlist($modelInstructorTeachingData, 'role', array(1 => 'Docente', 2 => 'Auxiliar/Assistente Educacional',
                                3 => 'Profissional/Monitor de Atividade Complementar',
                                4 => 'Tradutor Intérprete de LIBRAS'));
                            ?>                    
                            <?php echo $form->error($modelInstructorTeachingData, 'role'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'contract_type'); ?>        
                            <?php
                            echo $form->DropDownlist($modelInstructorTeachingData, 'contract_type', array(1 => 'Concursado/efetivo/estável', 2 => 'Contrato temporário',
                                3 => 'Contrato terceirizado',
                                4 => 'Contrato CLT'));
                            ?>  
                            <?php echo $form->error($modelInstructorTeachingData, 'contract_type'); ?>
                        </div>

                        <div class="formField">
                            <?php echo $form->labelEx($modelInstructorTeachingData, 'discipline_1_fk'); ?>
                            <?php
                            echo $form->DropDownlist($modelInstructorTeachingData, 'discipline_1_fk', CHtml::listData(
                                            EdcensoDiscipline::model()->findAll(), 'id', 'name')
                                    , array('multiple'=>true, 'key'=>'id'));
                            ?>
                            <?php echo $form->error($modelInstructorTeachingData, 'discipline_1_fk'); ?>
                        </div>
                    </div> 
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    //==============INSTRUCTOR IDENTIFICATION
    var formInstructorIdentification = '#InstructorIdentification_';
    $(document).ready(function(){
        $(formInstructorIdentification+'birthday_date').mask("99/99/9999");
        
        $(formInstructorIdentification +'name,'+formInstructorIdentification +'mother_name').on('focusout', function(){
            $(this).val($(this).val().toUpperCase());
            var isValidate = validateNamePerson(this.value);
            if(!isValidate[0]){
                $(this).attr('value','');
            }
        });
        $(formInstructorIdentification+'email').on('focusout', function(){
            $(this).val($(this).val().toUpperCase());
            if(!validateEmail($(this).val())) 
                $(this).attr('value','');
        });
        
        $(formInstructorIdentification+'birthday_date').on('focusout', function(){
            $(this).val($(this).val().toUpperCase());
            if(!validadeBirthdayPerson(this.value)) 
                $(this).attr('value','');
        });
        
        $(formInstructorIdentification+'nationality').on('change', function(){
            if($(this).val() == 3) { // ESTRANGEIRO
                $(formInstructorIdentification+'edcenso_nation_fk').removeAttr('disabled');
            }else{
                $(formInstructorIdentification+'edcenso_nation_fk').val(76);
                $(formInstructorIdentification+'edcenso_nation_fk').add().attr('disabled','disabled');
            }
            
            if($(this).val() != 1) {
                $(formInstructorIdentification+'edcenso_uf_fk').add().attr('disabled','disabled');
                $(formInstructorIdentification+'edcenso_uf_fk').val('');
                $(formInstructorIdentification+'edcenso_city_fk').add().attr('disabled','disabled');
                $(formInstructorIdentification+'edcenso_city_fk').val('');
            }else{
                $(formInstructorIdentification+'edcenso_uf_fk').removeAttr('disabled'); 
                $(formInstructorIdentification+'edcenso_city_fk').removeAttr('disabled');
            }
                
        });
        
        $(formInstructorIdentification+'deficiency').on('change', function(){
            if($(this).val()==1) { 
                $(formInstructorIdentification+'deficiency_type_blindness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_low_vision').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_deafness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_disability_hearing').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_phisical_disability').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_intelectual_disability').removeAttr('disabled');
                //Troca o Valor
                $(this).val(0);
            }else{
                $(formInstructorIdentification+'deficiency_type_blindness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_low_vision').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_disability_hearing').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_phisical_disability').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_intelectual_disability').add().attr('disabled','disabled'); 
                $(this).val(1);
            }
        }); 
        
        $(formInstructorIdentification+'deficiency_type_blindness').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }         
               
            if($(this).val() == 1) { // 
                $(formInstructorIdentification+'deficiency_type_low_vision').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafblindness').add().attr('disabled','disabled');
                $(this).val(0);
            }else{
                $(formInstructorIdentification+'deficiency_type_low_vision').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_deafness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').removeAttr('disabled'); 
                $(this).val(1);                           
            }
        });
        
        $(formInstructorIdentification+'deficiency_type_low_vision').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }   
            if($(this).val() == 1) { // 
                $(formInstructorIdentification+'deficiency_type_blindness').val(0);
                $(formInstructorIdentification+'deficiency_type_blindness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafblindness').add().attr('disabled','disabled'); 
                $(this).val(0);
            }else{
                $(formInstructorIdentification+'deficiency_type_blindness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').removeAttr('disabled');
                $(this).val(1);          
            }
        });
        
        $(formInstructorIdentification+'deficiency_type_deafness').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }   
            if($(this).val() == 1) { // 
                $(formInstructorIdentification+'deficiency_type_blindness').val(0);
                $(formInstructorIdentification+'deficiency_type_blindness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_disability_hearing').val(0);
                $(formInstructorIdentification+'deficiency_type_disability_hearing').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafblindness').add().attr('disabled','disabled');  
                $(this).val(0);
            }else{
                $(formInstructorIdentification+'deficiency_type_blindness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_disability_hearing').removeAttr('disabled');      
                $(formInstructorIdentification+'deficiency_type_deafblindness').removeAttr('disabled');
                $(this).val(1);
            }
        });
        
        $(formInstructorIdentification+'deficiency_type_disability_hearing').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }      
            if($(this).val() == 1) { // 
                $(formInstructorIdentification+'deficiency_type_deafness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_disability_hearing').val(0);
                $(formInstructorIdentification+'deficiency_type_disability_hearing').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafblindness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafblindness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_blindness').val(0);
                $(formInstructorIdentification+'deficiency_type_blindness').add().attr('disabled','disabled'); 
                $(this).val(0);
            }else{
                $(formInstructorIdentification+'deficiency_type_deafness').removeAttr('disabled');    
                $(formInstructorIdentification+'deficiency_type_deafblindness').removeAttr('disabled');
                $(formInstructorIdentification+'deficiency_type_deafness').removeAttr('disabled');    
                $(formInstructorIdentification+'deficiency_type_deafblindness').removeAttr('disabled');
                $(this).val(1);
                
                
            }
        }); 
        $(formInstructorIdentification+'deficiency_type_deafblindness').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }       
            
            if($(this).val() == 1) { // 
                $(formInstructorIdentification+'deficiency_type_blindness').val(0);
                $(formInstructorIdentification+'deficiency_type_blindness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_low_vision').val(0);
                $(formInstructorIdentification+'deficiency_type_low_vision').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_deafness').val(0);
                $(formInstructorIdentification+'deficiency_type_deafness').add().attr('disabled','disabled');
                $(formInstructorIdentification+'deficiency_type_disability_hearing').val(0);
                $(formInstructorIdentification+'deficiency_type_disability_hearing').add().attr('disabled','disabled'); 
                $(this).val(0);
            }else{
                $(formInstructorIdentification+'deficiency_type_blindness').removeAttr('disabled');    
                $(formInstructorIdentification+'deficiency_type_low_vision').removeAttr('disabled'); 
                $(formInstructorIdentification+'deficiency_type_deafness').removeAttr('disabled');    
                $(formInstructorIdentification+'deficiency_type_disability_hearing').removeAttr('disabled');
                $(this).val(1);
            }
        });
    
        $(formInstructorIdentification+'deficiency_type_phisical_disability').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }    
        });
       
        $(formInstructorIdentification+'deficiency_type_intelectual_disability').on('click', function(){
            if(($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1) 
                || ($(formInstructorIdentification+'deficiency_type_blindness').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_deafblindness').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_deafness').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_low_vision').val()==1 && $(formInstructorIdentification+'deficiency_type_disability_hearing').val()==1)
                || ($(formInstructorIdentification+'deficiency_type_phisical_disability').val()==1 && $(formInstructorIdentification+'deficiency_type_intelectual_disability').val()==1)
        ) {
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(1);
            }else{
                $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val(0);
            }    
        });
    
        
        //        $('#dt_multiple_disabilities').on('change', function(){
        //            $(formInstructorIdentification+'deficiency_type_multiple_disabilities').val($(this).val());
        //        });
        //        
        //          $(formInstructorIdentification+'deficiency_type_multiple_disabilities').on('change', function(){
        //            $('#dt_multiple_disabilities').val($(this).val());
        //        });
        
        //=============================================
   
        //==============INSTRUCTOR DOCUMENTS AND ADRESS
        var formDocumentsAndAddress = '#InstructorDocumentsAndAddress_';

        $(formDocumentsAndAddress+'cpf').on('change',function(){
            var isValidate = validateCpf(this.value);
            if(!isValidate){
                $(this).attr('value','');
            }
        });
       
        $(formDocumentsAndAddress+'cep').focusout(function() { 
            if(!validateCEP($(this).val())){
                $(this).attr('value',''); 
                $(formDocumentsAndAddress+'address').add().attr('disabled','disabled');
                $(formDocumentsAndAddress+'address_number').add().attr('disabled','disabled');
                $(formDocumentsAndAddress+'neighborhood').add().attr('disabled','disabled');
                $(formDocumentsAndAddress+'complement').add().attr('disabled','disabled');
                $(formDocumentsAndAddress+'edcenso_uf_fk').add().attr('disabled','disabled');
                $(formDocumentsAndAddress+'edcenso_city_fk').add().attr('disabled','disabled');
            }else{
                $(formDocumentsAndAddress+'address').val(null);
                $(formDocumentsAndAddress+'address').removeAttr('disabled');
                $(formDocumentsAndAddress+'address_number').val(null);
                $(formDocumentsAndAddress+'address_number').removeAttr('disabled');
                $(formDocumentsAndAddress+'neighborhood').val(null);
                $(formDocumentsAndAddress+'neighborhood').removeAttr('disabled');
                $(formDocumentsAndAddress+'complement').val(null);
                $(formDocumentsAndAddress+'complement').removeAttr('disabled');
                $(formDocumentsAndAddress+'edcenso_uf_fk').val(null);
                $(formDocumentsAndAddress+'edcenso_uf_fk').removeAttr('disabled');
                $(formDocumentsAndAddress+'edcenso_city_fk').val(null);
                $(formDocumentsAndAddress+'edcenso_city_fk').removeAttr('disabled');  
                
            } 
                
        });
        
        $(formDocumentsAndAddress+'address').focusout(function() { 
            $(this).val($(this).val().toUpperCase());
            if(!validateInstructorAddress($(this).val())) 
                $(this).attr('value','');
        });
        $(formDocumentsAndAddress+'address_number').focusout(function() { 
            $(this).val($(this).val().toUpperCase());
            if(!validateInstructorAddressNumber($(this).val())) 
                $(this).attr('value','');
        });
        $(formDocumentsAndAddress+'neighborhood').focusout(function() { 
            $(this).val($(this).val().toUpperCase());
            if(!validateInstructorAddressNeighborhood($(this).val())) 
                $(this).attr('value','');
        });
        $(formDocumentsAndAddress+'complement').focusout(function() { 
            $(this).val($(this).val().toUpperCase());
            if(!validateInstructorAddressComplement($(this).val())) 
                $(this).attr('value','');
        });
        //=============================================
      
        //==============INSTRUCTOR VARIABLE DATA
        var formInstructorvariableData = "#InstructorVariableData_";  
   
        $('#InstructorVariableData_high_education_initial_year_1, \n\
#InstructorVariableData_high_education_initial_year_2,\n\
#InstructorVariableData_high_education_initial_year_3').on('change',function(){
            if(this.value.length == 4){
                var data = new Date();
                if(!anoMinMax(2002,data.getFullYear(),this.value)){
                    $(this).attr('value','');
                }
            }
        });   
        $('#InstructorVariableData_high_education_final_year_1,\n\
#InstructorVariableData_high_education_final_year_2,\n\
#InstructorVariableData_high_education_final_year_3').on('change',function(){
            if(this.value.length == 4){
                var data = new Date();
                if(!anoMinMax(1941,data.getFullYear(),this.value)) {
                    $(this).attr('value','');
                }
            } 
        }); 
        
        $(formInstructorvariableData+'scholarity').on('change', function(){
            if($(this).val() == 6) { 
                $(formInstructorvariableData+'high_education_situation_1').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_formation_1').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_course_code_1_fk').removeAttr('disabled');
          
                $(formInstructorvariableData+'high_education_final_year_1').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_institution_type_1').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_institution_code_1_fk').removeAttr('disabled');
                
                $(formInstructorvariableData+'high_education_situation_2').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_formation_2').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_course_code_2_fk').removeAttr('disabled');
               
                $(formInstructorvariableData+'high_education_final_year_2').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_institution_type_2').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_institution_code_2_fk').removeAttr('disabled');
                
                $(formInstructorvariableData+'high_education_situation_3').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_formation_3').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_course_code_3_fk').removeAttr('disabled');
               
                $(formInstructorvariableData+'high_education_final_year_3').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_institution_type_3').removeAttr('disabled');
                $(formInstructorvariableData+'high_education_institution_code_3_fk').removeAttr('disabled');
                
                $(formInstructorvariableData+'post_graduation_specialization').removeAttr('disabled');
                $(formInstructorvariableData+'post_graduation_master').removeAttr('disabled');
                $(formInstructorvariableData+'post_graduation_doctorate').removeAttr('disabled');
                $(formInstructorvariableData+'post_graduation_none').removeAttr('disabled');
                
                $(formInstructorvariableData+'other_courses_nursery').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_pre_school').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_basic_education_initial_years').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_basic_education_final_years').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_high_school').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_education_of_youth_and_adults').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_special_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_native_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_field_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_environment_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_human_rights_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_sexual_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_child_and_teenage_rights').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_ethnic_education').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_other').removeAttr('disabled');
                $(formInstructorvariableData+'other_courses_none').removeAttr('disabled');
                
                //Troca o Valor
                //$(this).val(0);
            }else{
                
                $(formInstructorvariableData+'high_education_situation_1').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_formation_1').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_course_code_1_fk').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_initial_year_1').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_final_year_1').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_institution_type_1').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_institution_code_1_fk').add().attr('disabled','disabled');
                
                $(formInstructorvariableData+'high_education_situation_2').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_formation_2').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_course_code_2_fk').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_initial_year_2').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_final_year_2').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_institution_type_2').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_institution_code_2_fk').add().attr('disabled','disabled');
                
                $(formInstructorvariableData+'high_education_situation_3').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_formation_3').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_course_code_3_fk').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_initial_year_3').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_final_year_3').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_institution_type_3').add().attr('disabled','disabled');
                $(formInstructorvariableData+'high_education_institution_code_3_fk').add().attr('disabled','disabled');
                
                $(formInstructorvariableData+'post_graduation_specialization').add().attr('disabled','disabled');
                $(formInstructorvariableData+'post_graduation_master').add().attr('disabled','disabled');
                $(formInstructorvariableData+'post_graduation_doctorate').add().attr('disabled','disabled');
                $(formInstructorvariableData+'post_graduation_none').add().attr('disabled','disabled');
                
                $(formInstructorvariableData+'other_courses_nursery').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_pre_school').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_basic_education_initial_years').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_basic_education_final_years').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_high_school').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_education_of_youth_and_adults').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_special_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_native_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_field_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_environment_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_human_rights_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_sexual_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_child_and_teenage_rights').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_ethnic_education').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_other').add().attr('disabled','disabled');
                $(formInstructorvariableData+'other_courses_none').add().attr('disabled','disabled');
    

            }
            
            $(formInstructorvariableData + 'high_education_situation_1').on('change', function(){
                if($(this).val() == 1) { // Concluído
                    $(formInstructorvariableData + 'high_education_initial_year_1').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'high_education_final_year_1').removeAttr('disabled');
                }else{ // Em Andamento
                    $(formInstructorvariableData + 'high_education_initial_year_1').removeAttr('disabled');     
                    $(formInstructorvariableData + 'high_education_final_year_1').add().attr('disabled','disabled');
                }
                           
            });
            
            $(formInstructorvariableData + 'high_education_situation_2').on('change', function(){
                if($(this).val() == 1) { // Concluído
                    $(formInstructorvariableData + 'high_education_initial_year_2').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'high_education_final_year_2').removeAttr('disabled');
                }else{ // Em Andamento
                    $(formInstructorvariableData + 'high_education_initial_year_2').removeAttr('disabled');     
                    $(formInstructorvariableData + 'high_education_final_year_2').add().attr('disabled','disabled');
                }
                           
            });
            
            $(formInstructorvariableData + 'high_education_situation_3').on('change', function(){
                if($(this).val() == 1) { // Concluído
                    $(formInstructorvariableData + 'high_education_initial_year_3').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'high_education_final_year_3').removeAttr('disabled');
                }else{ // Em Andamento
                    $(formInstructorvariableData + 'high_education_initial_year_3').removeAttr('disabled');     
                    $(formInstructorvariableData + 'high_education_final_year_3').add().attr('disabled','disabled');
                }
                           
            });
            
            $(formInstructorvariableData + 'high_education_course_code_1_fk').on('change',function(){
                var course = $(formInstructorvariableData + 'high_education_course_code_1_fk option:selected').text();
                course = course.toUpperCase();
                var beforelicenciatura = course.split('LICENCIATURA')[0];
                if(course != beforelicenciatura) {
                    // Se é diferente então encontrou a palavra Licenciatura
                    $(formInstructorvariableData + 'high_education_formation_1').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'high_education_formation_1').removeAttr('disabled');
                }
            }); 
           
            $(formInstructorvariableData + 'high_education_course_code_2_fk').on('change',function(){
                var course = $(formInstructorvariableData + 'high_education_course_code_2_fk option:selected').text();
                course = course.toUpperCase();
                var beforelicenciatura = course.split('LICENCIATURA')[0];
                if(course != beforelicenciatura) {
                    // Se é diferente então encontrou a palavra Licenciatura
                    $(formInstructorvariableData + 'high_education_formation_2').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'high_education_formation_2').removeAttr('disabled');
                }
            });
           
            $(formInstructorvariableData + 'high_education_course_code_3_fk').on('change',function(){
                var course = $(formInstructorvariableData + 'high_education_course_code_3_fk option:selected').text();
                course = course.toUpperCase();
                var beforelicenciatura = course.split('LICENCIATURA')[0];
                if(course != beforelicenciatura) {
                    // Se é diferente então encontrou a palavra Licenciatura
                    $(formInstructorvariableData + 'high_education_formation_3').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'high_education_formation_3').removeAttr('disabled');
                }
            });
            
            
            
            $(formInstructorvariableData + 'post_graduation_specialization').on('change',function(){           
                if($(this).is(':checked')) {
                    $(formInstructorvariableData + 'post_graduation_master').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_doctorate').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_none').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'post_graduation_master').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_doctorate').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_none').removeAttr('disabled');
                } 
            });
            $(formInstructorvariableData + 'post_graduation_master').on('change',function(){           
                if($(this).is(':checked')) {
                    $(formInstructorvariableData + 'post_graduation_specialization').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_doctorate').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_none').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'post_graduation_specialization').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_doctorate').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_none').removeAttr('disabled');
                } 
            });
            $(formInstructorvariableData + 'post_graduation_doctorate').on('change',function(){           
                if($(this).is(':checked')) {
                    $(formInstructorvariableData + 'post_graduation_specialization').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_master').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_none').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'post_graduation_specialization').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_master').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_none').removeAttr('disabled');
                } 
            });
            $(formInstructorvariableData + 'post_graduation_none').on('change',function(){           
                if($(this).is(':checked')) {
                    $(formInstructorvariableData + 'post_graduation_specialization').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_master').add().attr('disabled','disabled');
                    $(formInstructorvariableData + 'post_graduation_doctorate').add().attr('disabled','disabled');
                }else{
                    $(formInstructorvariableData + 'post_graduation_specialization').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_master').removeAttr('disabled');
                    $(formInstructorvariableData + 'post_graduation_doctorate').removeAttr('disabled');
                } 
            });
            
            
            
            
             
        }); 

        //=============================================
        //==============INSTRUCTOR TEACHING DATA
        var formInstructorTeachingData = '#InstructorTeachingData_';
            $(formInstructorTeachingData+"discipline_1_fk").change(function(){
            while($(this).val().length > 13){
                $(formInstructorTeachingData+"discipline_1_fk").val($(formInstructorTeachingData+"discipline_1_fk"));
                alert('Máximo de disciplinas: 13')
            }
        });
        
        var compAct = [];
        
        $(formInstructorTeachingData+"discipline_1_fk").mousedown(function(){
            compAct = $(this).val();
        });
        
        $(formInstructorTeachingData+"discipline_1_fk").mouseup(function(e){
            if (!e.shiftKey){
                value = $(this).val()[0];
                
                remove = 0;
                compAct = jQuery.grep(compAct, function( a ) {
                    if(a === value) remove++;
                    return a !== value;
                });
                
                if(remove == 0) compAct.push(value);
                $(this).val(compAct);
            }
        });
        
        $(formInstructorTeachingData+"discipline_1_fk").keypress(function(e) {
            console.log();
        });
        //=============================================
        
    });
    
    
 
    
</script>

