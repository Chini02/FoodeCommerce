<?php
    require "inc/header.php" ;
    require "config/config.php" ;
    // Category Table
    $sql1       = "SELECT * FROM categories";
    $categories = $conn->query($sql1);
    $categories->execute();
    $getCategry = $categories->fetchAll(PDO::FETCH_OBJ);
    // Products Table
    $sql2        = "SELECT * FROM products WHERE status = 1";
    $products    = $conn->query($sql2);
    $products->execute();
    $getproducts = $products->fetchAll(PDO::FETCH_OBJ);
    // vigitables 
    $vigita        = "SELECT * FROM products WHERE status = 1 AND categroy_id = 1";
    $vigitables    = $conn->query($vigita);
    $vigitables->execute();
    $getvigitables = $vigitables->fetchAll(PDO::FETCH_OBJ);
    // Meate 
    $meate    = $conn->query("SELECT * FROM products WHERE status = 1 AND categroy_id = 2");
    $meate->execute();
    $allMeats = $meate->fetchAll(PDO::FETCH_OBJ);
    // fruite 
    $fruite    = $conn->query("SELECT * FROM products WHERE status = 1 AND categroy_id = 3");
    $fruite->execute();
    $allfruits = $fruite->fetchAll(PDO::FETCH_OBJ);
    

?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                        Shopping Page
                    </h1>
                    <p class="lead">
                        Save time and leave the groceries to us.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shop-categories owl-carousel mt-5">
                        <?php foreach ($getCategry as $key ) : ?>
                            <div class="item">
                                <a href="shop.php">
                                    <div class="media d-flex align-items-center justify-content-center">
                                        <span class="d-flex mr-2"><i class="sb-bistro-<?php echo $key->icon ?>"></i></span>
                                        <div class="media-body">
                                            <h5><?php echo $key->name ?></h5>
                                            <p><?php echo $key->description ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <section id="most-wanted">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Most Wanted</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($getproducts as $product): ?>
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
                                                    Until <?php echo $product->until_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                <?php echo $product->promossion; ?>
                                                </span>
                                            </div>
                                            <img src="assets/img/<?php echo $product->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.php"><?php echo $product->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <span class="discount">Rp. <?php echo $product->discount_price; ?>,00$</span>
                                                <span class="reguler">Rp. <?php echo $product->price; ?>,00$</span>
                                            </div>
                                            <a href="detail-product.php" class="btn btn-block btn-primary">
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

        <section id="vegetables" class="gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Vegetables</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($getvigitables as $index):?>
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
                                                    Until <?php echo $index->until_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    <?php echo $index->promossion; ?>
                                                </span>
                                            </div>
                                            <img src="assets/img/<?php echo $index->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.php"><?php echo $index->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <span class="discount">Rp. <?php echo $index->discount_price; ?>.000</span>
                                                <span class="reguler">Rp. <?php echo $index->price; ?>.000</span>
                                            </div>
                                            <a href="detail-product.php?id=<?php echo $index->id; ?>" class="btn btn-block btn-primary">
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


        <section id="fruits">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Fruits</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach ($allfruits as $itemFruits) : ?>
                                <div class="item">
                                    <div class="card card-product">
                                        <!-- Add your product display code here -->
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPECIAL</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                <span class="badge badge-default">
                                                    Until <?php echo $itemFruits->until_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    <?php echo $itemFruits->promossion; ?>
                                                </span>
                                            </div>
                                            <img src="assets/img/<?php echo $itemFruits->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.php"><?php echo $itemFruits->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <span class="discount">Rp. <?php echo $itemFruits->discount_price; ?>.000</span>
                                                <span class="reguler">Rp. <?php echo $itemFruits->price; ?>.000</span>
                                            </div>
                                            <a href="detail-product.php?id=<?php echo $itemFruits->id; ?>" class="btn btn-block btn-primary">
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


        <section id="meates">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">MEATES</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach ($allMeats as $keymeats) : ?>
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
                                                    Until <?php echo $keymeats->until_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    20% OFF
                                                </span>
                                            </div>
                                            <img src="assets/img/<?php echo $keymeats->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.php">Product Title</a>
                                            </h4>
                                            <div class="card-price">
                                                <span class="discount">Rp. <?php echo $keymeats->discount_price; ?>.000</span>
                                                <span class="reguler">Rp. <?php echo $keymeats->price; ?>.000</span>
                                            </div>
                                            <a href="detail-product.php?id=<?php echo $keymeats->id; ?>" class="btn btn-block btn-primary">
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
require "inc/footer.php";
?>
