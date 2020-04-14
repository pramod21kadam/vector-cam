var banner_images = document.querySelectorAll(".banner-image");
var circles = document.querySelectorAll(".circle");
var current_banner_image = 0;
var sucess_toast = document.querySelector("#success-toast");
var fail_toast = document.querySelector("#fail-toast");

banner_images[0].classList.remove("hidden");
circles[0].classList.add("circle-active");

var purchase_form = document.querySelector("#purchase-form");
var purchase_btn = document.querySelector("#show-form-btn");

function banner_update(btn){
    banner_images[current_banner_image].classList.add("hidden");
    circles[current_banner_image].classList.remove("circle-active");
    if(btn.id == "banner-nav-next"){
        current_banner_image++;
        if(current_banner_image == banner_images.length){
            current_banner_image = 0;
        }
    }
    else{
        current_banner_image--;
        if(current_banner_image == -1){
            current_banner_image = banner_images.length-1;
        }
    }
    banner_images[current_banner_image].classList.remove("hidden");
    circles[current_banner_image].classList.add("circle-active");
}

function toggle_form(){
    purchase_btn.classList.toggle("hidden");
    purchase_form.classList.toggle("hidden");
}

function place_order(){
    // var form = document.querySelector("#purchase-form form");
    // form.submit();
    var product_id = document.querySelector("#product_id").value;    
    var quantity = document.querySelector("#quantity").value;
    var price = document.querySelector("#price").value;    
    var address = document.querySelector("#address").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText){
                toast = sucess_toast;
                toggle_form();
                address.value = "";
            }
            else{
                toast = fail_toast;                    
            }
            toast.classList.remove("hidden");
            setTimeout(function(){ toast.classList.add("hidden"); }, 3000);
       }
    };

    xhttp.open("POST", "php_includes/place_order.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xhttp.send("product_id="+product_id+"&quantity="+quantity+"&price="+price+"&address="+address); 

}