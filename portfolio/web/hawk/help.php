<?php $thisPage="help"; $page_title="Help";?>
<?php include 'includes/header.php'; ?>
  <div id="page-content"> 
    <!-- body content -->
    <?php include 'includes/side_nav.php'; ?>
    <section>
      <div class="contact-area">
        <div class="page">
          <h3><?php echo $page_title; ?></h3>
          <p>Need some Help?</p>
          <p>Give us a call or send us an email</p>
          <p>Phone: <a href="tel:+15555555555">1.555.555.5555</a></p>
          <p>Email: <a href="mailto:info@hawkconcepts.com">info@hawkconcepts.com</a></p>
          <p>Not what your looking for? drop us a line on our <a href="contact.php">contact form</a> or checkout some of the frequently asked questions bellow.</p>
          <p class="question"> 
            <span class="title"><span>+</span>Can I find these products in stores near me?</span>
            <span class="answer">Probably not. Since we're a small company and we don't plan on changing that.</span>
          </p>
          <p class="question"> 
            <span class="title"><span>+</span>How long will it take to ship the items?</span>
            <span class="answer">Checkout out our <a href="shipping.php">shipping</a> page. It usually takes 5-7 business days.</span>
          </p>
          <p class="question"> 
            <span class="title"><span>+</span>Can I return the item if it doesn't fit?</span>
            <span class="answer">Sure, not a problem. Just put it back in the box and send it home.</span>
          </p>
          <p class="question"> 
            <span class="title"><span>+</span>Can I get a store credit from my return?</span>
            <span class="answer">Yes. We will still take your money!</span>
          </p>
          <p class="question"> 
            <span class="title"><span>+</span>Will you like me if I buy something?</span>
            <span class="answer">Maybe, depends if your cool or not.</span>
          </p>
        </div>
      </div>
    </section>
    <div class="clear"></div>
  </div>
  <script src="help-page.js" type="text/javascript"></script>
  <?php include 'includes/footer.php'; ?>