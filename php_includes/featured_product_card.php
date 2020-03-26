<?php
    echo('<div class="card mb-3 rounded featured_product">
        <div class="row no-gutters">
            <div class="col-sm-4">
                <img src="static/images/products/'.$fp["product_id"].'/'.$fp["product_id"].'.jpg" class="card-img" alt="...">
            </div>
            <div class="col-sm-8">
                <div class="card-body">
                    <h1 class="card-title">'.$fp["product_name"].'</h1>
                    <p class="card-text">'.$fp["summary"].'</p>
                    <button id = "'.$fp["product_id"].'" type="button" class="btn btn-lg btn-outline-success" onclick="learn_more(this)">More Info</button>
                </div>
            </div>
        </div>
    </div>');
?>