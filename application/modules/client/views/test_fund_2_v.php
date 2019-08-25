<div class='card-wrapper'></div>
<!-- CSS is included via this JavaScript file -->
<form>
    <input type="text" name="CC_NUM">
    <input type="text" name="CC_EXPIRES"/>
    <!--<input type="text" name="ccnumber"/>-->
    <input type="text" name="CARD_CVV2"/>
    <input type="text" name="NAME1"/>
    <input type="text" name="NAME2"/>
</form>


<script src="../jquery/card.jquery.js"></script>
<script>
    $('form').card({
        form: 'form',
        container: '.card-wrapper',
        formSelectors: {
            numberInput: 'input[name=CC_NUM]',
            expiryInput: 'input[name=CC_EXPIRES]',
            cvcInput: 'input[name=CARD_CVV2]',
            nameInput: 'input[name=NAME1], input[name=NAME2]'
        },
        placeholders: {
            CC_NUM: '**** **** **** ****',
            NAME1: 'Arya',
            NAME2: 'Stark',
            CC_EXPIRES: '**/**',
            cvc2: '**'
        }
    });
</script>