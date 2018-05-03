// Contact page

<form method="post" action="" onsubmit="return false">
  <div class="row">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <input name="UserName" class="text_input is_empty" id="UserName" value="" placeholder="Name*" required type="text">
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
      <input name="UserEmail" class="text_input is_email" id="UserEmail" value="" placeholder="E-Mail*" required type="text">
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <textarea placeholder="Message*" name="Message" class="text_area is_empty" cols="40" rows="7" required id="Message"></textarea>
    </div>
    <div class="contact-submit">
      <input value="1" name="avia_generated_form1" type="hidden">
      <input value="Send" class="button" data-sending-label="Sending" type="submit" onclick="sendcontact()">
    </div>
  </div>
</form>


//Form send by Ajax
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" ></script>
<script>
jQuery(document).ready(function() {
	  jQuery(".loader-img1").hide();
	});

	function sendcontact(){
        jQuery('#error3').html('');
        jQuery('#suss3').html('');
       	var UserName = document.getElementById('UserName').value;
       	var UserEmail = document.getElementById('UserEmail').value;
       	var Message = document.getElementById('Message').value;
       	var subject = "Hand Bags By Lisa Contact";
       	if((UserName!='') && (UserEmail!='') && (Message!='')){
          	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if(re.test(UserEmail)){
             	jQuery.ajax({
	                url: "<?php echo get_stylesheet_directory_uri(); ?>/page-templates/send-mail.php",
	                data: {UserName:UserName,UserEmail:UserEmail,Message:Message,subject:subject},
	                type: 'POST',
	                beforeSend: function () {
	                   jQuery("#loader-wrapper1").show();
	                },
	                complete: function () {
	                   jQuery("#loader-wrapper1").hide();
	                },
	                success: function (data) {
	                    jQuery('#suss3').html('Email sent successfully');
	                	jQuery("form").trigger("reset");
	                },
	                error: function () {
	                   jQuery('#error3').html('There was an erroe trying to send your message. Please try again later.');
	                }
	            });
          	}else{
            	jQuery('#error3').html('Enter valid email address');
          	}
       	}else{
          	jQuery('#error3').html('Enter required field');
       	}
    }

</script>

//Send mail page

<?php
require_once("../../../../wp-load.php");
$subject = $_POST['subject'];
$admin_email = get_option('email');
	$UserName = $_POST['UserName'];
	$UserEmail = $_POST['UserEmail'];
	$Message = $_POST['Message'];
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	//$headers .= 'From: The Wireless Galaxy <info@embedinfosoft.com>' . "\r\n";
	//$headers .= 'Bcc: <'.$admin_email.'>' . "\r\n";

	$msg = '<table cellspacing="0" cellpadding="0" border="0" style="float: none; width: 800px; overflow: hidden; border-left: 3px solid #FC7059; border-top: 3px solid #FC7059; color: rgb(36, 36, 36);">
		<tbody>
			<tr>
				<td style="padding: 10px; width: 800px; border-bottom: 3px solid #FC7059; border-right: 3px solid #FC7059; background-color: #FC7059; color: rgb(255, 255, 255); text-align: left;" colspan="2"><h3 style="font-family: Helvetica,Arial,sans-serif; font-size: 24px; margin: 13px 0px; color: #fff;">'.$UserName.'\'s Contact Information</h3></td>
			</tr>
			<tr>
				<td style="width: 200px; padding: 10px; border-bottom: 3px solid #FC7059; border-right: 3px solid #FC7059; text-align: left;">Name</td>
				<td style="padding: 10px; width: 579px; border-right: 3px solid #FC7059; border-bottom: 3px solid #FC7059;">'.$UserName.'</td>
			</tr>
			<tr>
				<td style="width: 200px; padding: 10px; border-bottom: 3px solid #FC7059; border-right: 3px solid #FC7059; text-align: left;">Email</td>
				<td style="padding: 10px; width: 579px; border-bottom: 3px solid #FC7059; border-right: 3px solid #FC7059;">'.$UserEmail.'</td>
			</tr>
			<tr>
				<td style="width: 200px; padding: 10px; border-bottom: 3px solid #FC7059; border-right: 3px solid #FC7059; text-align: left;">Message</td>
				<td style="padding: 10px; width: 579px; border-bottom: 3px solid #FC7059; border-right: 3px solid #FC7059;">'.$Message.'</td>
			</tr>
		</tbody>
	</table>
	<br>
	<br>
	<p>This e-mail was sent from a contact form on The Wireless Galaxy (<a href="'.site_url().'">'.site_url().'</a>)</p>
	';


if(mail( $admin_email, $subject, $msg, $headers)){
	echo "yes";
}else{
	echo "error";
}
?>
