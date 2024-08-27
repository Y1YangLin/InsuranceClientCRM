<?php

    $this->title = 'Home';

?>

<div class="container-label">
    <img class="logo1" src="/img/logo1.jpg" alt="logo1">
    <p class="description">保戶關係查詢</p>
    <hr class="horizonLine">
</div>

<div class="container-query">

    <p class="description" style="margin-left: 100px;">保戶查詢</p>

    <form class="d-flex" action="/api/policyholders" method="get">
        <input class="form-control me-2" type="id" name="id" placeholder="請輸入保戶編號" aria-label="Search">
        <button id="btn1" class="btn btn-outline-success" type="submit" >查詢</button>
    </form>

</div>

<div class="container-label2">
    
    <img class="logo2" src="/img/logo2.jpg" alt="logo2">
    <p class="description">關係圖</p>
    <hr>

</div>

<div class="container-relation-graph">
    TODO
</div>