<div class="row" style="text-align:center;">
    <div class="col">
        <h1 ><?php echo $db->count_accounts();?></h1>
        <br>
        <h1>accounts</h1>
    </div>

    <div class="col">
        <h1 ><?php echo $db->count_products();?></h1>
        <br>
        <h1>Products in store</h1>
    </div>

    <div class="col">
        <h1 ><?php echo $db->sum_transactions();?></h1>
        <br>
        <h1>sale this month</h1>
    </div>
</div>