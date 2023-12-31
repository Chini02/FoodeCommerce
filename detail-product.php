<?php 
    // session_start();
    require "inc/header.php" ;
    require "config/config.php";

    if (isset($_POST["submit"])){
        $prod_title   = $_POST["prod_title"];
        $prod_image   = $_POST["prod_image"];
        $prod_price   = $_POST["prod_price"];
        $prod_quntity = $_POST["prod_quntity"];
        $prod_id      = $_POST["prod_id"];
        $user_id      = $_POST["user_id"];
        // Prepare the SQL statement
        $sql = "INSERT INTO carts (product_id, prouduct_title, product_image, product_price, prouduct_quntity, user_id)
            VALUES (:product_id, :prouduct_title, :product_image, :product_price, :prouduct_quntity, :user_id)";
        $insert = $conn->prepare($sql);
        $insert->execute([
        ":product_id"       => $prod_id,
        ":prouduct_title"    => $prod_title,
        ":product_image"    => $prod_image,
        ":product_price"    => $prod_price,
        ":prouduct_quntity" => $prod_quntity,
        ":user_id"          => $user_id,
        ]);
    }
    
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $sql         = "SELECT * FROM products WHERE status = 1 AND id = '$id'";
        $select    = $conn->query($sql);
        $select->execute();
        $products = $select->fetch(PDO::FETCH_OBJ);
        
        // Related Product 
        $selectproducts = $conn->query("SELECT * ,categroy_id  FROM products WHERE status = 1 AND categroy_id = '$products->categroy_id' AND id != '$id'");
        $selectproducts->execute();
        $relateProducts = $selectproducts->fetchAll(PDO::FETCH_OBJ);

        // validation cart
        if (isset($_SESSION["user_id"])) {
            try {
                $validateCart = $conn->query("SELECT * FROM carts WHERE product_id = '$id' AND user_id = '$_SESSION[user_id]'");
                if ($validateCart === false) {
                    throw new Exception("Query failed: " . $conn->error);
                }
                $validateCart->execute();
                $cartExists = $validateCart->rowCount() > 0;
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            // If user is not logged in, set $cartExists to false
            $cartExists = false;
        }
        
    } else {

    }

?>
    <div id="page-content" class="page-content">
        
            <div class="banner">
                <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-header.jpg');">
                    <div class="container">
                        <h1 class="pt-5">
                            <?php echo $products->title; ?>
                        </h1>
                        <p class="lead">
                            Save time and leave the groceries to us.
                        </p>
                    </div>
                </div>
            </div>
            <div class="product-detail">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="slider-zoom">
                                <a href="assets/img/<?php echo $products->image; ?>" class="cloud-zoom" rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth:'500', zoomHeight:'500', adjustY:0, adjustX:10" id="cloudZoom">
                                    <img alt="Detail Zoom thumbs image" src="assets/img/<?php echo $products->image; ?>" style="width: 100%;">
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <p>
                                <strong>Overview</strong><br>
                                <?php echo $products->description; ?>
                            </p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>
                                        <strong>Price</strong> (/Pack)<br>
                                        <span class="price">Rp <?php echo $products->price; ?>.000</span>
                                        <span class="old-price">Rp <?php echo $products->discount_price; ?>.000</span>
                                    </p>
                                </div>
                            
                            </div>
                            <p class="mb-1">
                                <strong>Quantity</strong>
                            </p>
                            <form action="" method="POST" id="form_products">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" name="prod_title" value="<?php echo $products->title; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" name="prod_image" value="<?php echo $products->image; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" name="prod_price" value="<?php echo $products->price; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" name="user_id" value="<?php echo isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : ''; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" name="prod_id" value="<?php echo $products->id; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <input class="form-control" type="number" name="prod_quntity" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $products->quantity; ?>">
                                    </div>
                                    <div class="col-sm-6"><span class="pt-1 d-inline-block">Pack (1000 gram)</span></div>
                                </div>
                                <?php if ($cartExists): ?>
                                    <button class="mt-3 btn btn-primary btn-lg btn-insert" type="submit" name="submit" disabled>
                                        <i class="fa fa-shopping-basket"></i> Add to Cart
                                    </button>
                                <?php else: ?>
                                    <button class="mt-3 btn btn-primary btn-lg btn-insert" type="submit" name="submit">
                                        <i class="fa fa-shopping-basket"></i> Add to Cart
                                    </button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        <section id="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Related Products</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($relateProducts as $productitem): ?>
                                <div class="item">
                                    <div class="card card-product">
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPECIAL</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                <span class="badge badge-default">
                                                    Until <?php echo $productitem->until_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    <?php echo $productitem->promossion; ?>
                                                </span>
                                            </div>
                                            <img src="assets/img/<?php echo $productitem->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.php?id=<?php echo $productitem->id; ?>">Product <?php echo $productitem->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <span class="discount">Rp. <?php echo $productitem->discount_price; ?>.000</span>
                                                <span class="reguler">Rp. <?php echo $productitem->price; ?>.000</span>
                                            </div>
                                            <a href="detail-product.php?id=<?php echo $productitem->id; ?>" class="btn btn-block btn-primary">
                                                Add to Cart
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php 
require "inc/footer.php" ;
?>
<script>
   $(document).ready(function(){
    $(".form-control").keyup(function () {
        var value = $(this).val();
        value = value.replace(/^(0*)/,"");
        $(this).val(1)
    });
    $(".btn-insert").on("click", function(e){
        e.preventDefault();
        var form_products = $("#form_products").serialize()+'&submit=submit';
        $.ajax({
            url: "detail-product.php?id=<?php echo $products->id; ?>",
            method:"POST",
            data: form_products,
            success:function(response){ // Added response parameter here
                alert("Product Successfully Added"); // Show the response message
                $(".btn-insert").html("<i class='fa fa-shopping-basket'></i> Added to Cart").prop("disabled",true); // Update button text
            }
        });
    });
});

</script>