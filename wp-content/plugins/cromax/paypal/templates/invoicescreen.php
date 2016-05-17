<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Cromatic Dashboard
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */


$status = get_post_meta( $post->ID, 'cro_statuslabel', true );

switch ( $status ) {
  case 1:
    $statuslabel = __('Initiated','croma');
    $statusstyle = 'background: #28ABE3; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  case 2:
    $statuslabel = __('Paid','croma');
    $statusstyle = 'background:  #5cb85c; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  case 3:
    $statuslabel = __('Cancelled','croma');
    $statusstyle = 'background: #763F7F; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  case 4:
    $statuslabel = __('Error','croma');
    $statusstyle = 'background: #CE0000; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  
}

$freq = get_post_meta( $post->ID, 'cro_payfreq', true );

switch ( $freq ) {
  case 1:
    $freqlabel = __('Once','croma');
    $freqstyle = 'background: #EC971F; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  case 2:
    $freqlabel = __('Monthly','croma');
    $freqstyle = 'background:  #1FDA9A; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  case 3:
    $freqlabel = __('Anually','croma');
    $freqstyle = 'background: #59323C; border: 1px solid rgba(0,0,0,0.3); color: #fff; text-align: center;';
  break;
  
}


?>

 <div class="cro_paypalscreen">

	<h2><?php _e('Donation details','croma'); ?></h2>

	<table style="width: 100%;">
		<tbody>
			<tr>
				<td style="border :1px solid #eee; padding: 5px;">
					<?php _e('Donator','croma'); ?>
				</td>

				<td style="border :1px solid #eee; padding: 5px;">
					<?php echo get_post_meta( $post->ID, 'cro_name', true ); ?> <?php echo get_post_meta( $post->ID, 'cro_surname', true ); ?>
				</td>
			</tr>
			<tr>
				<td style="border :1px solid #eee; padding: 5px;">
					<?php _e('Email','croma'); ?>
				</td>

				<td style="border :1px solid #eee; padding: 5px;">
					<?php echo get_post_meta( $post->ID, 'cro_email', true ); ?>
				</td>
			</tr>
      <tr>
        <td style="border :1px solid #eee; padding: 5px;">
          <?php _e('Amount','croma'); ?>
        </td>

        <td style="border :1px solid #eee; padding: 5px;">
          <?php echo get_post_meta( $post->ID, 'cro_ammt', true ); ?>
        </td>
      </tr>
      <tr>
        <td style="border :1px solid #eee; padding: 5px;">
          <?php _e('Status','croma'); ?>
        </td>

        <td style=" padding: 5px; <?php echo $statusstyle; ?>" class="cro_paystat<?php echo $status; ?>">
          <?php echo $statuslabel; ?>
        </td>
      </tr>
      <tr>
        <td style="border :1px solid #eee; padding: 5px;">
          <?php _e('Frequency','croma'); ?>
        </td>

        <td style=" padding: 5px; <?php echo $freqstyle; ?>" class="cro_payfreq<?php echo $freq; ?>">
          <?php echo $freqlabel; ?>
        </td>
      </tr>
		</tbody>
    </table>

	


    <?php 

      if (get_post_meta( $post->ID, 'paypaldetails', true ) != '')      { 

          $paypalarray = json_decode(rawurldecode( get_post_meta( $post->ID, 'paypaldetails', true ) ));
    

    ?>

    <h2><?php _e('Paypal payment details','croma'); ?></h2>

          <table style="width: 100%;">
            <tbody>

              <?php foreach ($paypalarray as $key => $value) {  ?>
               
                <tr>
                  <td style="border :1px solid #eee; padding: 5px;">
                    <?php echo $key; ?>
                  </td>
                  <td style="border :1px solid #eee; padding: 5px;">
                    <?php echo $value; ?>
                  </td>
                </tr>
              
              <?php }  ?>
            </tbody>
          </table>
        
     <?php 

        }   

    ?>


  </div>