<style>
    div.comparisontable{
        margin-left:100px;
        display: flex;
        flex-direction: column;
    }

    div.comparisontable img{
        max-width: 40%;
        width: auto;
        height: auto;
    }


    div.comparisontable ul.row{
        text-align:center;
        background: #6640d8;
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
        flex: 1;
        width: 100%;
        flex-wrap: wrap;
    }

    div.comparisontable ul.row li{
        background: #c9f4ca;
        flex: 1;
        padding: 10px;
        border-bottom: 1px solid gray;
    }

    div.comparisontable ul.row li.legend{
        max-width: 20%;
        text-align: right;
        background: #6640d8;
        color: white;
        font-weight: bold;
        border: none;
        width: 33%;
        border-bottom: 1px solid white;
    }

    div.comparisontable ul.row li:last-of-type{
    }

    /* very first row */
    div.comparisontable ul.row:first-of-type li{
        text-align: center;
    }

    /* very last row */
    div.comparisontable ul.row:last-of-type li{
        text-align: center;
        border-bottom: none;
        box-shadow: 0 6px 6px rgba(0,0,0,0.23);
    }

    div.comparisontable a.calltoaction{
        color: white;
        background: #e12525;
        display: inline-block;
        padding: 8px 10px;
        text-decoration: none;
        border-radius: 8px;
        margin: .1em auto;
    }

    div.comparisontable a.calltoaction:hover{
        background: #d11212;
    }


    /* first and last cell within legend column */
    div.comparisontable ul.row:first-of-type li.legend.legend,
    div.comparisontable ul.row:last-of-type li.legend{
        background: transparent;
        box-shadow: none;
    }

    @media screen and (max-width:650px){

        div.comparisontable ul.row{
            flex-direction: column;
        }

        div.comparisontable img{
            width: auto;
            height: auto;
        }

        div.comparisontable ul.row li{
            margin-right: 0;
            flex: auto;
            width: auto;
        }

        /* first and last cell within legend column */
        div.comparisontable ul.row:first-of-type li.legend.legend,
        div.comparisontable ul.row:last-of-type li.legend{
            display: none;
        }

        div.comparisontable ul.row li.legend{
            width: auto;
        }
    }
    .overlay{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        background-color: rgba(0,0,0,0.5); /*dim the background*/
    }
</style>
<script>
    $(document).ready(function () {
        $("#myform1").on("submit", function () {
            $(".loader1").fadeIn();
            $(".overlay").fadeIn(500);
            $("#currencycloud").hide();
        });//submit
    });//document ready
    $(document).ready(function () {
        $("#myform2").on("submit", function () {
            $(".loader2").fadeIn();
            $(".overlay").fadeIn(500);
            $("#transferwise").hide();
        });//submit
    });//document ready
</script>
<div class="overlay" style="display:none;"></div>

