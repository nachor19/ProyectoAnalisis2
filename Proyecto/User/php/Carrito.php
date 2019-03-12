<?php
    session_start();
    include('config_bd.php');
    $status="";

    if (isset($_POST['action']) && $_POST['action']=="remove") {
        if(!empty($_SESSION["shopping_cart"])) {
            foreach($_SESSION["shopping_cart"] as $key => $value) {
                if($_POST["code"] == $key) {
                    unset($_SESSION["shopping_cart"][$key]);
                    $status = "<div class='box' style='color:red;'>
                    Product is removed from your cart!</div>";
                }
                if(empty($_SESSION["shopping_cart"])) {
                    unset($_SESSION["shopping_cart"]);
                }
            }		
        }
    }

    if (isset($_POST['action']) && $_POST['action']=="confirmar") {
        $sql = "INSERT INTO orden (CLIENTE_ID, PRECIO_TOTAL, CREADO, MODIFICADO, ESTADO)
            VALUES (". $_SESSION['cedula'].", ".$_SESSION['total_price'].", ".date("Y-m-d")."
            , ".date("Y-m-d").", ". '1'.")";
        if (mysqli_query($conn, $sql)) {           
            $order_id = mysqli_insert_id($conn);            
            foreach($_SESSION["shopping_cart"] as $key => $value) {
                $sql_orders = "INSERT INTO orden_producto (ORDEN_ID, PRODUCTO_ID, CANTIDAD)
                VALUES (". $order_id.", ".$value['code'].", ".$value['quantity'].")";
                mysqli_query($conn, $sql_orders);
                if (mysqli_query($conn, $sql)) {
                    $sql_producto = "SELECT * FROM producto WHERE ID_PRODUCTO =". $value['code']."";
                    $result = mysqli_query($conn, $sql_producto);
                    while($row = $result->fetch_assoc()) {
                        $cantidad = (int)$row['CANTIDAD'] - (int)$value['quantity'];
                        if (mysqli_num_rows($result) > 0) {
                            $sql_update = "UPDATE producto SET CANTIDAD=".$cantidad." WHERE ID_PRODUCTO=".$value['code']."";
                            mysqli_query($conn, $sql_update);
                        }
                    }
                }

                
                
                
            }
        }
        
    }

    if (isset($_POST['action']) && $_POST['action']=="change") {
    foreach($_SESSION["shopping_cart"] as &$value){
        if($value['code'] === $_POST["code"]){
            $value['quantity'] = $_POST["quantity"];
            break; 
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
    <link rel="stylesheet" type="text/css" href="../css/Productos.css">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> 
     
</head>
<body>
    <div class="container">
        <br>

        <h2>Confirmar Reservas</h2>   

        <?php
            if(!empty($_SESSION["shopping_cart"])) {
            $cart_count = count(array_keys($_SESSION["shopping_cart"]));
        ?>
            <div class="cart_div pull-left" style="padding: 0px 40px;">
                <a href="verProductos.php">Regresar <span class="fa fa-arrow-left"></span></a>
            </div>

            <div class="pull-right">
                <form method='post' action=''>
                    <input type='hidden' name='action' value="confirmar" />
                    <button type="submit" value="confirmar" class="btn btn-outline-success comprar" >Confirmar</button>
                </form>
            </div>
            <br>
        <?php
        }
        ?>

        <div class="cart">
        <?php
            if(isset($_SESSION["shopping_cart"])){
                $total_price = 0;
        ?>	
        <br><br>
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1 ui-helper-center">IMAGEN</div>
                <div class="col col-2 ui-helper-center">NOMBRE</div>
                <div class="col col-3 ui-helper-center">CANTIDAD</div>
                <div class="col col-4 ui-helper-center">PRECIO UNITARIO</div>
                <div class="col col-6 ui-helper-center">TOTAL</div>
            </li>	
        <?php		
            foreach ($_SESSION["shopping_cart"] as $product){
        ?>
        <li class="table-row">
            <div class="col col-1 ui-helper-center"><img class="imagen" src="<?php echo $product['image']?>"></div>
            <div class="col col-2 ui-helper-center"><?php echo $product['name']?>
                <form method='post' action=''>
                    <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                    <input type='hidden' name='action' value="remove" />
                    <button type='submit' class="btn btn-outline-danger comprar">Remover</button>
                </form>
            </div>         
            <div class="col col-3 ui-helper-center">
                <form method='post' action=''>
                    <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                    <input type='hidden' name='action' value="change" />
                    <select  class="form-control" name='quantity' class='quantity' onchange="this.form.submit()">
                        <option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
                        <option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
                        <option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
                        <option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
                        <option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
                    </select>
                </form>
            </div>
            <div class="col col-4 ui-helper-center"><?php echo "₡".$product["price"]; ?></div>
            <div class="col col-6 ui-helper-center">
                <?php echo "₡".$product["price"]*$product["quantity"]; ?>
            </div>
        </li>

        <?php
                $total_price += ($product["price"]*$product["quantity"]);
                $_SESSION['total_price'] = $total_price;
            }
        ?>
        
        <div  class="pull-right">
            <strong>TOTAL: <?php echo "₡".$total_price; ?></strong>
        </div>
	
        <?php
            } else {
                echo "
                    <div class='cart_div pull-left' style='padding: 0px 40px;'>
                        <a href='verProductos.php'>Regresar <span class='fa fa-arrow-left'></span></a>
                    </div>
                    <br><br><br>
                    <div class='card'>
                        <div class='card-body'>
                            <h2>No tiene reservas.</h2>
                        </div>
                    </div>";
                }
            ?>
    </div>
</body>
</html>