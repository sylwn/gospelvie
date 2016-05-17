<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *
 * class=dashboard
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	croma.class
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		dashboard for the class bookings
 */


// <!--  -->

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$options = get_option('cro_class_mails');


$email_arr = array(

				'admin_justdonated' 	=> array(

					'type' 				=> __('Donation started','croma'),
					'recipient' 		=> __('Admin','croma'),
					'recipclass' 		=> 'cro_toadmin',
					'title_def' 		=> 'New donation started on your website',
					'title_sub_def' 	=> 'Good day admin. You had a new donation on your website customer is being directed to paypal right now',
					'body_def' 			=> 'Below the details of donation',
					'title_label' 		=> __('Title message','croma'),
					'title_sub_label' 	=> __('Sub title message','croma'),
					'body_label' 		=> __('Body message','croma'),
				),
				'admin_errorwarning' 	=> array(

					'type' 				=> __('Error warning','croma'),
					'recipient' 		=> __('Admin','croma'),
					'recipclass' 		=> 'cro_toadmin',
					'title_def' 		=> 'There was an error with a donation',
					'title_sub_def' 	=> 'Good day admin. There was an error and a donation did not get processed',
					'body_def' 			=> 'Below the details of the error',
					'title_label' 		=> __('Title message','croma'),
					'title_sub_label' 	=> __('Sub title message','croma'),
					'body_label' 		=> __('Body message','croma'),
				),
				'customer_paymentreceived' => array(

					'type' 				=> __('Donation just paid','croma'),
					'recipient' 		=> __('Customer','croma'),
					'recipclass' 		=> 'cro_tocust',
					'title_def' 		=> 'Thank you for your donation.',
					'title_sub_def' 	=> 'We received your payment. Thank you',
					'body_def' 			=> 'Below the details of the donation',
					'title_label' 		=> __('Title message','croma'),
					'title_sub_label' 	=> __('Sub title message','croma'),
					'body_label' 		=> __('Body message','croma'),
				),
				'admin_paymentreceived' => array(

					'type' 				=> __('Donation just paid','croma'),
					'recipient' 		=> __('Admin','croma'),
					'recipclass' 		=> 'cro_toadmin',
					'title_def' 		=> 'A donation payment was sucessful.',
					'title_sub_def' 	=> 'A payment made through Paypal was successful',
					'body_def' 			=> 'Details of the donation below',
					'title_label' 		=> __('Title message','croma'),
					'title_sub_label' 	=> __('Sub title message','croma'),
					'body_label' 		=> __('Body message','croma'),
				),
				'admin_cancelled' 	=> array(

					'type' 				=> __('Cancelled donation','croma'),
					'recipient' 		=> __('Admin','croma'),
					'recipclass' 		=> 'cro_toadmin',
					'title_def' 		=> 'Cancelled donation',
					'title_sub_def' 	=> 'Good day admin. There was a cancelled donation. Details below. You might want to follow up with the donor.',
					'body_def' 			=> 'Below the details of the cancellation',
					'title_label' 		=> __('Title message','croma'),
					'title_sub_label' 	=> __('Sub title message','croma'),
					'body_label' 		=> __('Body message','croma'),
				)

			);


?>

<!-- CROMATIC PREHEADER -->
<div class="cromatic_preheader">

	<!--  Page title  -->
	<h1><?php _e('Email messages','croma'); ?></h1>

</div><!-- cromatic_preheader -->


<form action="<?php echo admin_url('admin.php?page=cromaclass_mail'); ?>" method="post">


	<!-- TOGGLER HEADER <-->
	<div class="cro_togglerwrap">

		<div class="cro_monthwrap cro_wrapcenter">
			<button name="cro_formsubmit" value="Y"><?php _e('Save Values','croma'); ?></button>
		</div>	
	</div>


	<!-- OUTSIDE WRAP -->
	<div class="cro-wrap">



		<!-- PAGE BODY -->
		<div class="cro_wrapbody">



			<div class="cro_emess">


				<?php foreach ($email_arr as $key => $value) {  

					$titlemess 		= ($options[$key . '_t'] != '')? $options[$key . '_t'] : $value['title_def'];
					$titlesubmess 	= ($options[$key . '_s'] != '')? $options[$key . '_s'] : $value['title_sub_def'];
					$bodymess 		= ($options[$key . '_b'] != '')? $options[$key . '_b'] : $value['body_def'];


				?>
				

					<div class="cro_single_element">


						<div class="cro_single_elem_title">
							<h3 class="cro_mail_clicker"><?php echo $value['type'];  ?><span class="<?php echo $value['recipclass'];?>"><?php echo $value['recipient'];  ?></span></h3>
						</div>

						<div class="cro_single_elem_body">

							<p>
								<label for="<?php echo $key;  ?>_t"> <?php echo $value['title_label'];  ?></label>
								<textarea name="<?php echo $key;  ?>_t"><?php echo stripslashes(esc_textarea($titlemess)); ?></textarea>
							</p>

							<p>
								<label for="<?php echo $key;  ?>_s"> <?php echo $value['title_sub_label'];  ?></label>
								<textarea name="<?php echo $key;  ?>_s"><?php echo stripslashes(esc_textarea($titlesubmess)); ?></textarea>
							</p>

							<p>
								<label for="<?php echo $key;  ?>_b"> <?php echo $value['body_label'];  ?></label>
								<textarea name="<?php echo $key;  ?>_b"><?php echo stripslashes(esc_textarea($bodymess)); ?></textarea>
							</p>
							
						</div>




					</div>
				

				<?php }  ?>


			</div>


		</div><!-- cro_wrapbody -->

	</div><!--  cro-wrap -->

</form><!-- form -->

