<?php
echo '<pre>';
print_r($first_rate);
echo '</pre>';
echo '<pre>';
print_r($second_rate);
echo '</pre>';
?>
<h1>price comparison for <?php echo $first_rate['client_sell_currency'] . $first_rate['client_buy_currency']; ?></h1>
<h2>
    CurrencyCloud rate:
</h2>
<h3>
    for every <?php echo '1 ' . $first_rate['client_sell_currency']; ?>
    you sell, you'll get <?php echo number_format($first_rate['client_buy_amount'] / $first_rate['client_sell_amount'], 4) . ' ' . $first_rate['client_buy_currency']; ?>
    you'll receive total of: <?php echo $first_rate['client_buy_amount'] . ' ' . $first_rate['client_buy_currency']; ?>
</h3>
<br>
<h2>
    TransferWise rate:

</h2>
<h3>
    for every <?php echo '1 ' . $second_rate['source']; ?>
    you sell, you'll get <?php echo number_format($second_rate['targetAmount'] / $second_rate['sourceAmount'], 4) . ' ' . $second_rate['target']; ?>
    you'll receive total of: <?php echo $second_rate['targetAmount'] . ' ' . $second_rate['target']; ?>
</h3>