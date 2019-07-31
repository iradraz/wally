<style>
    * {box-sizing:border-box}

    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Hide the images by default */
    .mySlides {
        display: none;
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 4px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 80px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        display: none;
    }

    .active, .dot:hover {
        background-color: #717171;
    }

    /* Fading animation */
    .fade {
        -webkit-animation-name: fade;
        -webkit-animation-duration: 1.5s;
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
    }

    @keyframes fade {
        from {opacity: .4} 
        to {opacity: 1}
    }
</style>
<div class="slideshow-container text-warning wow tada" data-wow-duration="2.5s" style="text-align:center">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom"></span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">a</span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">al</span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">all</span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">ally</span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">all</span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">al</span></h1>
    </div>

    <div class="mySlides ">
        <h1><img src="<?php echo base_url('/img/footer-logo.png'); ?>" class="img-responsive" width="70" height="60"/><span style="vertical-align:bottom">a</span></h1>
    </div>

    <!-- Next and previous buttons -->
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span> 
    <span class="dot" onclick="currentSlide(2)"></span> 
    <span class="dot" onclick="currentSlide(3)"></span> 
    <span class="dot" onclick="currentSlide(4)"></span> 
    <span class="dot" onclick="currentSlide(5)"></span> 
    <span class="dot" onclick="currentSlide(6)"></span> 
    <span class="dot" onclick="currentSlide(7)"></span> 
    <span class="dot" onclick="currentSlide(8)"></span>

</div>

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 1000); // Change image every 2 seconds
    }
</script>