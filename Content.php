<?php
include_once("connection.php");
?>
<style>

    .mt-50 {

        margin-top: 50px;
    }

    .mb-50 {

        margin-bottom: 50px;
    }



    .card {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, .125);
        border-radius: .1875rem;
    }

    .card-img-actions {
        position: relative;
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
        text-align: center;
    }

    .card-img {

        width: 350px;
    }

    .star {
        color: red;
    }

    .bg-cart {
        background-color: orange;
        color: #fff;
    }

    .bg-cart:hover {

        color: #fff;
    }

    .bg-buy {
        background-color: green;
        color: #fff;
        padding-right: 29px;
    }

    .bg-buy:hover {

        color: #fff;
    }

    a {

        text-decoration: none !important;
    }
</style>

<section id="center_content">
<div class="row heading">
        <div class="title col-md-12">
            <h1>ToyShops</h1>
        </div>
    </div>
    <div class="container mt-50 mb-50">
        <div class="row">
            <?php
           
            $result = pg_query($conn, "SELECT * FROM product");

            if (!$result) {
                die('Invalid query: ' . pg_last_error($conn));
            }

            while ($row = pg_fetch_assoc($result)) {
            ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="">
                            <div class="card-img-actions">
                                <img src="products/<?php echo $row['proimage'] ?>" height="200" width="200" class="card-img img-fluid" alt="">
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-2">
                                    <a href="#" class="text-default mb-2" data-abc="true"><?php echo  $row['proname'] ?></a>
                                </h6>
                                <a href="#" class="text-muted" data-abc="true"><?php echo  $row['prodes'] ?></a>
                            </div>
                            <h3 class="mb-0 font-weight-semibold">$<?php echo  $row['proprice'] ?></h3>
                            <button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Add to cart</button>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<!-- <div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="section-title">Product</h2>
                    <div class="product-carousel">
                        <?php
                        $result = pg_query($conn, "SELECT * FROM product");
                        if (!$result) { //add this check.
                            die('Invalid query: ' . pg_last_error($conn));
                        }
                        while ($row = pg_fetch_array($result)) {
                        ?>
                            <div class="single-product">
                                <div class="product-f-image">
                                    <img src="imgProduct/<?php echo $row['Pro_image'] ?>" width="150" height="150">
                                </div>
                                <h2><a href="?page=quanly_chitietsanpham&ma=<?php echo  $row['proid'] ?>"><?php echo  $row['proname'] ?></a></h2>
                                <div class="product-carousel-price">
                                    <ins><?php echo  $row['Price'] ?></ins> <del><?php echo  $row['oldPrice'] ?></del>
                                </div>
                            </div>
                    </div>

                <?php
                        }
                ?>

                </div>
            </div>
        </div>
    </div>
</div> -->