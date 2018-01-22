<?php
$check = array("Customer");
include ("../includes/header_functions.php");

$title="Your Orders | MoHPlayer.com";
if (!isset($_SESSION['login_session'])) {
    exit;
}
if ($_SESSION['login_session'] == 0 || $_SESSION['login_session'] == '') {
    exit;
}


if (isset($_GET['oid']) && !isset($_GET['job'])) {
	header('location: jobs.php?job='.$_SESSION['buysa_job'].'&oid='.$_GET['oid']);
	exit;
}
//Check the payment worked
if (isset($_GET['oid'])) { // Replace with whatever is used to check barclaycard details
	foreach ( $_POST as $key => $value ) {
		$$key = $value; $_SESSION[$key] = $value;
	}

	//Check the inputs
	$error = array();
	if (count($error) == 0) {

		//Order information and payment processing
		$oid = '';
		//Get the corresponding order ID from transactions

		//Check the transactionstatus was 'Success' otherwise display an error message
		$oid = $_GET['oid'];
		$transactionSQL = "SELECT * FROM transactions WHERE oid = ".$dbConn->quote_smart($oid);
		$transactions = $dbConn->SQLToArray($transactionSQL);

		if ($transactions['recordCount'] == 0) {
			$error[] = 'There was a problem processing your payment. The site owners have been notified';
			mail('customerservices@mohplayer.com', 'Issue taking payment from an End User', 'The payment processor has referred the user back to the site, but the transaction cant be found in the database.

This should never happen, so you should never see this message, but if it does then check the order and check it has been paid for correctly.

Transaction: '.$_GET['oid']);
		} else {
			if (strtolower($transactions[0]['transactionstatus']) != 'success') {
				$error[] = "There was a problem taking your payment. If you would like to try again, please click &#39;Purchase Script Assistance&#39; once more";
			}
		}
		if (count($error) == 0) {
			//Update the current job and set script assistance to 1
			$sql = "UPDATE jobs SET hasScriptAssistance = 1 WHERE id = ".$dbConn->quote_smart($_GET['job']);
			$dbConn->otherQuery($sql);
			$success = 'Script Assistance Payment Successful! You may now ask for script modifications';
		}
	}
}

//Defaults for file uploads - Might not be needed any more
$trackName = '';
$shortDescription = '';

// Array needed for the header. Array(ImageUrl, Title, Text)
$showBanner = array('/images/whatNextHeader.png', $translation->get_text('DO_NEXT_1_TITLE'), $translation->get_text('DO_NEXT_1_TEXT'));

//Set the custom filters if they've been changed
if (!isset($_SESSION['custom__music_filter'])) { $_SESSION['custom_music_filter'] = ''; }
if (isset($_POST['custom_music_filter'])) { $_SESSION['custom_music_filter'] = $_POST['custom_music_filter']; }

//Get the filter for the music selection
$musicsearchterm = "";
if ($_SESSION['custom_music_filter'] != '') {
    $musicsearchterm = $_SESSION['custom_music_filter'];
}

//Get the music limit
$musiclimit = 0;
if (isset($_GET['musiclimit'])) {
    $_SESSION['musiclimit'] = $_GET['musiclimit'];
}
if (isset($_SESSION['musiclimit'])) {
    $musiclimit = intval($_SESSION['musiclimit']);
}
$music = $moh->get_audio('Music','', '', '(trackArtist LIKE '.$dbConn->quote_smart('%'.$musicsearchterm.'%').' OR shortDescription LIKE '.$dbConn->quote_smart('%'.$musicsearchterm.'%').' OR trackName LIKE '.$dbConn->quote_smart('%'.$musicsearchterm.'%').')', 'LIMIT '.$musiclimit.', 10 ');

//If there's no music yet there's pagination then reset the pagination
if ($music['recordCount'] == 0 && $musiclimit > 0) {
    $musiclimit = 0;
    $music = $moh->get_audio('Music','', '', '(trackArtist LIKE '.$dbConn->quote_smart('%'.$musicsearchterm.'%').' OR shortDescription LIKE '.$dbConn->quote_smart('%'.$musicsearchterm.'%').' OR trackName LIKE '.$dbConn->quote_smart('%'.$musicsearchterm.'%').')', 'LIMIT '.$musiclimit.', 10 ');
}

//Remove the music
if (isset($_GET['removemusic'])) {
	$sql = "UPDATE jobs SET musicID = 0 WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
	$dbConn->otherQuery($sql);
	$dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Music Removed by '.$_SESSION['fullname'], 0);

}
//If the user wants to order another announcement, do that
if (isset($_GET['orderannouncement'])) {
    if (isset($_SESSION['reason_not_free'])) { unset($_SESSION['reason_not_free']); }
    $serials = $moh->get_serial_numbers($_GET['orderannouncement']);
    if ($serials['recordCount'] == 0) {
        $error[] = $translation->get_text('ERROR_CODE_DOESNT_EXIST');
    }
    if ($serials['recordCount'] > 0 && ($serials[0]['quantity'] == 0 || $serials[0]['quantity'] == '')) {
        $_SESSION['reason_not_free'] = $translation->get_text('ERROR_CODE_NO_ANNOUNCEMENTS');
    }

    if ($serials['recordCount'] > 0 && ($serials[0]['is_expired'] == 1 )) {
        $_SESSION['reason_not_free'] = $translation->get_text('ERROR_CODE_EXPIRED');
    }
    if (count($error) == 0) {
        $_SESSION['dealerCommissionRate'] = $moh->get_commission($serials[0]['dealerID']);
        $_SESSION['distributorCommissionRate'] = $moh->get_commission($serials[0]['distributorID']);
        $_SESSION['dealerActorServicesCommissionRate'] = $moh->get_commission($serials[0]['dealerID'], 'commissionActorServices');
        $_SESSION['distributorScriptCommissionRate'] = $moh->get_commission($serials[0]['distributorID'], 'commissionActorServices');
        $_SESSION['dealerID'] = $serials[0]['dealerID'];
        $_SESSION['distributorID'] = $serials[0]['distributorID'];

        $_SESSION['serial_number'] = $_GET['orderannouncement'];
        header ('location: /mohplayer/select_artist.php');
    }
}

//If the user has selected a job, get that job
if (isset($_GET['job'])) {
    $jobs = $moh->get_jobs($_GET['job']);
    $selected_job = $jobs[0];

    if ($jobs['recordCount'] == 0) { header('location: /mohplayer/jobs.php'); }
    if ($_SESSION['login_session'] != $selected_job['actorID'] && $_SESSION['login_session'] != $selected_job['customerID'] && $_SESSION['login_session'] != $selected_job['dealerID'] ) {
        header('location: /mohplayer/jobs.php');
    }

    $customer = $moh->get_people('Customer', $jobs[0]['customerID']);
    $actor = $moh->get_people('Actor', $jobs[0]['actorID']);

    $nextText = $moh->customer_long_job_status($selected_job['jobStatus'], true);
    $showBanner = array('/images/whatNextHeader.png', $translation->get_text('DO_NEXT_1_TITLE'), $nextText);
}

//Get the current end user ID
$id = $_SESSION['login_session'];

//Accept the job
if (isset($_GET['accept']) && isset($_GET['job'])) {
    //$sql = "UPDATE jobs SET jobStatus = 'Accepted' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND jobStatus = 'New' AND customerID = ".$_SESSION['login_session'];
    //$dbConn->otherQuery($sql);
    //$dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Job accepted by '.$_SESSION['fullname'], 0);
}

//Cancel this job
if (isset($_GET['cancel']) && isset($_GET['job'])) {
    $sql = "UPDATE jobs SET jobStatus = 'Cancelled' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
    $dbConn->otherQuery($sql);
    $dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Job cancelled by '.$_SESSION['fullname'], 0);

    //Redeem the used serial number

}

//Revert music
if (isset($_GET['revert']) && isset($_GET['job'])) {
    $sql = "UPDATE jobs SET musicID = ".$dbConn->quote_smart($_GET['revert'])." WHERE id = ".$dbConn->quote_smart($_GET['job']);
    $dbConn->otherQuery($sql);
    $success = $translation->get_text('SUCCESS_MUSIC_CANCELLED');
}

//Save music
if (isset($_GET['savemusic']) && isset($_GET['job'])) {
    $success = $translation->get_text('SUCCESS_MUSIC_CHANGED');
}

//Upload new script
if (isset($_POST['comments']) && isset($_GET['job']) && isset($_GET['commentscript'])) {
    $sql = "DELETE FROM temp"; $dbConn->otherQuery($sql);
    $sql = "INSERT INTO temp (value) VALUES (".$dbConn->quote_smart($_POST['comments']).")"; $dbConn->otherQuery($sql);
    $moh->fixed_email('actor_blank.php?jobID='.$_GET['job'], 'actor_blank_text.php?jobID='.$_GET['job'], $actor[0]['email'], 'actorservices@mohplayer.com', 'Job: '.$_GET['job'].' - New comments from your Customer regarding the script');
    if ($actor[0]['is_sms'] == 1) {
        $sms_phone = $dbConn->numbers_only('00'.$actor[0]['phoneCode'].$actor[0]['phone']).'.'.$moh->sms_pin.'@sms160.textapp.net';
        $moh->fixed_email('sms_actor_new_script.php', 'sms_actor_new_script.php', $sms_phone, $moh->sms_user, '');
    }
    $sql = "UPDATE jobs SET jobStatus = 'Script' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
    $dbConn->otherQuery($sql);
    $moh->write_script($_GET['job'], $_SESSION['login_session'], $_POST['comments']);
    $success = $translation->get_text('SUCCESS_NEW_COMMENTS_SENT');
}

//Original Script to be used
if (isset($_GET['originalscript']) && isset($_GET['job'])) {
	$jobs_original = $moh->get_jobs($_GET['job']);
	if ($jobs_original['recordCount'] > 0) {
		$job_original = $jobs[0];
		$status_original = $job_original['jobStatus'];
		if ($status_original == 'Script' || $status_original == 'Revision' || $status_original == 'Accepted') {
			$sql = "UPDATE jobs SET jobStatus = 'Accepted', scriptAssistanceRefundNeeded = 1, hasScriptAssistance = 0 WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
			$dbConn->otherQuery($sql);
			$dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Customer indicated no script assistance required', 0);
			$success = $translation->get_text('SUCCESS_ORIGINAL_SCRIPT');

		}

	}

}

//Feedback
if (isset($_POST['feedback_job_id']) && isset($_POST['feedback_actor_id'])) {
    $moh->record_feedback($_POST['feedback_rating'], $_POST['feedback_comments'], $_POST['feedback_actor_id'], $_POST['feedback_job_id']);
    $success = 'Your feedback has been recorded.';
    $dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Feedback Recorded with a rating of '.$_POST['feedback_rating'].': '.$_POST['feedback_comments'], 0);
}

//Approve script
if (isset($_GET['job']) && isset($_GET['approvescript'])) {
    $sql = "UPDATE scripts SET is_approved = 0 WHERE jobID = ".$dbConn->quote_smart($_GET['job']); $dbConn->otherQuery($sql);
    $sql = "UPDATE scripts SET is_approved = 1 WHERE id = ".$dbConn->quote_smart($_GET['approvescript']); $dbConn->otherQuery($sql);
    $sql = "UPDATE jobs SET jobStatus = 'Accepted' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
    $dbConn->otherQuery($sql);
    $dbConn->write_audit('Job', 0, $_GET['job'], $_SESSION['login_session'], 'New Script selected', 0);
    $success = $translation->get_text('SUCCESS_NEW_SCRIPT');
    if ($actor[0]['is_sms'] == 1) {
        $sms_phone = $dbConn->numbers_only('00'.$actor[0]['phoneCode'].$actor[0]['phone']).'.'.$moh->sms_pin.'@sms160.textapp.net';
        $moh->fixed_email('sms_actor_approved_script.php?sms_person_id='.$actor[0]['id'], 'sms_actor_approved_script.php?sms_person_id='.$actor[0]['id'], $sms_phone, $moh->sms_user, '');
    }
}

//Approve Recording
if (isset($_GET['job']) && isset($_GET['approverecording'])) {
    //if ($jobs[0]['jobStatus'] == 'Recorded' && isset($_SESSION['login_session']) && $_SESSION['login_session'] != 0 && $_SESSION['login_session'] != '') {
    $sql = "UPDATE audio SET is_approved = 0 WHERE jobID = ".$dbConn->quote_smart($_GET['job']); $dbConn->otherQuery($sql);
    $sql = "UPDATE audio SET is_approved = 1 WHERE id = ".$dbConn->quote_smart($_GET['approverecording']); $dbConn->otherQuery($sql);
    $dbConn->write_audit('Job', 0, $_GET['job'], $_SESSION['login_session'], 'New Voice Recording approved', 0);
    $success = $translation->get_text('SUCCESS_VOICE_APPROVED');
    $sql = "UPDATE jobs SET jobStatus = 'With User' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
    $dbConn->otherQuery($sql);

    //Send an email to the actor
    $moh->fixed_email('actor_job_complete.php?jobID='.$_GET['job'], 'actor_job_complete_text.php?jobID='.$_GET['job'],
        $actor[0]['email'], 'actorservices@mohplayer.com', 'Job: '.$_GET['job'].' - Good News! Your Customer has approved your recording!');

	//Notify MOH
	$rows = $moh->get_config();
	if ($rows['recordCount'] > 0) {
		$notifySMS = $rows[0]['SMSJobComplete'];
		if ($notifySMS != '' && is_numeric($notifySMS)) {
			$sms_phone = $dbConn->numbers_only('00'.$notifySMS).'.'.$moh->sms_pin.'@sms160.textapp.net';
			$moh->fixed_email('sms_actor_approved_script_moh.php?jobID='.$_GET['job'], 'sms_actor_approved_script_moh.php?jobID='.$_GET['job'], $sms_phone, $moh->sms_user, '');
		}
	}
    //}
}

//Upload new script
if (isset($_POST['scriptText']) && isset($_GET['job'])) {
    $moh->write_script($_GET['job'], $_SESSION['login_session'], $_POST['scriptText']);
    $moh->fixed_email('customer_new_script.php?jobID='.$_GET['job'], 'customer_new_script_text.php?jobID='.$_GET['job'], $actor[0]['email'], 'actorservices@mohplayer.com', 'Job: '.$_GET['job'].' - '.'New Script Uploaded');
    if ($actor[0]['is_sms'] == 1) {
        $sms_phone = $dbConn->numbers_only('00'.$actor[0]['phoneCode'].$actor[0]['phone']).'.'.$moh->sms_pin.'@sms160.textapp.net';
        $moh->fixed_email('sms_actor_new_script.php', 'sms_actor_new_script.php', $sms_phone, $moh->sms_user, '');
    }
}

//Request new recording
if (isset($_POST['customer_message_id']) && (isset($_GET['recipient']) && $_GET['recipient'] == 'Actor' && isset($_GET['newrecording'])) && isset($_GET['job'])) {
    /*$sql = "DELETE FROM temp"; $dbConn->otherQuery($sql);
     $sql = "INSERT INTO temp (value) VALUES (".$dbConn->quote_smart($_POST['customer_message']).")"; $dbConn->otherQuery($sql);
     $moh->fixed_email('actor_blank.php?jobID='.$_GET['job'], 'actor_blank_text.php?jobID='.$_GET['job'], $customer[0]['email'], 'info@mohplayer.com', 'Job: '.$_GET['job'].' - '.$_POST['customer_message_subject']);
     $dbConn->write_audit('Job', 0, $_GET['job'], 0, 'New recording requested by customer: '.$_POST['customer_message'], 0);
     $sql = "UPDATE jobs SET jobStatus = 'Accepted' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
     $dbConn->otherQuery($sql);
     $success = 'Message Sent to Voice Actor';*/
}

//Send a single email
if (isset($_POST['customer_message_id']) && (isset($_GET['recipient']) && $_GET['recipient'] == 'Actor' && !isset($_GET['newrecording'])) && isset($_GET['job'])) {
    $sql = "DELETE FROM temp"; $dbConn->otherQuery($sql);
	$customer_message = $_POST['customer_message'];
	if (isset($_POST['customer_message_pretext'])) {
		$customer_message = $_POST['customer_message_pretext'].$customer_message;
	}
    $sql = "INSERT INTO temp (value) VALUES (".$dbConn->quote_smart($customer_message).")"; $dbConn->otherQuery($sql);
    $moh->fixed_email('actor_blank.php?jobID='.$_GET['job'], 'actor_blank_text.php?jobID='.$_GET['job'], $actor[0]['email'], 'actorservices@mohplayer.com', 'Job:'.$_GET['job'].' - '.'You have a new message from your Customer', array('dawn@mohplayer.com'));
    if ($actor[0]['is_sms'] == 1) {
        $sms_phone = $dbConn->numbers_only('00'.$actor[0]['phoneCode'].$actor[0]['phone']).'.'.$moh->sms_pin.'@sms160.textapp.net';
        $moh->fixed_email('sms_actor_new_message.php?sms_person_id='.$actor[0]['id'], 'sms_actor_new_message.php?sms_person_id='.$actor[0]['id'], $sms_phone, $moh->sms_user, '');
    }
    $dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Message from Customer To Actor: '.$_POST['customer_message'], 0);
    $success = $translation->get_text('SUCCESS_MSG_ACTOR');
}

if (isset($_POST['customer_message_id']) && (isset($_GET['recipient']) && $_GET['recipient'] == 'MOH' && !isset($_GET['newrecording'])) && isset($_GET['job']) ) {
    $sql = "DELETE FROM temp"; $dbConn->otherQuery($sql);
    $sql = "INSERT INTO temp (value) VALUES (".$dbConn->quote_smart($_POST['customer_message']).")"; $dbConn->otherQuery($sql);
    $moh->fixed_email('moh_blank.php?jobID='.$_GET['job'], 'moh_blank_text.php?jobID='.$_GET['job'], 'actorservices@mohplayer.com',  $selected_job['customerEmail'],'Job: '.$_GET['job'].' - '.$_POST['customer_message_subject'], array('dawn@mohplayer.com'));
    $dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Message from Customer to MOH: '.$_POST['customer_message'], 0);
    $success = $translation->get_text('SUCCESS_MSG_MOH');
}

//Finalise this job
if (isset($_GET['complete']) && isset($_GET['job'])) {
    $sql = "UPDATE jobs SET jobStatus = 'Recording' WHERE id = ".$dbConn->quote_smart($_GET['job'])." AND customerID = ".$_SESSION['login_session'];
    $dbConn->otherQuery($sql);
    $dbConn->write_audit('Job', 0, $_GET['job'], 0, 'Job finalised by '.$_SESSION['fullname'], 0);

    //Email MOHPlayer

}

//Purchase Script Assistance
if (isset($_GET['purchaseScriptAssistance']) && isset($_GET['job'])) {
	$jobs = $moh->get_jobs($_GET['job'], 'jobStatus != \'New\' AND jobStatus != \'Cancelled\' AND customerID = '.$_SESSION['login_session']);
	$total = number_format(($_SESSION['defaultScriptImprovementRate'] + ($jobs[0]['has_vat'] * .2 * $_SESSION['defaultScriptImprovementRate'])), 2);
	$oid = date('ymd-His-'.rand(10000,99999));
	include ("../includes/banking/php_encryption_example.php");
	echo $response;exit;
}
$jobs = $moh->get_jobs('', 'jobStatus != \'New\' AND jobStatus != \'Cancelled\' AND customerID = '.$_SESSION['login_session']);

//Calculate each serial number
$sql = "SELECT DISTINCT s.id, s.serialNumber FROM
jobs j
LEFT JOIN serials s ON j.serialNumber = s.serialNumber
WHERE j.customerID = ".$dbConn->quote_smart($_SESSION['login_session'])."
GROUP BY s.serialNumber";
$serials = $dbConn->SQLToArray($sql);

include('../includes/admin_header.php');

?>
<div id="jquery_jplayer_1" class="cp-jplayer"></div>
<div id="jquery_jplayer_2" class="cp-jplayer"></div>
<div style="clear:both">&nbsp;</div>
<div class="fullWidthContainer">
<div id="halfContentBlock">
<h1 class='TR_TITLE'><?php echo $translation->get_text('TITLE'); ?></h1>
<?php include("../includes/messages_rebrand.php");?>
<table class="mytable" cellspacing="0" summary="">
    <tr>
        <th width="40" scope="col" abbr="" class='TR_TH_JOB'><?php echo $translation->get_text('TH_JOB'); ?></th>
        <th scope="col" abbr="" class='TR_TH_DATE'><?php echo $translation->get_text('TH_DATE'); ?></th>
        <th scope="col" abbr="" class='TR_TH_TASK'><?php echo $translation->get_text('TH_TASK'); ?></th>
    </tr>
    <?php foreach ($jobs as $job) {
    if ($job['id'] != '') {
        $anchor = 'jobs.php?job='.$job['id'];
        $action = '';

        //Decide what this job needs..
        $action = $moh->customer_long_job_status($job['jobStatus']);

        echo '<tr ';
        if (isset($_GET['job']) && $job['id'] == $_GET['job']) { echo ' class="selected" '; }
        echo '>';
        echo '<td>'.$job['id'].'</td>';
        echo '<td><a href="'.$anchor.'">'.$job['lastActivityDate'].'</a></td>';

        echo '<td><a href="'.$anchor.'">'.$action.'</a></td>';

        echo '</tr>';
    }
}?>
</table>

<?php if (isset($_GET['job'])) {

    //Get all the variables required to display the job information
	$_SESSION['buysa'] = 'yes';
	$_SESSION['buysa_job'] = $_GET['job'];
    $jobs = $moh->get_jobs($_GET['job'], 'jobStatus != \'New\' AND jobStatus != \'Cancelled\' AND customerID = '.$_SESSION['login_session']);
    $scripts = $moh->get_written_scripts($_GET['job']);
    $recordings = $moh->get_audio('Recordings', '', '', 'jobID = '.$dbConn->quote_smart($_GET['job']));
    $selectedMusic = $moh->get_audio('Music', $jobs[0]['musicID']);
    $finalMusic = $moh->get_audio('Final', '', '', ' jobID = '.$dbConn->quote_smart($_GET['job']));
    $audit = $moh->get_audit($_GET['job'], 'Job', true);

    if ($selectedMusic['recordCount'] > 0)
        { $musicText = $selectedMusic[0]['trackName']; }
    else { $musicText = $translation->get_text('GLOBAL_NONE_SELECTED'); }

    foreach ( $jobs[0] as $key => $value ) { $$key = $value; }

	if ($scripts['recordCount'] == 0) {
		$firstScript = 'No Script Required';
		$latestScript = 'No Script Required';
	} else {
		$firstScript = $scripts[$scripts['recordCount'] - 1]['id'];
		$latestScript = $scripts[0]['id'];
	}

    ?>
<div id="jobInfo" style="margin-top:10px">
    <h2>Job #<?php echo $_GET['job']; ?></h2>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <th class="TR_TH_STAGE specalt"><?php echo $translation->get_text('TH_STAGE'); ?></th>
            <td><?php echo $moh->customer_long_job_status($jobStatus);?></td>
        </tr>
        <tr>
            <th class="TR_TH_NOTES specalt"><?php echo $translation->get_text('TH_NOTES'); ?></th>
            <td><?php if ($actorNotes == '') {echo $translation->get_text('GLOBAL_NONE_SELECTED');} else {echo $actorNotes;}?></td>
        </tr>
        <tr>
            <th class="TR_TH_MUSIC specalt"><?php echo $translation->get_text('TH_MUSIC'); ?></th>
            <td id="musicText"><?php echo $musicText; ?></td>
        </tr>
        <?php if (isset($finalMusic) && $finalMusic['recordCount'] > 0) {
	    //$no = count($finalMusic) - 2; Reset to the first record
	    $no = 0;
	    if ($no < 0) { $no = 0; } ?>
	        <tr>
	            <th class="TR_TH_DOWNLOAD specalt"><?php echo $translation->get_text('TH_DOWNLOAD'); ?></th>
		        <?php if ($jobs[0]['actorID'] == 0) { ?>
			        <td><a onclick="window.location='download.php?file=<?php echo base64_encode('http://mohplayer.com/music/'.(str_replace(' ','%20',$music[0]['trackFileName']))); ?>'" href="#" class="TR_CLICK_TO_DOWNLOAD"><?php echo $translation->get_text('CLICK_TO_DOWNLOAD'); ?></a></td>
				<?php } else { ?>
			        <td><a onclick="window.location='download.php?markdownload=true&job=<?php echo $_GET['job']; ?>&file=<?php echo base64_encode('http://mohplayer.com/scripts/'.$finalMusic[$no]['trackFileName']); ?>'" href="#" class="TR_CLICK_TO_DOWNLOAD"><?php echo $translation->get_text('CLICK_TO_DOWNLOAD'); ?></a></td>
				<?php } ?>

	        </tr>

	            <?php if ($filetype == 'mp3' ) { ?>
	            <tr>
	                <th class="specalt">
	                    <div class="cp-container">
	                        <div class="cp-circle-control"></div>
	                        <ul class="cp-controls">
	                            <li><a id="1cp-play-1" onclick="$('#jquery_jplayer_1').jPlayer('volume',1); cpplay('<?php echo $baseurl.'/scripts/'.$finalMusic[$no]['trackFileName']; ?>', 1)" href="#" class="cp-play" tabindex="1">play</a></li>
	                            <li><a id="1cp-pause-1" onclick="cppause('<?php echo $baseurl.'/scripts/'.$finalMusic[$no]['trackFileName']; ?>', 1)" href="#" class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
	                        </ul>

	                    </div>
	                </th>
	                <td>
	                    <a href="javascript: void(0);" onclick="cpplay('<?php echo $baseurl.'/scripts/'.$finalMusic[$no]['trackFileName']; ?>', 1)"><?php echo $translation->get_text('CLICK_FINAL'); ?></a>
	                </td>
	            </tr>
	        <?php } else { ?>
	            <tr>
	                <td colspan="2"class="specalt">
	                    <!--- <audio style="margin-left:50px; margin-top:10px;" controls="controls">
										<source src="<?php echo $baseurl.'/scripts/'.$finalMusic[$no]['trackFileName']; ?>" type="audio/wav" />
										Sorry, your browser does not support .wav playback. Please download to listen to it.
									</audio> --->
	                    <p style="text-align: center;" class='TR_FINAL_LISTEN'><?php echo $translation->get_text('FINAL_LISTEN'); ?></p>
	                </td>
	            </tr>

            <?php } ?>
        <?php } ?>

        <?php if ($musicText !=  $translation->get_text('GLOBAL_NONE_SELECTED') && !isset($_GET['music']) && (!isset($finalMusic) || (isset($finalMusic) && $finalMusic['recordCount'] == 0))) { ?>
        <tr>
            <th class="specalt">
                <div class="cp-container">
                    <div class="cp-circle-control"></div>
                    <ul class="cp-controls">
                        <li><a id="1cp-play-1" onclick="cpplay('<?php echo $baseurl.'/music/'.$selectedMusic[0]['trackFileName']; ?>', 1)" href="#" class="cp-play" tabindex="1">play</a></li>
                        <li><a id="1cp-pause-1" onclick="cppause('<?php echo $baseurl.'/music/'.$selectedMusic[0]['trackFileName']; ?>', 1)" href="#" class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
                    </ul>
                </div>
            </th>
            <td>
               <a href="javascript: void(0);" onclick="cpplay('<?php echo 'http://mohplayer.com/music/'.str_replace(' ','%20',$selectedMusic[0]['trackFileName']); ?>', 1)"><span class='TR_CLICK_TO_PLAY'><?php echo  $translation->get_text('CLICK_TO_PLAY'); ?></span> <?php echo $musicText; ?></a>
            </td>
        </tr>

		    <?php if ($jobs[0]['actorID'] == 0) { ?>
			    <tr>
				    <td>Download</td>
				    <td><a onclick="window.location='download.php?file=<?php echo base64_encode('http://mohplayer.com/music/'.$music[0]['trackFileName']); ?>'" href="#" class="blueButton">Click To Download &#39;<?php echo $music[0]['trackName']; ?>&#39;</a></td>
			    </tr>
		    <?php } ?>
        <?php } ?>

        <tr style="display:none;">
            <th class="TR_TH_FILE_FORMAT specalt"><?php echo $translation->get_text('TH_FILE_FORMAT'); ?></th>
            <?php if (isset($finalMusic) && $finalMusic['recordCount'] > 0) { ?>
            <td><?php echo '.'.$filetype; ?></td>
            <?php } else { ?>
            <td>
                <label class="small_label" for="filetype_mp3" style="clear:none;">MP3</label>
                <input onchange="updateFiletype(<?php echo $_GET['job']; ?>,'mp3');" class="small_radio" type="radio"
                    <?php if ($filetype == 'mp3') { echo 'checked';}?>
                       name="filetype" id="filetype_mp3" value="mp3" class="radio" />

                <label class="small_label" for="filetype_wav" style="clear:both; margin-top:10px;">WAV</label>
                <input onchange="updateFiletype(<?php echo $_GET['job']; ?>,'wav');" class="small_radio" style="margin-top:10px;" type="radio"
                    <?php if ($filetype == 'wav') { echo 'checked';}?>
                       name="filetype" id="filetype_wav" value="wav" class="radio" />


            </td>
            <?php }?>
        </tr>
    </table>
</div>

<div id="tools" style="margin-top:20px">
	<?php $cpage = 'jobs.php?job='.$_GET['job']; ?>
	<?php if ($jobs[0]['actorID'] != 0) { ?>
	    <?php if ($latestScript != $firstScript && $jobs[0]['actorID'] != 0) {?>
	    <a class="TR_BUTTON_LATEST_SCRIPT blueButton fixedWidth popup" href="show_script.php?status=Latest&jobID=<?php echo $_GET['job']?>&script=<?php echo $latestScript; ?>"><?php echo $translation->get_text('BUTTON_LATEST_SCRIPT'); ?></a>
	    <?php } ?>
		<?php if ($jobs[0]['actorID'] != 0) { ?>
	        <a class="TR_BUTTON_ORIGINAL_SCRIPT blueButton fixedWidth popup" href="show_script.php?view_only=true&status=Original&jobID=<?php echo $_GET['job']?>&script=<?php echo $firstScript; ?>"><?php echo $translation->get_text('BUTTON_ORIGINAL_SCRIPT'); ?></a>
		<?php } ?>

	    <?php if (isset($_GET['music'])) { ?>
	    <a class="TR_BUTTON_SAVE_MUSIC blueButton fixedWidth" href="jobs.php?job=<?php echo $_GET['job']; ?>&savemusic=true"><?php echo $translation->get_text('BUTTON_SAVE_MUSIC'); ?></a>
	    <a class="TR_BUTTON_CANCEL_MUSIC blueButton fixedWidth" href="jobs.php?job=<?php echo $_GET['job']; ?>&revert=<?php echo $selected_job['musicID']; ?>"><?php echo $translation->get_text('BUTTON_CANCEL_MUSIC'); ?></a>
	    <?php } else {
	    if ($jobStatus != 'Recording') { ?>
	        <a class="blueButton fixedWidth" href="jobs.php?job=<?php echo $_GET['job']?>&music=true">
	            <?php if ($selected_job['musicID'] == 0) { echo $translation->get_text('BUTTON_CHOOSE_MUSIC'); } else { echo $translation->get_text('BUTTON_CHANGE_MUSIC'); } ?>
	        </a>
		    <?php if ($selected_job['musicID'] != 0) { ?>
			    <a class="blueButton fixedWidth" href="jobs.php?job=<?php echo $_GET['job']?>&removemusic=true">
				    Remove Music
			    </a>
		    <?php } ?>

	        <?php } ?>
	    <?php } ?>

	    <?php if ($jobStatus == 'Complete' || $jobStatus == 'Recording') { ?>
	    <a class="TR_BUTTON_FEEDBACK blueButton fixedWidth popup" href="feedback.php?return=<?php echo base64_encode($cpage.'&feedback=true'); ?>&jobID=<?php echo $_GET['job']; ?>"><?php echo $translation->get_text('BUTTON_FEEDBACK'); ?></a></li>
	    <?php } ?>
	    <a class="blueButton fixedWidth popup" href="send_mail.php?return=<?php echo base64_encode($cpage.'&recipient=Actor'); ?>&script_assistance=<?php echo $selected_job['hasScriptAssistance']; ?>&subject=Job:<?php echo $_GET['job']; ?> New message from your Customer&actorID=<?php echo $actorID?>&jobID=<?php echo $_GET['job']; ?>&job=<?php echo $_GET['job'];?>"><span class="TR_BUTTON_MESSAGE"><?php echo $translation->get_text('BUTTON_MESSAGE'); ?></span> <?php echo $jobs[0]['actorFirstName']; ?></a>
	<?php } ?>
	<a class="blueButton fixedWidth popup" target="_blank" href="../includes/view_invoice.php?jobid=<?php echo $_GET['job'];?>&customerid=<?php echo $_SESSION['login_session']; ?>">View Invoice</a>
	 <a class="TR_BUTTON_MESSAGE_MOH blueButton fixedWidth popup" href="send_mail.php?return=<?php echo base64_encode($cpage.'&recipient=MOH'); ?>&subject=New message from Customer: <?php echo $_SESSION['fullname']; ?>&customerID=<?php echo $_SESSION['login_session'];?>&jobID=<?php echo $_GET['job']; ?>&job=<?php echo $_GET['job'];?>"><?php echo $translation->get_text('BUTTON_MESSAGE_MOH'); ?></a>

	<?php if ($hasScriptAssistance == 0 && isset($_GET['buysa'])) { ?>
		<a class="TR_BUTTON_BUY_SA orangeButton doublefixedWidth" href="confirm.php"><?php echo $translation->get_text('BUTTON_BUY_SA').' '.$jobs[0]['actorFirstName'].' '.$translation->get_text('BUTTON_BUY_SA2').' '.$_SESSION['currencyHTML'].number_format(($_SESSION['defaultScriptImprovementRate'] + ($jobs[0]['has_vat'] * .2 * $_SESSION['defaultScriptImprovementRate'] )) * $_SESSION['currencyRate'], 2); ?></a></li>
	<?php } ?>
    <?php // Decide whether to prompt the user that they haven't selected the music
    if ($jobStatus == 'With User') {
        if ($selected_job['musicID'] == '0') { ?>
            <?php if ($jobStatus == 'With User') { ?>
                <a class="TR_BUTTON_COMPLETE blueButton" href="javscript:void(0);"
                   onclick="if(confirm('<?php echo $translation->get_text('CONFIRM_COMPLETE'); ?>')) {window.location='jobs.php?job=<?php echo $_GET['job']?>&complete=true';}">
	                <?php echo $translation->get_text('BUTTON_COMPLETE'); ?>
                </a>
                <?php } ?>

            <?php } else { ?>
            <a class="TR_BUTTON_COMPLETE blueButton" href="#" onclick="if(confirm('<?php echo $translation->get_text('BUTTON_COMPLETE_1'); ?> <?php echo $musicText; ?> <?php echo $translation->get_text('CONFIRM_COMPLETE_2'); ?>')) {window.location='jobs.php?job=<?php echo $_GET['job']?>&complete=true';}">
	            <?php echo $translation->get_text('BUTTON_COMPLETE'); ?>
            </a>
            <?php } ?>
        <?php } ?>
</div>

    <?php } ?>
<div class="tableButtons" style="width:100% !important; display:none;">
    <a href="#" class="TR_TABLE_PREVIOUS tableButton" style="float:left"><?php echo $translation->get_text('TABLE_PREVIOUS'); ?></a>
    <a href="#" class="TR_TABLE_NEXT tableButton" style="float:right"><?php echo $translation->get_text('TABLE_NEXT'); ?></a>
</div>

<?php
if (isset($_GET['job']) && isset($_GET['music'])) { ?>
<h1 class="TR_TITLE_MUSIC"><?php echo $translation->get_text('TITLE_MUSIC'); ?></h1>
<div class="infotable has_hover">
    <form name="musicfilter"
          action="<?php echo $_SERVER['PHP_SELF'].'?music=true'; if (isset($_GET['job'])) { echo '&job='.$_GET['job']; }?>" method="post">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <th class="TR_TH_SEARCH_MUSIC"><?php echo $translation->get_text('TH_SEARCH_MUSIC'); ?></th>
                <td><input type="text" id="custom_music_filter_value" value="<?php echo $_SESSION['custom_music_filter']; ?>" name="custom_music_filter" style="width:142px; text-align:center" /><a href="#" class="TR_BUTTON_SEARCH_MUSIC blueButton right submitStyle" onclick="document.musicfilter.submit();"><?php echo $translation->get_text('BUTTON_SEARCH_MUSIC'); ?></a>
                </td>
            </tr>
        </table>
    </form>
    <table class="music_player mp3_player">
        <tr>
            <th>&nbsp;</th>
            <th class="TR_TH_GENRE"><?php echo $translation->get_text('TH_GENRE'); ?></th>
            <th class="TR_TH_TRACK"><?php echo $translation->get_text('TH_TRACK'); ?></th>
            <th class="TR_TH_DESCRIPTION"><?php echo $translation->get_text('TH_DESCRIPTION'); ?></th>
        </tr>

        <?php foreach ($music as $row) {
        if ($row['trackName'] != '') {
            $filename = "http://mohplayer.com/music/".$row['trackFileName'];
            //$onclick = 'updateMusic('.$_GET['job'].','.$row['id'].',"'.htmlentities($row['trackName']).'"); setMusic("http://mohplayer.com/music/'.$row['trackFileName'].'","'.$row['trackName'].'",'.$row['id'].')';
            $onclick = 'updateMusic('.$_GET['job'].','.$row['id'].',"'.htmlentities($row['trackName']).'");'; ?>
            <tr class="<?php echo 'row'.$row['id']; ?>">
                <td>
                    <div class="cp-container music_samples">

                        <div class="cp-circle-control"></div>
                        <ul class="cp-controls">
                            <li><a id="1cp-play-<?php echo $row['id']; ?>" onclick="updateMusic(<?php echo $_GET['job'];?>,<?php echo $row['id']; ?>,'<?php echo htmlentities($row['trackName']); ?>'); cpplay('<?php echo $filename ?>', <?php echo $row['id']; ?>)" href="javascript: void(0);" class="cp-play" tabindex="1">play</a></li>
                            <li><a id="1cp-pause-<?php echo $row['id']; ?>" onclick="cppause('<?php echo $filename; ?>', <?php echo $row['id']; ?>)" href="javascript: void(0);" class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
                        </ul>
                    </div>
                </td>
                <td><a href="javascript: void(0);" onclick='<?php echo $onclick; ?>'><?php echo $row['genreID'];?></a></td>
                <td><a href="javascript: void(0);" onclick='<?php echo $onclick; ?>'><?php echo $row['trackName']; ?></a></td>
                <td><a href="javascript: void(0);" onclick='<?php echo $onclick; ?>'><?php echo $row['trackArtist']; ?></a></td>
            </tr>
            <?php }
    }?>

    </table>

    <div class="tableButtons">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?music=true<?php if (isset($_GET['job'])) { echo '&job='.$_GET['job']; } ?>&musiclimit=<?php if ($musiclimit - 15 < 0) { echo '0'; } else { echo $musiclimit - 15; } ?><?php if (isset($_GET['artist'])) { echo '?artist='.$_GET['artist']; }?>
                                        " class="TR_TABLE_PREVIOUS tableButton" style="float:left"><?php echo $translation->get_text('TABLE_PREVIOUS'); ?></a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?music=true<?php if (isset($_GET['job'])) { echo '&job='.$_GET['job']; } ?>&musiclimit=<?php if ($musiclimit +15 > 300) { echo '300'; } else { echo $musiclimit + 15; } ?><?php if (isset($_GET['artist'])) { echo '?artist='.$_GET['artist']; }?>
                                        " class="TR_TABLE_NEXT tableButton" style="float:left; margin-left:307px;"><?php echo $translation->get_text('TABLE_NEXT'); ?></a>
    </div>
</div>
    <?php } ?>
<?php if (isset($serials) && $serials['recordCount'] > 0) { ?>
<h1 class="TR_TITLE_SERIALS"><?php echo $translation->get_text('TITLE_SERIALS'); ?></h1>
	<hr/>
<div class="infotable has_hover">
    <table class="tablesorter">
        <tr>
            <th class="TR_TH_SN" scope="col" abbr=""><?php echo $translation->get_text('TH_SN'); ?></th>
            <th class="TR_TH_QTY" scope="col" abbr=""><?php echo $translation->get_text('TH_QTY'); ?></th>
            <th class="TR_TH_EXPIRY" scope="col" abbr=""><?php echo $translation->get_text('TH_EXPIRY'); ?></th>
            <th class="TR_TH_ORDER" scope="col" abbr=""><?php echo $translation->get_text('TH_ORDER'); ?></th>
        </tr>

        <?php foreach ($serials as $no) {
        if ($no['id'] != '') {
            $s = $moh->get_serial_numbers($no['serialNumber']);
            $x = $s[0];
            if ($x['quantity'] < 0) {$x['quantity'] = 0;}
	        if ($x['serialNumber'] == 'ABCD-ABCD-ABCD-ABCD') {  $se = 'Bought After Demonstration';} else {$se = $x['serialNumber']; }
                echo '<tr>';
	            echo '<td>'.$se.'</td>';
	            echo '<td>'.$x['quantity'].'</td>';
	            echo '<td>'.$x['expiryDate'].'</td>';
	            echo '<td>';
	            if ($_SESSION['dIsWhiteLabel'] == 1 || $x['serialNumber'] == 'ABCD-ABCD-ABCD-ABCD') {
	                if ($x['quantity'] < 1 || $x['serialNumber'] == 'ABCD-ABCD-ABCD-ABCD') {
	                    echo '<a class="TR_BUTTON_PURCHASE" href="get_announcement.php?code='.$x['serialNumber'].'">'.$translation->get_text('BUTTON_PURCHASE').'</a>';
	                } else {
	                    echo '<a class="TR_BUTTON_CREATE" href="get_announcement.php?code='.$x['serialNumber'].'">'.$translation->get_text('BUTTON_CREATE').'</a>';
	                }
	            }
	            echo '&nbsp;</td>';
	            echo '</tr>';

        }
    } ?>
    </table>
</div>
    <?php if ($_SESSION['dIsWhiteLabel'] == 1 && isset($_SESSION['dealerID'])) {
        ?>
    <h3 class="TR_TITLE_ORDERING"><?php echo $translation->get_text('TITLE_ORDERING'); ?></h3>

    <p><span class="TR_ORDER_TEXT_1"><?php echo $translation->get_text('ORDER_TEXT_1'); ?></span>
	    <span class="TR_ORDER_TEXT_2"><?php echo $translation->get_text('ORDER_TEXT_2'); ?></span>
	    £<?php echo number_format($moh->get_announcement_price($_SESSION['dealerID']), 2); ?>
	    <span class="TR_ORDER_TEXT_3"><?php echo $translation->get_text('ORDER_TEXT_3'); ?></span></p>
        <?php }
}?>
	<h3 class="TR_TITLE_SERIAL"><?php echo $translation->get_text('TITLE_SERIAL'); ?></h3>
	<p class="TR_TEXT_SERIAL"><?php echo $translation->get_text('TEXT_SERIAL'); ?></p>
	<form name="new_serial_number" id="form" method="POST" action="/mohplayer/get_announcement.php">
		<input type="text" id="serial_number_code" name="code" maxlength="19" value="" style="width:240px; padding:13px; text-align:center; float:left;" />
		<a href="#" onclick="document.new_serial_number.submit();" class="blueButton"><?php echo $translation->get_text('BUTTON_SERIAL'); ?></a>
	</form>
	<h2>Certificate of Royalties Paid</h2>
	<hr/>
        <p>You may view and download our Certficate of Royalties Paid by following <a class="blueButton" href="/template/MOH_Player_Royalties_Paid_Certificate.pdf">Download our Royalty Paid Certificate</a></p>

</div>
<?php if (isset($_GET['job']) && (!isset($finalMusic) || (isset($finalMusic) && $finalMusic['recordCount'] == 0)))  {



    ?>
<input type="hidden" name="id" value="<?php echo $_GET['job']; ?>" />
<input type="hidden" name="originalMusicId" value="<?php echo $jobs[0]['musicID']; ?>" />


<div id="hiddenPlayer" style="display:none">
    <div id="cp_container_1" class="cp-container">
        <div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
            <div class="cp-buffer-1"></div>
            <div class="cp-buffer-2"></div>
        </div>
        <div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->

            <div class="cp-progress-1"></div>
            <div class="cp-progress-2"></div>
        </div>
        <div class="cp-circle-control"></div>
        <ul class="cp-controls">
            <li><a href="#" class="cp-play" tabindex="1">play</a></li>
            <li><a href="#" class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
        </ul>
    </div>
</div>

<div id="hiddenPlayer2" style="display:none">
    <div id="cp_container_2" class="cp-container">
        <div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
            <div class="cp-buffer-1"></div>
            <div class="cp-buffer-2"></div>
        </div>
        <div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->

            <div class="cp-progress-1"></div>
            <div class="cp-progress-2"></div>
        </div>
        <div class="cp-circle-control"></div>
        <ul class="cp-controls">
            <li><a href="#" class="cp-play" tabindex="1">play</a></li>
            <li><a href="#" class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
        </ul>
    </div>
</div>

<div id="halfContentBlock" class="rightHalf light">
    <h1 class="TR_TITLE_SCRIPTS"><?php echo $translation->get_text('TITLE_SCRIPTS'); ?></h1>

    <?php if (isset($recordings) && $recordings['recordCount'] > 0) { ?>
    <h2 class="TR_SUBTITLE_VOICE"><?php echo $translation->get_text('SUBTITLE_VOICE'); ?></h2>
    <p class="TR_VOICE_WARNING"><?php echo $translation->get_text('VOICE_WARNING'); ?></p>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <th>&nbsp;</th>
            <th class="TR_TH_APPROVE"><?php echo $translation->get_text('TH_APPROVE'); ?></th>
            <th class="TR_TH_DATE"><?php echo $translation->get_text('TH_DATE'); ?></th>
            <th class="TR_TH_TRACKNAME"><?php echo $translation->get_text('TH_TRACKNAME'); ?></th>
            <th class="TR_TH_COMMENTS"><?php echo $translation->get_text('TH_COMMENTS'); ?></th>
        </tr>
        <?php foreach($recordings as $recording) {
        if ($recording['id'] != '') {
            $filename = "http://mohplayer.com/scripts/".$recording['trackFileName'];
            $live = '';
            if ($recording['is_approved'] == 1) {
                $live = 'LIVE';
            } else {
                // $live = '<a href="jobs.php?job='.$_GET['job'].'&approverecording='.$recording['id'].'">Approve</a>';
                if ($jobStatus != 'Downloaded' && $jobStatus != 'Complete' && $jobStatus != 'Recording') {
                    $live = '<a class="popup" href="jobs_finalise.php?job='.$_GET['job'].'&approverecording='.$recording['id'].'">Approve</a>';
                } else {
                    $live = 'Unapproved';
                }
            }

            //$onclick = 'setMusic2("'.$baseurl.'/scripts/'.$recording['trackFileName'].'",'.$recording['id'].')';
            $onclick = '';
            echo '<tr ';
            if ($recording['rowNumber'] == 0) {
                echo ' class="highlight_script" ';
            }
            echo 'onmouseover="this.style.cursor=\'pointer\'" onclick=\''.$onclick.'\'>';
            ?>
            <!--- Insert individual player here--->
            <td>
                <div class="cp-container voice_samples">

                    <div class="cp-circle-control"></div>
                    <ul class="cp-controls">
                        <li><a id="cp-play-<?php echo $recording['id']; ?>" onclick="cpplay2('<?php echo $filename; ?>', <?php echo $recording['id']; ?>)" href="javascript: void(0);" class="cp-play" tabindex="1">play</a></li>
                        <li><a id="cp-pause-<?php echo $recording['id']; ?>" onclick="cppause2('<?php echo $filename; ?>', <?php echo $recording['id']; ?>)" href="javascript: void(0);" class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
                    </ul>
                </div>
            </td>
            <?php
            echo '<td>'.$live.'</td>';
            echo '<td>';
            echo $recording['dateOnly'];
            echo '<input type="hidden" id="recording_'.$recording['id'].'" value="'.$baseurl.'/scripts/'.$recording['trackFileName'].'"/>';
            echo '</td>';
            if ($recording['trackName'] != '') {
                echo '<td>'.$recording['trackName'].'</td>';
            } else {
                echo '<td class="TR_TRACK_UNTITLED">'.$translation->get_text('TRACK_UNTITLED').'</td>';
            }
            if (trim($recording['comments']) != '') {
                echo '<td>'.$recording['comments'].'</td>';
            } else {
                echo '<td class="TR_GLOBAL_NONE TR_GLOBAL">'.$translation->get_text('GLOBAL_NONE').'</td>';
            }
            echo '</tr>';
        }
    }?>
    </table>
    <?php } ?>
    <h2 class="TR_TITLE_HISTORY"><?php $translation->get_text('TITLE_HISTORY'); ?></h2>
    <table width="100%" border="0" cellspacing="0" cellpadding="5">
        <tr>
            <th></th>
            <th class="TR_TH_APPROVED"><?php $translation->get_text('TH_APPROVED'); ?></th>
            <th class="TR_TH_REVISION"><?php $translation->get_text('TH_REVISION'); ?></th>
            <th class="TR_TH_ADDEDBY"><?php $translation->get_text('TH_ADDEDBY'); ?></th>
            <th class="TR_TH_DATE"><?php $translation->get_text('TH_DATE'); ?></th>
        </tr>
        <?php foreach($scripts as $script) {
        if ($script['id'] != '') {
            if ($script['firstName'] == $_SESSION['firstname'] && $script['lastName'] == $_SESSION['lastname']) {
                $by = $translation->get_text('ADDEDBY_YOU');
            } else {
                $by = $script['firstName'];
            }
            if ($script['is_approved'] == 1) {
                $live = $translation->get_text('HISTORY_LIVE');
            } else {
                $live = '';
            }
            $status = 'Modified';
            if ($script['rowNumber'] == 0)     {
	            $status = 'Latest';
            }

            $approvedtext = '';
            if ($script['is_approved'] == 1) {
                $approvedtext = $translation->get_text('STATUS_APPROVED');
            }
            if ($hasScriptAssistance == 1 && ($jobStatus == 'Approved' || $jobStatus == 'Script')) {
                $approvedtext = $translation->get_text('STATUS_WITH_ACTOR');
            }
            if ($hasScriptAssistance == 1 && $jobStatus == 'Revision') {
                $approvedtext = '';
            }
            if ($hasScriptAssistance == 1 && $jobStatus == 'Revision' && $status == 'Latest') {
                $approvedtext = $translation->get_text('STATUS_VIEW_SCRIPT');
            }
            if ($script['rowNumber'] == $scripts['recordCount'] - 1) { $status = 'Original'; }
            $anchor = 'show_script.php?status='.$status.'&jobID='.$id.'&script='.$script['id'];
            if ($status != 'Original' || $scripts['recordCount'] > 1) { $anchor .= '&view_only=true'; }
            echo '<tr>';
            if ($approvedtext == $translation->get_text('STATUS_APPROVED') || $approvedtext == $translation->get_text('STATUS_VIEW_SCRIPT'))
            { $highlight = 'highlight_script" '; }
            elseif ($approvedtext == $translation->get_text('STATUS_WITH_ACTOR') || $approvedtext == '') {
                $highlight = '';
            }
            else { $highlight = 'no_highlight_script'; }
            echo '<td><a class="popup '.$highlight.'" href="'.$anchor.'">'.$script['revision'].'</a></td>';
            echo '<td><a class="popup '.$highlight.'" href="'.$anchor.'">'.$approvedtext.'</a></td>';
            echo '<td><a class="popup '.$highlight.'" href="'.$anchor.'">'.$status.'</a></td>';
            echo '<td><a class="popup '.$highlight.'" href="'.$anchor.'">by '.$by.'</a></td>';
            echo '<td><a class="popup '.$highlight.'" href="'.$anchor.'">'.$script['dateAdded'].'</a></td>';
            echo '</tr>';
        }
    }?>
    </table>

    <h2 class="TR_TITLE_JOBHISTORY"><?php echo $translation->get_text('TITLE_JOBHISTORY'); ?></h2>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="margin-bottom:20px">
        <?php foreach($audit as $row) {
        if ($row['id'] != ''
	        && substr($row['auditText'], 0, strlen('You have received a new message from')) != 'You have received a new message from'
	        && substr($row['auditText'],0,strlen('Message from Actor to MOH')) != 'Message from Actor to MOH'
	        && substr($row['auditText'],0,strlen('Message from HO')) != 'Message from HO') { ?>
            <tr>
                <th class="specalt" width="130"><?php echo $row['dateAdded'];?></th>
                <td><?php echo $row['auditText'];?></td>
            </tr>
            <?php }
    }?>
    </table>
</div>
    <?php } ?>
</div>
<?php
include('../includes/new_footer.php');
?>