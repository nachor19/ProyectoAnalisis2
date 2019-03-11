<?php

include 'Carrito.php';
$carrito = new Carrito;


include 'config_bd.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    var_dump($_REQUEST);
    if($_REQUEST['action'] == 'agregar' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        $qty = $_REQUEST['qty'];
        // get product details
        $query = $conn->query("SELECT * FROM Producto WHERE ID_PRODUCTO = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'ID_PRODUCTO' => $row['ID_PRODUCTO'],
            'NOMBRE' => $row['NOMBRE'],
            'PRECIO' => $row['PRECIO'],
            'qty' => $qty
        );
        
        $insertItem = $carrito->insert($itemData);
        var_dump($insertItem);
        //$redirectLoc = $insertItem?'CompraProducto.php':'verProductos.php';
        //header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // insert order details into database
        $insertOrder = $db->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $db->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $db->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: orderSuccess.php?id=$orderID");
            }else{
                header("Location: checkout.php");
            }
        }else{
            header("Location: checkout.php");
        }
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}