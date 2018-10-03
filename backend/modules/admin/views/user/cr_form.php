<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model backend\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-form">
	<ul class="nav nav-tabs" role="tablist" id="user-tabs">
		<li class="active"><a href="#basic" aria-controls="basic" role="tab" date-toggle="tab">Основное</a></li>
		<li><a href="#additionally" aria-controls="additionally" role="tab" date-toggle="tab">Дополнительно</a></li>
		<li><a href="#journal" aria-controls="journal" role="tab" date-toggle="tab">Журнал</a></li>
	</ul>
	
		

		<?php $form = ActiveForm::begin(['id' => $model->formName(), 'type' => ActiveForm::TYPE_HORIZONTAL, 'enableAjaxValidation' => true]); ?>
			 <div class="panel">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="basic">

					<!-- USERNAME -->
						<div class="form-group">
							<div class="col-sm-3" style="text-align: left">
				                <?= Html::activeLabel($model, 'id', ['label' => 'Пользователь'])?>
				            </div>

			                <div class="col-sm-8 right-help">
			                    <?= $form->field($model, 'username', ['showLabels' => false,])->textInput(['placeholder' => 'username'])?>
			                </div>

			            </div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->

			        <!-- PASSWORD -->
			            <div class="form-group">
				            <div class="col-sm-3" style="text-align: left">
				                <?= Html::activeLabel($model, 'id', ['label' => 'Пароль'])?>
				            </div>
			                <div class="col-sm-8 right-help">
			                    <?= $form->field($model, 're_password', ['showLabels' => false])->passwordInput(['autocomplete' => 'new-password', 'placeholder' => 'password'])?>
			                </div>
	            		</div>
	            		<div class="form-group">
				            <div class="col-sm-3" style="text-align: left">
				                <?= Html::activeLabel($model, 'id', ['label' => 'Подтвердите пароль'])?>
				            </div>
			                <div class="col-sm-8 right-help">
			                    <?= $form->field($model, 'password', ['showLabels' => false])->passwordInput()?>
			                </div>
	            		</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->	  

					<!-- PERMISSIONS -->          		

	            		<hr size="3px" style="border-top:1px solid #cecece">

	            		<div class="col-sm-3" style="text-align: left">
				            <?= Html::activeLabel($model, 'id', ['label' => 'Права доступа'])?>
				        </div>
	            		<div class="form-group">
		            		<div class="col-sm-5">
		            			<?= $form->field($model, 'permission', ['showLabels' => false])->checkboxList($permissions_list)?>
		            		</div>
	            		</div>

					</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->	

					<!--  ADDITIONALY--> 

					<div role="tabpanel" class="tab-pane" id="additionally">
						<div class="form-group">
							<div class="col-sm-3" style="text-align: left">
			                	<?= Html::activeLabel($model, 'id', ['label' => 'Имя пользователя'])?>
			                </div>
			                <div class="col-sm-5">
			                    <?= $form->field($model, 'full_name', ['showLabels' => false])->textInput(['placeholder' => 'ФИО'])?>
			                </div>
			            </div>
			            <div class="form-group">
							<div class="col-sm-3" style="text-align: left">
			                	<?= Html::activeLabel($model, 'id', ['label' => 'Департамент'])?>
			                </div>
			                <div class="col-sm-5">
			                    <?= $form->field($model, 'department', ['showLabels' => false])->textInput(['placeholder' => 'Департамент'])?>
			                </div>
			            </div>
			            <div class="form-group">
							<div class="col-sm-3" style="text-align: left">
			                	<?= Html::activeLabel($model, 'id', ['label' => 'Должность'])?>
			                </div>
			                <div class="col-sm-5">
			                    <?= $form->field($model, 'position', ['showLabels' => false])->textInput(['placeholder' => 'Должность'])?>
			                </div>
			            </div>
			            <div class="form-group">
							<div class="col-sm-3" style="text-align: left">
			                	<?= Html::activeLabel($model, 'id', ['label' => 'Телефон'])?>
			                </div>
			                <div class="col-sm-5">
			                    <?= $form->field($model, 'phone', ['showLabels' => false])->textInput(['placeholder' => 'Телефон'])?>
			                </div>
			            </div>
						<div class="form-group">
							<div class="col-sm-3" style="text-align: left">
			                	<?= Html::activeLabel($model, 'id', ['label' => 'Email'])?>
			                </div>
			                <div class="col-sm-5">
			                    <?= $form->field($model, 'email', ['showLabels' => false])->input('email', ['placeholder' => 'email'])?>
			                </div>
			            </div>
			            
					</div>
<!-- -------------------------------------------------------------------------------------------------------------------------------------- -->	

					<div role="tabpanel" class="tab-pane" id="journal">
					</div>
				</div>

			</div>
			<div class="form-group" style="text-align: right; margin: 10px;">
					
							<?= Html::submitButton('Отмена', ['class' => 'btn btn-default btn-sm', 'data-dismiss' => 'modal']) ?>
					        <?= Html::submitButton('ОК', ['class' => 'btn btn-default btn-sm']) ?>
					    
				</div>
		<?php ActiveForm::end(); ?>
		
	
</div>

