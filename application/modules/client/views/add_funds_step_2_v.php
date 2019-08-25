<?php
$session_data = $this->session->userdata();
echo md5('K71NFVOULCMSJVYC6RNNIOFF6MG0GPNZ100746732112CAPTURETEST' . $get_data['AMOUNT']);

//MERCHANT + TRANSACTION_TYPE + AMOUNT + REBILLING + REB_FIRST_DATE + REB_EXPR + REB_CYCLES + REB_AMOUNT + AVS_ALLOWED + AUTOCAP + MODE 
?>

<div class="container">
    <div class="progress" style="margin-bottom: 5px;">
        <div class="progress-bar" role="progressbar" aria-valuenow="75"
             aria-valuemin="0" aria-valuemax="100" style="width:75%">
            <span class="sr-only">75% Complete</span>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card">  
                    <div class="card-body">
                        <form action="https://secure.bluepay.com/interfaces/bp10emu" method="post">
                            <input type=hidden name=MERCHANT value="100746732112">
                            <input name="PROCESS" type="hidden" value="PROCESS" />
                            <input type=hidden name=TRANSACTION_TYPE value="CAPTURE">
                            <input type=hidden name=TAMPER_PROOF_SEAL  value="a6cf7272038aa44e9e82d18c0f31e763">
                            <!--<input type=hidden name=APPROVED_URL       value="<?php // echo base_url('client/approve');       ?>">-->
                            <!--<input type=hidden name=DECLINED_URL       value="http://decline.com">-->
                            <!--<input type=hidden name=MISSING_URL        value="http://err.com">-->
                            <input type=hidden name=MODE               value="TEST">
                            <!--<input type=hidden name=AUTOCAP            value="0">-->
                            <input type=hidden name=TPS_HASH_TYPE      value="MD5">
                            <input type=hidden name=TPS_DEF value="MERCHANT TRANSACTION_TYPE MODE TPS_DEF REBILLING REB_CYCLES REB_AMOUNT REB_EXPR REB_FIRST_DATE">
                            <input type="hidden" name="NAME1" type="text" id="NAME1" value="<?php echo $session_data['user_firstname']; ?>" data-first-name >
                            <input type="hidden" name="NAME2"  id="NAME2" value="<?php echo $session_data['user_lastname']; ?>" data-last-name hidden>
                            <input type="hidden"  class="form-control required" name="AMOUNT" value="<?php echo $get_data['AMOUNT']; ?>" data-toggle-required> 
                            <!--<input type="hidden"  class="form-control required" name="CC_NUM" maxlength="19" value="<?php // echo $post_data['CC_NUM'];   ?>" >-->
                            <input type="hidden"  class="form-control required" name="CC_EXPIRES" value="<?php echo $get_data['CARD_EXPIRE']; ?>" maxlength="5">
                            <input type="hidden"  class="form-control required" name="CARD_CVV2"  maxlength="3" autocomplete="off" value="<?php echo $get_data['CVV2']; ?>" data-cvv>




                            <h5 class="card-title">Wally Deposit Review</h5>
                            <h6 class="card-title text-danger">Validate your details</h6>
                            <section>
                                <p class="card-text">Full Name: <?php echo $session_data['user_firstname'] . ' ' . $session_data['user_lastname']; ?></p>

                                <p class="card-text"><?php echo 'Credit Card #: <span class="text-info">' . $get_data['PAYMENT_ACCOUNT'] . '</span> Exp. Date: <span class="text-info">' . substr($get_data['CARD_EXPIRE'], -4, -2) . '/' . substr($get_data['CARD_EXPIRE'], -2) . '</span>'; ?>
                                <p class="card-text">  <?php echo 'Card Type: <span class="text-info">' . $get_data['CARD_TYPE'] . '</span>' ?></p>
                            </section>
                            <Br>
                            <p class="card-text">Proceed with Depositing <?php echo '$' . number_format($get_data['AMOUNT'], 2) . ' USD ?'; ?></p>
                            <input type="hidden" name="amount" value="<?php echo $get_data['AMOUNT']; ?>">

                            <button type="submit" name="submit" value="back" class="btn btn-warning">Go Back</button>
                            <button type="submit" name="submit" value="submit" class="btn btn-info">Yes, Make a Deposit</button>
                            <a href="<?php echo base_url(); ?>"<button type="Cancel" class="btn btn-danger" style="float: right">No, Cancel</button><a/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>