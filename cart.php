<?php 
    require "inc/header.php" ;
    require "config/config.php" ;

    $sql = "SELECT * FROM carts WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Database query error: " . $conn->errorInfo()[2]);
    }
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $cartItems = $stmt->fetchAll(PDO::FETCH_OBJ);

?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Your Cart
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th>Products</th>
                                        <th>Price</th>
                                        <th width="15%">Quantity</th>
                                        <th width="15%">Update</th>
                                        <th>Subtotal</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cartItems as $items): ?>
                                    <tr>
                                        <td>
                                            <img src="assets/img/<?php echo $items->product_image; ?>" width="60">
                                        </td>
                                        <td>
                                            <?php echo $items->product_title; ?><br>
                                            <small>1000g</small>
                                        </td>
                                        <td>
                                            Rp <?php echo $items->product_price; ?>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary"
                                             data-bts-button-up-class="btn btn-primary" value="<?php echo $items->product_quantity; ?>" name="vertical-spin">
                                        </td>
                                        <td>
                                            <a href="detail-product?id=<?php echo $items->id; ?>" class="btn btn-primary">UPDATE</a>
                                        </td>
                                        <td>
                                            Rp <?php echo $items->product_price; ?>
                                        </td>
                                        <td>
                                            <a href="javasript:void" class="text-danger"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <a href="shop.php" class="btn btn-default">Continue Shopping</a>
                    </div>
                    <div class="col text-right">
                   
                        <div class="clearfix"></div>
                        <h6 class="mt-3">Total: Rp 180.000</h6>
                        <a href="checkout.php" class="btn btn-lg btn-primary">Checkout <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
<?php 
require "inc/footer.php" ;
?>


