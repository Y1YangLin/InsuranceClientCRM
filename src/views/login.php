<?php 
    /**@var $model \YiYang\Clinico\models\User */
?>

<h1>Login</h1>

<?php $form = \YiYang\Clinico\core\form\Form::begin('', 'post') ?>

    

    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php \YiYang\Clinico\core\form\Form::end() ?>

