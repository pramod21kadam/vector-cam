<div class="row" id="product_blk_info">
     <div class="col">
        <h2><?php echo count($featured_products)+count($products);?> Products</h1>
    </div>
    <div class="col">
        <button id="add_product_btn" type="button" class="btn btn-primary btn-lg btn-block" onclick="add_product()">Add new product</button>
    </div>
</div>


<form action="php_includes/admin_operations.php?action=0" method="POST" id="fp_update_form">
    <input type="hidden" id="product_id" name="product_id" >
    <input type="hidden" id="intent" name="intent" >
</form>

<form action="php_includes/admin_operations.php?action=1" method="POST" id="remove_product">
    <input type="hidden" id="product_id_rmv" name="product_id" >
</form>

<form action="" id="product_form">
    <?php
        foreach($featured_products as $p){
            echo '<div class="card mb-3 product" >
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="static/images/products/'.$p["product_id"].'/'.$p["product_id"].'.jpg" class="card-img" alt="failed to load image.">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="card-title">'.$p["product_name"].'</h2>
                                <p class="card-text">Price : '.$p["product_price"].'</p>
                                <p class="card-text">Avilability : '.$p["product_avilability"].'</p>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="'.$p["product_id"].'_featured_toggle" checked oninput="update_fp(this , \''.$p["product_id"].'\')">
                                    <label class="custom-control-label" for="'.$p["product_id"].'_featured_toggle">Featured product</label>
                                </div>
                                <button type="button" class="btn btn-outline-danger" onclick="remove_product(\''.$p["product_id"].'\')">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>';
        }

    foreach($products as $p){
        echo '<div class="card mb-3 product" >
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="static/images/products/'.$p["product_id"].'/'.$p["product_id"].'.jpg" class="card-img" alt="failed to load image.">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h2 class="card-title">'.$p["product_name"].'</h2>
                                <p class="card-text">Price : '.$p["product_price"].'</p>
                                <p class="card-text">Avilability : '.$p["product_avilability"].'</p>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="'.$p["product_id"].'_featured_toggle" oninput="update_fp(this , \''.$p["product_id"].'\')">
                                    <label class="custom-control-label" for="'.$p["product_id"].'_featured_toggle">Featured product</label>
                                </div>
                                <button type="button" class="btn btn-outline-danger" onclick="remove_product(\''.$p["product_id"].'\')">Remove</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }

    ?>

</form>

<script>
    function update_fp(cbox , pid){
        document.getElementById("product_id").value = pid;
        if(cbox.checked){
            document.getElementById("intent").value = "true";
        }
        else{
            document.getElementById("intent").value = "false";
        }
        document.getElementById("fp_update_form").submit();
    }

    function add_product(){
        window.location.href = "http://127.0.0.1:8080/static/add_product.html";
    }

    function remove_product(pid){
        document.getElementById("product_id_rmv").value = pid;
        document.getElementById("remove_product").submit();
    }

</script>