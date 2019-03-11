<?php
    $sesion = false;
    require_once 'config_bd.php';

    $query = "SELECT * FROM producto"; 
    $result = $conn->query($query);

    // iniciar la sesion
    session_start();
    if(isset($_SESSION['cedula']) || empty($_SESSION['cedula'])){
       $sesion = true;
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
    <h2>Productos</h2>
    <a href="CompraProducto.php" class="cart-link" title="Ver Carrito">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    </a>
    <br>
    <ul class="responsive-table">
        <li class="table-header">
        <div class="col col-1 ui-helper-center">IMAGEN</div>
        <div class="col col-2 ui-helper-center">NOMBRE</div>
        <div class="col col-3 ui-helper-center">DESCRIPCION</div>
        <div class="col col-4 ui-helper-center">PRECIO</div>
        <div class="col col-5 ui-helper-center">CANTIDAD</div>
        <div class="col col-6 ui-helper-center">OPCIONES</div>
        </li>
        <?php 
            while($row = $result->fetch_assoc()) {  ?>
                
                <li class="table-row">
                    <div class="col col-1 ui-helper-center"><img class="imagen" src="<?php echo $row['IMAGEN']?>"></div>
                    <div class="col col-2 ui-helper-center"><?php echo $row['NOMBRE']?></div>
                    <div class="col col-3 ui-helper-center"><?php echo $row['DESCRIPCION']?></div>
                    <div class="col col-4 ui-helper-center"><?php echo $row['PRECIO']?></div>
                    <div class="col col-5 ui-helper-center"><input type='number' name='quantity' id='quantity' value='1' class='form-control' /></div>
                    <div class="col col-6 ui-helper-center">
                        <div>
                            <button type="submit" class="btn btn-outline-success reservar" >Reservar</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-outline-primary comprar" 
                            onclick="location.href='CarritoAccion.php?action=agregar&qty=<?php echo $_COOKIE['qty']; ?>;&id=<?php echo $row['ID_PRODUCTO']; ?>'">Comprar</button>
                        </div>
                    </div>
                </li>
        <?php
            }
        ?>
        
    </ul>

    <script type='text/javascript'>
        var value = $("#quantity").val();
        $("#quantity").on('keyup change click', function () {
            if(this.value !== value) {
                value = this.value;
                
                document.cookie = "qty=".value
            }        
        });
    </script>
    
</body>
