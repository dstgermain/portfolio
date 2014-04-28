<?php $thisPage="contact"; $page_title="Form Confirmation";?>
<?php include 'includes/header.php'; ?>
  <?php
$formTitle= $_POST["form_title"];
$formName= $_POST["name"]; 
$formCompany= $_POST["company"]; 
$formEmail= $_POST["email"];  
$formTelephone= $_POST["telephone"]; 
$formInquery= $_POST["inquery"];  
$formMessage= $_POST["message"]; 
?>
  <div id="page-content"> 
    <!-- body content -->
    <aside>
      <nav>
        <ul>
          <li><a href="" class="current">Contact Us</a></li>
          <li><a href="">Policies</a></li>
          <li><a href="">Privacy</a></li>
          <li><a href="">Shipping</a></li>
          <li><a href="">Help</a></li>
        </ul>
      </nav>
    </aside>
    <section>
      <div class="contact-area">
        <?php  
            print "<h1 class='confirm-header'>$formTitle Confirmation</h1>";
            print "<p class='confirm'>Hey $formName,</p>";
			print "<p class='confirm'>Thanks for contacting us! We'll get back to you as soon as possible.</p>";
			print "<p class='confirm'>Below you'll find an overview of what you just submitted.";
			print "<span class='review'>Name: $formName</span>";
			if ($formCompany !== '') 
				print "<span class='review'>Company: $formCompany</span>";
			print "<span class='review'>Email: $formEmail</span>";
			print "<span class='review'>Telephone: $formTelephone</span>";
			print "<span class='review'>Inquery: $formInquery</span>";
			print "<span class='review'>Message: $formMessage</span>";
        ?>
      </div>
    </section>
    <div class="clear"></div>
  </div>
  <?php include 'includes/footer.php'; ?>