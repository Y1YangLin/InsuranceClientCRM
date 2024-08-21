<?php

/** @var $this \YiYang\Clinico\core\View */
/** @var $model \YiYang\Clinico\models\ContactForm */

use \YiYang\Clinico\core\form\TextareaField;

$this->title = 'Contact';

?>

<h1>Contact</h1>

<?php $form = \YiYang\Clinico\core\form\Form::begin('', 'post') ?>

<?php echo $form->field($model, 'subject') ?> 
<?php echo $form->field($model, 'email') ?> 

<?php echo new TextareaField($model, 'body'); ?> 

<button type="submit" class="btn btn-primary">Submit</button>

<?php \YiYang\Clinico\core\form\Form::end(); ?>

