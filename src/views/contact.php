<?php

/** @var $this \YiYang\Clinico\core\View */

$this->title = 'Contact';

?>

<h1>Contact</h1>

<form action="/contact" method="post">

    <div class="form-group">
        <label>Subject</label>
        <input type="text" name="subject" class="form-control">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control">
    </div>

    <div class="form-group">
        <label>Body</label>
        <input type="text" name="body" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>