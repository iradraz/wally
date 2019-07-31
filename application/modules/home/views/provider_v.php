<style>
    .newsletter-bg {
        background-image: url('img/shake_hands_background.jpg');
        background-repeat: no-repeat;
        background-size: 720px auto;
    }

    .bg {
        background-position: center top;
        padding: 100px 300px;
        height: 100vh
    }

    .wrap {
        position: relative;
    }

    .newsletter-bg {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 30px;
        margin: 0 auto;
        background-position: center -200px;
        -webkit-filter: blur(20px);
    }

    .newsletter-text {
        border: 2px solid white;
        padding: 50px;
        margin: 0 auto;
        position: relative;
        max-width: 500px;
        h2 {
            color: white;
            margin-top: 0;
            text-align: center;
            text-transform: uppercase;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
        }
    }
</style>

<div class="card text-primary" style="opacity:0.8">
    <h1>Are you are provider?</h1>
    <h2 class="text-warning">Lets shake hands and work together</h2>
    <p class="text-warning">Fill the form at the bottom of the page and send it to our BackOffice directly.</p>
</div>
<div class="bg">
    <div class="wrap">
        <div class="newsletter-bg"></div>  
        <div class="newsletter-text">
            <h2>type in your email</h2>

            <form action="#">
                <div>
                    <label for="name" class="sr-only">Text Input:</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="john@snow.com" />
                </div>


                <div>
                    <input type="submit" value="Submit" class="form-control" />
                </div>
            </form>  
        </div>

    </div>

</div>