<div class="comparisontable">
    <ul class="row">
        <li class="legend"><?php echo $second_rate['source'] . '/' . $second_rate['target']; ?> Broker Comparison</li>
        <li class="col1"><img src="<?php echo base_url('img/CurrencyCloud.png'); ?>" id="img1" height="42" width="42"><br />CurrencyCloud</li>
        <li><img src="<?php echo base_url('img/TransferWise.png'); ?>" id="img2" height="42" width="42"><br />TransferWise</li>
    </ul>

    <ul class="row">
        <li class="legend"><?php echo $second_rate['source']; ?> for exchange</li>
        <li class="col1"><?php echo number_format($first_rate['client_sell_amount'], 2) . ' ' . $first_rate['client_sell_currency']; ?></li>
        <li><?php echo number_format($second_rate['sourceAmount'], 2) . ' ' . $second_rate['source']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend">Price for 1 <?php echo $second_rate['source']; ?></li>
        <li class="col1"><?php echo number_format($first_rate['client_buy_amount'] / $first_rate['client_sell_amount'], 4) . ' ' . $first_rate['client_buy_currency']; ?></li>
        <li><?php echo number_format($second_rate['targetAmount'] / $second_rate['sourceAmount'], 4) . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend">Broker Fee</li>
        <li class="col1"></li>
        <li><?php echo $second_rate['fee'] . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend"><span class="text-warning">Wally</span> Fee</li>
        <li class="col1"><?php echo number_format(($first_rate['client_buy_amount'] * $wally_fee_rate), 2) . ' ' . $first_rate['client_buy_currency']; ?></li>
        <li><?php echo number_format(($second_rate['targetAmount'] * $wally_fee_rate), 2) . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend">Total (Inc. fees)</li>
        <?php
        $currencycloudopt = ($first_rate['client_buy_amount'] - ($first_rate['client_buy_amount'] * $wally_fee_rate));
        $transferwiseopt = $second_rate['targetAmount'] - ($second_rate['targetAmount'] * $wally_fee_rate) - ($second_rate['fee']);
        ?>
        <li class="col1"><?php echo number_format(($first_rate['client_buy_amount'] - ($first_rate['client_buy_amount'] * $wally_fee_rate)), 2) . ' ' . $first_rate['client_buy_currency']; ?></li>
        <li><?php echo number_format($second_rate['targetAmount'] - ($second_rate['targetAmount'] * $wally_fee_rate) - ($second_rate['fee']), 2) . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend"></li>
        <li>
            <?php if ($currencycloudopt > $transferwiseopt) { ?>
                <form action="<?php echo base_url('/client/make_exchange_cc'); ?>" id="myform1" method="post">
                    <input type=hidden name=source value="<?php echo $first_rate['client_sell_currency']; ?>">
                    <input type=hidden name=target value="<?php echo $first_rate['client_buy_currency']; ?>">
                    <input type=hidden name=sourceAmount value="<?php echo $first_rate['client_sell_amount']; ?>">
                    <input type=hidden name=targetAmount value="<?php echo $first_rate['client_buy_amount']; ?>">
                    <?php echo ($currencycloudopt < $transferwiseopt) ? '' : '<ul>you\'ll save up to ' . number_format(($currencycloudopt - $transferwiseopt), 2) . ' ' . $first_rate['client_buy_currency'] . ' using CurrencyCloud</ul>' ?>
                    <ul>   
                        <button type="submit" value="submit" id="currencycloud" class="calltoaction btn btn-primary" <?php echo ($currencycloudopt < $transferwiseopt) ? 'hidden' : ''; ?>>Exchange using CurrencyCloud</ul>
                    <div class="loader1 text-center" style="display: none;">
                        <img src="<?php
                        $random = rand(1, 4);
                        echo base_url('img/loader' . $random . '.gif');
                        ?>" alt="Loading..." />
                    </div>
                </form>
            </li>
        <?php } ?>
        <li>
            <?php if ($currencycloudopt < $transferwiseopt) { ?>

                <form action="<?php echo base_url('/client/make_exchange_tw') ?>" id="myform2" method="post">
                    <input type=hidden name=quoteid value="<?php echo $second_rate['id']; ?>">
                    <input type=hidden name=source value="<?php echo $second_rate['source']; ?>">
                    <input type=hidden name=target value="<?php echo $second_rate['target']; ?>">
                    <input type=hidden name=sourceAmount value="<?php echo $second_rate['sourceAmount']; ?>">
                    <input type=hidden name=targetAmount value="<?php echo $second_rate['targetAmount']; ?>">
                    <input type=hidden name=fee value="<?php echo $second_rate['fee']; ?>">

                    <?php echo ($currencycloudopt > $transferwiseopt) ? '' : '<ul>you\'ll save up to ' . number_format(($transferwiseopt - $currencycloudopt), 2) . ' ' . $first_rate['client_buy_currency'] . ' using TransferWise</ul>' ?>
                    <button type="submit" value="submit" id="transferwise" class="calltoaction btn btn-primary" rel="nofollow"  <?php echo ($currencycloudopt > $transferwiseopt) ? 'hidden' : ''; ?>>Exchange using TransferWise</button>
                    <div class="loader2 text-center" style="display: none;">
                        <img src="<?php
                        $random = rand(1, 4);
                        echo base_url('img/loader' . $random . '.gif');
                        ?>" alt="Loading..." />
                    </div>
        </ul>
    </form>
    </li>
<?php } ?>
</ul>
</div>




<?php
// debugging section
//echo '<pre>';
//print_r($first_rate);
//echo '</pre>';
//echo '<pre>';
//print_r($second_rate);
//echo '</pre>';
?>
