<html>
<header>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</header>
<body>
<?php
    $transaction = $data[0];
    $productName = \App\Product::find($transaction->product_id)->name;
    $productPrice = $transaction->product_price;
    $quantity = $transaction->quantity;
    $pay_amount = $transaction->pay_amount;
    $bitcoin = $transaction->total_bitcoin;
    $customerInfo = $transaction->custominfo;
    $payed_coin = $data[1];
    $remain_coin = $bitcoin - $payed_coin;
?>
<h1 class="text-center">Hi,Jone Doe</h1>
<h3>
    Some products was sold by somebody.
    Below mentioned about information.</h3>
<div class="row">
    <div class="col-md-6">
        <p> Product Name: <span><?php echo $productName; ?></span></p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p> Product Price: <span><?php echo $productPrice; ?></span></p>
    </div>
    <div class="col-md-6">
        <p> Quantity: <span><?php echo $quantity; ?></span></p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p> Total Amount: <span><?php echo $pay_amount; ?></span></p>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <p> Total Bitcoin: <span><?php echo $bitcoin; ?></span></p>
    </div>
    <div class="col-md-6">
        <p> Payed Bitcoin: <span><?php echo $payed_coin; ?></span></p>
    </div>
</div>
<h3>Customer Info: </h3>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $customerInfo; ?></span>
<p> Remain Bitcoin: <span><?php echo $remain_coin; ?></span></p>
Thanks and Regards.
</body>
</html>



