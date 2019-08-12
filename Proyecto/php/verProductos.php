<?php
    session_start();
    include('config_bd.php');
    $status="";
    if (isset($_POST['code']) && $_POST['code']!=""){
        $code = $_POST['code'];
        $result = mysqli_query($conn,"SELECT * FROM `producto` WHERE `ID_PRODUCTO`='$code'");
        $row = mysqli_fetch_assoc($result);
        $name = $row['NOMBRE'];
        $code = $row['ID_PRODUCTO'];
        $price = $row['PRECIO'];
        $image = $row['IMAGEN'];

    $cartArray = array(
        $code=>array(
        'name'=>$name,
        'code'=>$code,
        'price'=>$price,
        'quantity'=>1,
        'image'=>$image)
    );

    if(empty($_SESSION["shopping_cart"])) {
        $_SESSION["shopping_cart"] = $cartArray;
        $status = " <div class='alert alert-success' role='alert'>
            
        El producto ha sido reservado
      </div>";
    }else{
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        if(in_array($code,$array_keys)) {
            $status = " <div class='alert alert-info' role='alert'>
            
            El producto ya ha sido reservado
          </div>";	
        } else {
        $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
        $status = " <div class='alert alert-success' role='alert'>
            
        El producto ha sido reservado
      </div>";
        }

        }
    }
?>

<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS, JavaScript">
    <title>Productos</title>
    <link rel="stylesheet" type="text/css" href="../css/productos.css">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> 
     
    
</head>

<body>

    <div class="container">
        <br>
    <h2>Productos</h2>

    <div class="message_box" style="padding: 5px 40px;">
        <?php echo $status; ?>
    </div>


    <?php
        if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    ?>
    <div class="cart_div pull-right">
        <a href="Carrito.php">Reservas <span class="badge badge-secondary"><?php echo $cart_count; ?></span></a>
    </div>

    <div class="cart_div pull-left" style="padding: 0px 40px;">
        <a href="clientelogin.php">Regresar <span class="fa fa-arrow-left"></span></a>
    </div> 
    <br><br>

    <?php
        } else {
    ?>

    <div class="cart_div pull-left" style="padding: 0px 40px;">
        <a href="clientelogin.php">Regresar <span class="fa fa-arrow-left"></span></a>
    </div> 
    <br><br>

    <?php
        }
    ?>
    

    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1 ui-helper-center">IMAGEN</div>
            <div class="col col-2 ui-helper-center">NOMBRE</div>
            <div class="col col-3 ui-helper-center">DESCRIPCION</div>
            <div class="col col-4 ui-helper-center">CANTIDAD DISPONIBLE</div>
            <div class="col col-5 ui-helper-center">PRECIO</div>
            <div class="col col-6 ui-helper-center">OPCIONES</div>
        </li>

        <?php 
            $result = mysqli_query($conn,"SELECT * FROM `producto`");
            while($row = $result->fetch_assoc()) {  
                if ($row['ESTADO'] === 'D') { ?>
                    <form method='post' action=''>
                        <li class="table-row">
                            <input type='hidden' name='code' value="<?php echo $row['ID_PRODUCTO']?>" />
                            <div class="col col-1 ui-helper-center"><img class="imagen" src="<?php echo $row['IMAGEN']?>"></div>
                            <div class="col col-2 ui-helper-center"><?php echo $row['NOMBRE']?></div>
                            <div class="col col-3 ui-helper-center"><?php echo $row['DESCRIPCION']?></div>
                            <div class="col col-4 ui-helper-center"><?php echo $row['CANTIDAD']?></div>
                            <div class="col col-5 ui-helper-center">₡<?php echo $row['PRECIO']?></div>
                            <div class="col col-6 ui-helper-center">
                                <div>
                                    <button type="submit" class="btn btn-outline-primary comprar" >Reservar</button>
                                </div>
                            </div>
                        </li>
                    </form>
                <?php
                    }
                ?>
        <?php
            }
        ?>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        }, 4000);
    </script>
</body>
</html>