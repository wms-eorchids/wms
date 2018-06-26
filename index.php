<?php
echo 'Hi';
ob_start();
require_once("inc/config.php");
require_once("inc/edb.php");
require_once("inc/menu.php");
require_once("inc/home_form.php");
require_once("inc/functions.php");
require_once("inc/career.php");
require_once("inc/image.php");
require_once('inc/PHPMailer-master/PHPMailerAutoload.php');
$db = new edb(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$mail = new PHPMailer();

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(tablet|ipad|playbook)|(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{ $type="Mobile"; }else { $type="Desktop"; }


if(isset($_POST['submit']))
			{
				//if ($_POST['captcha'] == $_SESSION['cap_code']) {
					
				if ($_POST['g-recaptcha-response'] != '') {	
					
				$enqid = $_POST['enqID'];
				$enquiry = FORM::getEnquiryName($db, $enqid);
				$email_id = $_POST['email_id'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$phone = $_POST['phone'];
				
				
				if($phone!='' || $email_id!='')
				{
				
				                    $num=$phone;
									$ss=array("(",")"," ","-");
									$mob= str_replace($ss,"",$num);

									$a = $mob;
									$b = array('-', '-');
									$c = array(3, 6);
									for ($i = count($c) - 1; $i >= 0; $i--) {
									$a = substr_replace($a, $b[$i], $c[$i], 0);
									}


									$a1 = $mob;
									$b1 = array('(', ') ','-');
									$c1 = array(0, 3,6);
									for ($i = count($c1) - 1; $i >= 0; $i--) {
									$a1 = substr_replace($a1, $b1[$i], $c1[$i], 0);
									}
									
									
									if($phone!='')
									{ $mo11="mobile='".$mob."' OR ";  
									  $mo12="mobile='".$a."' OR "; 									
									  $mo13="mobile='".$a1."' "; 
									  
									  
									  $mo21="mobile2='".$mob."' OR ";  
									  $mo22="mobile2='".$a."' OR "; 									
									  $mo23="mobile2='".$a1."' "; 
									  
									  
									  $mo31="home_phone='".$mob."' OR ";  
									  $mo32="home_phone='".$a."' OR "; 									
									  $mo33="home_phone='".$a1."' "; 
									  
									  $mo41="home_phone2='".$mob."' OR ";  
									  $mo42="home_phone2='".$a."' OR "; 									
									  $mo43="home_phone2='".$a1."' "; 
									  
									  $mo51="office='".$mob."' OR ";  
									  $mo52="office='".$a."' OR "; 									
									  $mo53="office='".$a1."' "; 
									  
									  $mo61="office2='".$mob."' OR ";  
									  $mo62="office2='".$a."' OR "; 									
									  $mo63="office2='".$a1."' "; 
									  
									 $mo_num=" ((". $mo11 . $mo12 . $mo13 .") OR  (". $mo21 . $mo22 . $mo23 .") OR (". $mo31 . $mo32 . $mo33 .") OR (". $mo41 . $mo42 . $mo43 .") OR (". $mo51 . $mo52 . $mo53 .") OR (". $mo61 . $mo62 . $mo63 ."))";  
									
									} else { $mo_num="";  }
									
									if($email_id!='')
									{
									$eid="(email='".$email_id."')";
									} else { $eid=""; } 
									
									if($phone!='' and $email_id!='')
									{
									$orr=" OR ";
									}
			
				$sel1="Select *from ".HOME_CLIENTS." where (". $mo_num .$orr. $eid .") AND is_delete = 0  AND is_open = 0";
				$cli_res = $db->line($sel1);
				if(count($cli_res)>1) { $cid="cr_client_id=".$cli_res['client_id']."," ; } else { $cid="cr_client_id='0'," ; }
				
				} 
				
				
				$regionID = FORM::regionName($db, REGION, $_POST['regionID']);
				$contact_me = array('Email'=>'email','Phone Call Forenoon'=>'pham','Phone Call Afternoon'=>'phpm','No need to contact me'=>'no');
				$cont_me = array(''.$_POST['cont_me'].''=>''.$_POST['cont_me'].'');
				$result = array_intersect($contact_me, $cont_me);
				$contact_me = array_keys($result);
				//echo 'Hi';
				$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$form_url.'/contact_forms.php';
				$comments = '<div>Contact me through: '.$contact_me[0].'</div><div>Name: '.$fname.$lname.'</div><div>Email: '.$email_id.'</div><div>My Mobile Number is: '.$phone.'</div><div>Interested Area: '.$regionID.'</div><div>Enquiry Type: '.$enquiry.'</div><div>Page Url: '.$actual_link.'</div><div>Device: '.$type.'</div>'.'<div>'.$_POST['comments'].'</div>';
					$mail = new PHPMailer(); // defaults to using php "mail()"
					//$mail->IsSendmail();
					
					$mail->IsSMTP();
					$mail->SMTPAuth = true;
					$mail->Host = "mail.ivoryhub.co";
					$mail->Port = 25;
					$mail->Username = "send_mail@ivoryhub.co";
					$mail->Password = "An1#7?H0E+8d";
					//$mail->setFrom('IvoryCalendar@ivoryhomes.com', 'Ivory, Homes');
					$mail->IsHtml(true);
					
					$mail->SetFrom(''.$email_id.'',''.$fname.'');
											//$mail->AddReplyTo($rec_arr[$i],$messages);
					$mail->Subject    = $type." Ivory Homes Contact Us Page Inquiry ";
											//$mail->IsHtml(true);
					$mail->MsgHTML($comments);
					
					$mail->addAddress('marketing@ivoryhomes.com');
					//$mail->addAddress('krvinodhmca@gmail.com');
					//$mail->Send();
					if($mail->Send())
					{
					$success = 1; 
					
					$cre_repair="INSERT INTO iv_credit_repair SET ".$cid." cr_fname='".mysql_real_escape_string($_POST['fname'])."',cr_lname='".mysql_real_escape_string($_POST['lname'])."',cr_email='".mysql_real_escape_string($email_id)."',cr_mobile_no='".mysql_real_escape_string($phone)."',cr_enq_type='".mysql_real_escape_string($enqid)."',cr_primary_area='".mysql_real_escape_string($_POST['regionID'])."',cr_send_option='".mysql_real_escape_string($contact_me[0])."',cr_comment='".mysql_real_escape_string($_POST['comments'])."',cr_status='1',cr_add_date='".mysql_real_escape_string($date)."',cr_modified='".mysql_real_escape_string($date)."',cr_type='".$type."',cr_lead_source='".mysql_real_escape_string($actual_link)."',cr_page_name='Contact Us'";
					mysql_query($cre_repair);
					}
					else
					{
					$success = 0; 
					}
					$mail->ClearAllRecipients();
					} else { 
		        $success1=2;
				$msg='<h4 style="font-size: 20px;font-weight: 300;line-height: 36px; color:red; text-align:center;">Incorrect Captcha, Please Enter Correct Captcha</h4>'; 
				 }
					
			}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link href='<?php echo MAIN_SITE_V2; ?>autocomplete/autocomplete.css' rel='stylesheet' type='text/css'>
		
		
		 <link href="<?php echo MAIN_SITE_V2; ?>css/bootstrap/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
       
        <title>Contact Us</title>
        
</head>

    <body>
    
    	<header>
        	<?php 
			include('header.php');
			?>
        </header>
        
        <!--Ivory Leads Static Banner -->
        
		<div id="comm-form-btm" style="margin-top:65px;">
            <div class="container">
            	<div class="row">
                	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3>Contact Us</h3>
                        
						<?php echo ($success!=''?($success==1?"<p style='color:#fff; text-align:center;'>Thank you for contacting us, a representative will reach out to you soon</p>":"<p style='color:#FF0000;text-align:center;'>E-mail send failed</p>"):""); ?>
                        <?php if($success1==2) { echo $msg; } ?>
                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                        </div>
                        
                       <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        	<form name="frm" action="" id="commentForm" method="post" class="loc">
                            	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                	<input name="fname" id="fname" type="text" placeholder="Enter Your First Name" class="" id=""/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                	<input name="lname" id="lname" type="text" placeholder="Enter Your Last Name" class="" id=""/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                	<input onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.keyCode == 8' name="phone" id="phone" placeholder="Enter Your Mobile Number" class="multi_validate" id=""/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                	<input name="email_id" id="email_id" type="email" placeholder="Enter Your Email" class="multi_validate" id=""/>
                                </div>
								
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<select id="enqID"  name="enqID" size="1" class="">
								<option>Enquiry Type</option>
								</select>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<select name="regionID" id="regionID"  size="1"  class="" >
								<option>How did you hear about us?*</option>
								</select>
                                </div>
								
                                
                                <div class="clearfix"></div>
                                <div id="mov-con-form1" class="comm-fm" style="text-align:center;">
                                    <div class="radio">
                                       <input type="radio" value="email" name="cont_me" id="y">
                                        <label for="y">E-mail</label>
                                        <input type="radio" value="pham" name="cont_me" id="n">
                                        <label for="n">Phone AM</label>
                                        <input type="radio" value="phpm" name="cont_me" id="e">
                                        <label for="e">Phone PM</label>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <textarea name="comments" id="comments" cols="" rows="" placeholder="Enter Your Comment"></textarea>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p style="margin-bottom: 0;margin-left: 10px;">Check the box below so we know you’re a real person. Then click Submit.</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                
                                <!-- <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 warr-no-padd">
                                <input type="text" name="captcha" id="captcha" class="" value="" placeholder="Enter your security code" autocomplete="off" style="width:50%;" onkeydown="FormValidation()"/>
                                <span id="capt_code"></span>
                                <a onclick="event.preventDefault(); myfunc();" class="red-ref-btn" ><i class="fa fa-refresh"></i></a>                   
                                </div> -->
                                
                                  <div style="margin-left:10px; margin-top:10px;" class="g-recaptcha" data-sitekey="6LchYAcUAAAAANpZunDn-Y1k3DiiGKvhavx-MdyC"></div>
                                </div>
                                
                                <div class="pull-center">
                                <button value="Submit" type="submit" name="submit">Submit</button>
                                </div>
                                
                            </form>
                        </div>
						
                        <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                        </div>
                        
                    </div>
                </div>
            </div>
          </div> 
                 
		<?php 
		$source = FORM::Source($db,HOME_SOURCE);
		$refion = FORM::region($db,REGION);
		$enqu	 = FORM::getEnquiry($db, $genq);
		?>

        <!-------------------Footer Part Start ----------->
		
        <?php include('footer.php');?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="<?php echo MAIN_SITE_V2; ?>autocomplete/jquery-ui.js"></script>
		<script type="text/javascript" src="<?php echo MAIN_SITE_V2; ?>js/jquery.maskedinput-1.3.1.min_.js"></script>
		<script src="<?php echo MAIN_SITE_V2; ?>js/jquery.validate.js"></script>
        <script src="<?php echo MAIN_SITE_V2; ?>js/additional_method.js"></script>
        
		
		<script type="text/javascript">
		
		function FormValidation()
			{
			var fn=document.getElementById('captcha').value;
			if(fn == ""){
				document.getElementById('captcha').style.background = "#EB9EBB";
				return false;
			} else{
				document.getElementById('captcha').style.background = "#BCE3BB";
				return true;
			} }
			
			$('<img />').attr('src', '<?php echo MAIN_SITE; ?>phpcaptcha/captcha.php').load(function() {
				  $(this).appendTo('#capt_code');
			  });
			function myfunc()
			{
			
				$('<img />').attr('src', '<?php echo MAIN_SITE; ?>phpcaptcha/captcha.php?cache=' + new Date().getTime()+'').load(function() {
						$('#capt_code').html('');
					 $(this).appendTo('#capt_code');
				
			  });
			   
			}
		
        $(document).ready(function(){
			var option = '<?php echo $source; ?>';
			var region = '<?php echo $refion; ?>';
			var city = '<?php echo $city; ?>';
			var enq = '<?php echo $enqu; ?>';
			$('#enqID').html(enq);
			$('#leadsourceID').html('<option value="">How did you hear about us?*</option>'+option);
			$('#regionID').html('<option value="">Primary Area of Interest*</option>'+region);
			$('#cityID').html(city);
			
			
			 $("#commentForm").validate({
					 rules: {
						fname: "required",
						lname: "required",
						phone: {
							require_from_group: [1, ".multi_validate"]
						},
						enqID: "required",
						regionID: "required",
						comments: {
						  required: true,
						  minlength: 5
						},
						email_id: {
							require_from_group: [1, ".multi_validate"]
						}
					},
					messages: {
						fname: "Enter your first name",
						lname: "Enter your last name",
						phone: "",
						enqID: "Select enquiry type",
						regionID: "Select primary area",
						comments: "Enter your comments here",
						email_id: {
							required: "Enter Email",
							email_id: "Please enter a valid email address"
						}
					}
				    });	
			
       });
       </script>
		
		<script type="text/javascript">
        function FormValidation() {
            var fn = document.getElementById('captcha').value;
            if (fn == "") {
                document.getElementById('captcha').style.background = "#F7BCCD";
                return false;
            } else {
                document.getElementById('captcha').style.background = "#BCF7CC";
                return true;
            }
        }
    </script>    
		
    
    </body>
    
</html>
>>>>>>> 819c613ea303d03ee0eb52d8b4295ebc0adc921b
