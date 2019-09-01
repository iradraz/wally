<style>
    div.comparisontable{
        display: flex;
        flex-direction: column;
    }

    div.comparisontable img{
        max-width: 70%;
        width: auto;
        height: auto;
    }


    div.comparisontable ul.row{
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
        flex: 1;
        width: 80%;
        flex-wrap: wrap;
    }

    div.comparisontable ul.row li{
        background: #c9f4ca;
        flex: 1;
        padding: 10px;
        border-bottom: 1px solid gray;
    }

    div.comparisontable ul.row li.legend{
        background: #6640d8;
        color: white;
        font-weight: bold;
        border: none;
        width: 100px;
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
</style>

<div class="comparisontable">
    <ul class="row">
        <li class="legend"><?php echo $second_rate['source'] . '/' . $second_rate['target']; ?> Broker Comparison</li>
        <li><img src="<?php echo base_url('img/CurrencyCloud.png'); ?>" height="100" width="100" /><br />CurrencyCloud</li>
        <li><img src="<?php echo base_url('img/TransferWise.png'); ?>" height="100" width="100" /><br />TransferWise</li>
    </ul>

    <ul class="row">
        <li class="legend"><?php echo $second_rate['source']; ?> for exchange</li>
        <li><?php echo number_format($first_rate['client_sell_amount'], 2) . ' ' . $first_rate['client_sell_currency']; ?></li>
        <li><?php echo number_format($second_rate['sourceAmount'], 2) . ' ' . $second_rate['source']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend">Price for 1 <?php echo $second_rate['source']; ?></li>
        <li><?php echo number_format($first_rate['client_buy_amount'] / $first_rate['client_sell_amount'], 4) . ' ' . $first_rate['client_buy_currency']; ?></li>
        <li><?php echo number_format($second_rate['targetAmount'] / $second_rate['sourceAmount'], 4) . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend">Broker Fee</li>
        <li></li>
        <li><?php echo $second_rate['fee'] . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend"><span class="text-warning">Wally</span> Fee</li>
        <li><?php echo number_format(($first_rate['client_buy_amount'] * 0.010), 2) . ' ' . $first_rate['client_buy_currency']; ?></li>
        <li><?php echo number_format(($second_rate['targetAmount'] * 0.010), 2) . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend">Total (Inc. fees)</li>
        <?php
        $currencycloudopt = ($first_rate['client_buy_amount'] - ($first_rate['client_buy_amount'] * 0.010));
        $transferwiseopt = $second_rate['targetAmount'] - ($second_rate['targetAmount'] * 0.010) - ($second_rate['fee']);
        ?>
        <li><?php echo number_format(($first_rate['client_buy_amount'] - ($first_rate['client_buy_amount'] * 0.010)), 2) . ' ' . $first_rate['client_buy_currency']; ?></li>
        <li><?php echo number_format($second_rate['targetAmount'] - ($second_rate['targetAmount'] * 0.010) - ($second_rate['fee']), 2) . ' ' . $second_rate['target']; ?></li>
    </ul>

    <ul class="row">
        <li class="legend"></li>
        <li>
            <?php echo ($currencycloudopt < $transferwiseopt) ? '' : '<ul>you\'ll save up to ' . number_format(($currencycloudopt - $transferwiseopt), 2) . ' ' . $first_rate['client_buy_currency'] . ' using CurrencyCloud</ul>' ?>
            <ul><a href="" class="calltoaction" rel="nofollow" <?php echo ($currencycloudopt < $transferwiseopt) ? 'hidden' : ''; ?>>Exchange using CurrencyCloud</a></ul>
        </li>
        <li>
            <?php echo ($currencycloudopt > $transferwiseopt) ? '' : '<ul>you\'ll save up to ' . number_format(($transferwiseopt - $currencycloudopt), 2) . ' ' . $first_rate['client_buy_currency'] . ' using TransferWise</ul>' ?>
            <a href="" class="calltoaction" rel="nofollow" <?php echo ($currencycloudopt > $transferwiseopt) ? 'hidden' : ''; ?>>Exchange using TransferWise</a>
        </li>
    </ul>
</div>
<?php // if ($currencycloudopt < $transferwiseopt) { ?>
<!--    <form action="https://secure.bluepay.com/interfaces/bp10emu" method="post">
        <input type=hidden name=id value="<?php echo $second_rate['id']; ?>">
        <input type="hidden" name=source value="" />
        <input type=hidden name=target value="">
        <input type=hidden name=  value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
        <input type=hidden name=       value="">
    </form>-->
<?php // } ?>
<?php
echo '<pre>';
print_r($first_rate);
echo '</pre>';
echo '<pre>';
print_r($second_rate);
echo '</pre>';
?>