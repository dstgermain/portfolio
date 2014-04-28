<?php $thisPage="contact"; $page_title="Contact Us";?>

<?php include 'includes/header.php'; ?>
  <div id="page-content"> 
    <!-- body content -->
    <?php include 'includes/side_nav.php'; ?>
    <section>
      <div class="contact-area">
        <form name="contact" method="POST" action="confirm.php">
          <fieldset>
            <input type="hidden" name="form_title" value="Contact Us"/>
            <legend>Contact us!</legend>
            <label for="name">Name <span class="req">*</span></label>
            <input name="name" type="text" required autofocus/>
            <div class="clear"></div>
            <label for="company">Company</label>
            <input name="company" type="text" />
            <div class="clear"></div>
            <label for="email">Email <span class="req">*</span></label>
            <input name="email" type="email" required email />
            <div class="clear"></div>
            <label for="telephone">Telephone Number <span class="req">*</span></label>
            <input name="telephone" type="tel" pattern='\d{3}[\-]\d{3}[\-]\d{4}' placeholder="eg. 555-555-5555" title="555-555-5555" required/>
            <div class="clear"></div>
            <label for="inquery">Inquery <span class="req">*</span></label>
            <select name="inquery" required>
              <option>General</option>
              <option>Marketing</option>
              <option>Customer Service</option>
              <option>Website</option>
            </select>
            <div class="clear"></div>
            <label for="message">Message <span class="req">*</span></label>
            <textarea name="message" required></textarea>
          </fieldset>
          <input type="submit"/>
        </form>
      </div>
    </section>
    <div class="clear"></div>
  </div>
  <?php include 'includes/footer.php'; ?>