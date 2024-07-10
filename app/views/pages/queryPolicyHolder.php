<!DOCTYPE html>
<html>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link href=<?php echo URL_ROOT . "/css/style.css" ; ?> rel="stylesheet">
        <title><?php echo SITENAME; ?></title>

    </head>

    <body>
        <?php require_once APP_ROOT . "/views/inc/navbar.php"; ?>
        
        <div class="queryBlock">
            <br>
            <br>
            <br>

            <div class="queryLabel">
                <img src=<?php echo URL_ROOT . "/img/policyHolder.jpg"; ?> alt="policyHolderImg" width=7% height=7%>
                <h2>保戶關係查詢</h2>
                
            </div>
            
            <div class="queryArea">
                <h3>保戶編號</h3>
                <form action=<?php echo URL_ROOT . "/api/policyholders"; ?> method="get">
                    <input class="inputArea" type="text" id="policyId" name="policyId">
                    <input class="submitBtn" type="submit" value="查詢">
                </form>
                
            </div>

        </div>
        
        

        <div class="relationGraph">
            <h2>關係圖</h2>
        </div>

    </body>

</html>