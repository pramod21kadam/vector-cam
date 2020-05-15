var side_bar_items = document.querySelectorAll(".side-bar-item");
var page_containers = document.querySelectorAll(".page-container");
var sucess_toast = document.querySelector("#success-toast");
var fail_toast = document.querySelector("#fail-toast");

function update_sidebar(index){
    document.querySelector(".active-side-bar-item").classList.remove("active-side-bar-item");
    side_bar_items[index].classList.add("active-side-bar-item");
    
    for(let i = 0; i<page_containers.length; i++){
        page_containers[i].classList.add("hidden");
    }
    page_containers[index].classList.remove("hidden");
}

function remove_product(pid){
    var response = window.confirm("Remove product " + pid.id + " once product is removed can not be restored.");
    if(response){
        var toast;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if(this.responseText){
                    document.querySelector("#"+pid.id+"-card").classList.add("hidden");
                    toast = sucess_toast;
                }
                else{
                    toast = fail_toast;                    
                }
                toast.classList.remove("hidden");
                setTimeout(function(){ toast.classList.add("hidden"); }, 3000);

           }
        };
        xhttp.open("GET", "php_includes/admin_operations.php?action=1&product_id="+pid.id, true);
        xhttp.send(); 
    }
    
}