<?php
    echo('<div class="card product_card">
                <img src="static/images/products/'.$cp["product_id"].'.jpg" class="card-img-top" alt="failed to load image">
                <div class="card-body">
                    <h2 class="card-title">'.$cp["product_name"].'</h2>
                    <p class="card-text">'.$cp["summary"].'</p>
                </div>
                <div class="card-footer">
                    <button type="button" id = "'.$cp["product_id"].'" class="btn btn-lg btn-outline-success" onclick="learn_more(this)">Learn more</button>
                </div>
            </div>'
        );
?>