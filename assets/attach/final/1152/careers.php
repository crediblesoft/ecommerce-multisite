<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include_once("admin/include/config.php");
include_once("admin/classes/db_functionsClass.php");
include("admin/classes/genFuncClass.php");
include_once("admin/classes/connectionClass.php");
$title_ch="Career";
$geneFunc=new genFuncClass;
$db = new db_functionsClass;
$db2 = new db_functionsClass;
$title ="Job Openings at Ucodice ,Job Opening Delhi, Php Developer Job Opening, Php Team Lead Job Opening";
$keywords = "Job Openings,Job Opening Delhi, Php Developer Job Opening, Php Team Lead Job Opening, Php Developer Job Delhi, Designer Job Opening, Web Designer Job Opening, Sales Job Opening";
$description = "Job Openings,Job Opening Delhi, Php Developer Job Opening, Php Team Lead Job Opening, Php Developer Job Delhi, Designer Job Opening, Web Designer Job Opening, Sales Job Opening";
include('include/header.php');

$msg="";
$color="red";
$resumepath = SITE_URL . "uploaded_resumes/";
$to = 'career@ucodice.com';
//$to = 'ravi@ucodice.com';

if(isset($_SERVER['REQUEST_METHOD']) &&  $_SERVER['REQUEST_METHOD']=="POST" )
    {
    $upload='';
    /***********validation for file upload for both forms***************/
        if(isset($_FILES['upload']['name']))
        {
          if($_FILES['upload']['name']!=NULL && $_FILES['upload']['name']!="") /*for file upload*/
            {
                $fileName=$_FILES['upload']['name'];
                /*$pathinfo=pathinfo($fileName);
                $fname1=$pathinfo['filename'].rand(0,99999).".".$pathinfo['extension'];
                $fname=str_replace(" ","",$fname1);*/
                $geneFunc->filetypecheck2($_FILES['upload']['type']);

                if($geneFunc->result!="Invalid")
                { 
		   $geneFunc->renamefile($fileName);
                   $file=str_replace(" ","_",$geneFunc->file);
                    move_uploaded_file($_FILES['upload']['tmp_name'],"uploaded_resumes/".$file);
                   $upload=db_functionsClass::dbin($file);
                }
                else
                {
                    $msg="Please upload only doc, docx, pdf and odt type files."."<br/>";

                }
            }
       }
      else
       {
           $msg="No Resume uploaded";
       }
    /***********End:validation for file upload for both forms***************/

        if(isset($_REQUEST['submit'])||(isset($_REQUEST['apply']))) {
            if($_POST['fname']==''){
                $msg="Please fill your name";
            }
            if($_POST['email']==''){
                $msg="Please enter your email id";
            }
            if($_POST['contact']==''){
                $msg="Please enter your Contact Number";
            }
            if ($msg == '') {

                $fname = db_functionsClass::dbin($_POST['fname']);
                $email = db_functionsClass::dbin($_POST['email']);
                if ($_POST['gender'] == "male") {
                    $gender = "1";
                } else {
                    $gender = "2";
                }
                $edu = $_POST['edu'];
                $contact = $_POST['contact'];
                $address = db_functionsClass::dbin($_POST['address']);
                $post = $_POST['post'];
                $skill = $_POST['skill'];
                $experience = $_POST['experience'];
                $employment = $_POST['employment'];
                $CTC = $_POST['CTC'];
                $E_CTC = $_POST['E_CTC'];
                date_default_timezone_set('Asia/Calcutta');
                $uploaddate = date('Y-m-d');
                //echo "hi".$uploaddate; exit;
                $dbh2 = @mysql_connect("localhost", "ucodice_hr_cms", "+8}#(-#[-;bE") or die('Unable to connect to database');
                //$dbh2 = @mysql_connect("localhost", "root", "") or die('Unable to connect to database');
                mysql_select_db("ucodice_hr_cms") or die('Unable to select to database');
                //$con=mysql_connect("localhost","hr_cms","4SdK6@SY-rmx6W&2") or die("connection error");
                // $con=mysql_connect("localhost","root","") or die("connection error");
                // mysql_select_db("hr_cms") or die("not working select db");

                $fields = "name = '" . $fname . "', email = '" . $email . "', upload_date = '" . $uploaddate . "',contact = '" . $contact . "',address = '" . $address . "',gender = '" . $gender . "',tech_skills = '" . $skill . "',current_employment='" . $employment . "',csallary = '" . $CTC . "', fsallary = '" . $E_CTC . "',post_applied = '" . $post . "',status='0',data_from='ucodice'";
                $table = "candidate";
                $doctable="upload_docm";
                
                if (isset($_REQUEST['submit'])) {
                    $condition = "where email='$email'";
                    $query = "select * from $table $condition";
                    $result_t = mysql_query($query);
                    $row = mysql_num_rows($result_t);
                    /* if($row==0)
                     {*/
                    $qry = $db->insertUpdateQuery($table, "", $fields);
                    $nwid=$db->insertId;
                    $docfields="cid = '" . $nwid . "', upload_doc = '" . $upload ."'";
                    $qry2 = $db->insertUpdateQuery($doctable, "", $docfields);
                    if ($db->redirect_msg = "added=yes") {
                        $subject = 'Application for future vacancy';
                        $body = '<div style="background-color: #E5E5E5;float: left;padding: 30px;width: 90%;">
                                 <div style="background-color: #FFFFFF;border: 1px solid #D5D5D5;float: left;padding: 10px;width: 97%;font-family:Cambria, \'Hoefler Text\', \'Liberation Serif\', Times, \'Times New Roman\', serif;">
                                     <div style="float:left;width:100%;fon-weight:bold;font-size:20px;">Candidate Details</div>
                                        <div style="float:left;width:100%;">
                                         <p>Hello Sir/Madam</p>
                                          <table cellspacing="0" cellpadding="0" width="100%">
                                              <col width="64" span="3">
                                              <tr height="20">
                                                <td id="td_data">Name:-</td>
                                                <td ></td>
                                                <td id="td_field">' . $fname . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Gender:-</td>
                                                <td></td>
                                                <td>' . $_POST['gender'] . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data">Email:-</td>
                                                <td></td>
                                                <td>' . $email . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Education:-</td>
                                                <td></td>
                                                <td>' . $edu . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Contact no.:-</td>
                                                <td></td>
                                                <td>' . $contact . '</td>
                                              </tr>
                                             

                                               <tr >
                                                <td id="td_data"> Post Applied:-</td>
                                                <td></td>
                                                <td>' . $post . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Technical Skills:-</td>
                                                <td></td>
                                                <td>' . $skill . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data">Relevant experience:-</td>
                                              <td></td>
                                              <td id="td_field">' . $experience . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data">Current Employment:-</td>
                                              <td></td>
                                              <td id="td_field">' . $employment . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data"> Current CTC:-</td>
                                              <td></td>
                                              <td id="td_field">' . $CTC . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data"> Expected CTC:-</td>
                                              <td></td>
                                              <td id="td_field">' . $E_CTC . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data">Resume:-</td>
                                              <td></td>
                                              <td id="td_field"><a href=' . $resumepath . $upload . '>' . $upload . '</a></td>
                                              </tr>

                                            </table>
                                                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        $message = 'If we can read this, it means that our fake Sendmail setup works!';
                        $headers = 'From: myemail@egmail.com' . "\r\n" .
                            'Reply-To: myemail@gmail.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                        $geneFunc->Mail($to, $subject, $body);
                        echo '<script type="text/javascript">
                        alert("Thank you to fill the form, Ucodice will contact you soon!!!");
                        window.location="careers";
                        </script>';
                    }
                }

                if (isset($_REQUEST['apply'])) {
                    $condition1 = "where email='$email' and post_applied='$post'";
                    $query = "select * from $table $condition1 ";
                    $result_t = mysql_query($query);
                    $row = mysql_num_rows($result_t);

                    if ($row == 0) {
                        $qry = $db->insertUpdateQuery($table, "", $fields);
                        $nwid=$db->insertId;
                    $docfields="cid = '" . $nwid . "', upload_doc = '" . $upload ."'";
                    $qry2 = $db->insertUpdateQuery($doctable, "", $docfields);
                        if ($db->redirect_msg = "added=yes") {
//echo $upload;die;
//                            $subject = 'Application for (' . $post . ') from Ucodice.com';
                            $subject = 'Application for (' . $post . '),('.$fname.')';
                            $body = '<div style="background-color: #E5E5E5;float: left;padding: 30px;width: 90%;">
                                 <div style="background-color: #FFFFFF;border: 1px solid #D5D5D5;float: left;padding: 10px;width: 97%;font-family:Cambria, \'Hoefler Text\', \'Liberation Serif\', Times, \'Times New Roman\', serif;">
                                     <div style="float:left;width:100%;fon-weight:bold;font-size:20px;">Candidate Details</div>
                                        <div style="float:left;width:100%;">
                                         <p>Hello Sir/Madam</p>
                                          <table cellspacing="0" cellpadding="0" width="100%">
                                              <col width="64" span="3">
                                              <tr height="20">
                                                <td id="td_data">Name:-</td>
                                                <td ></td>
                                                <td id="td_field">' . $fname . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Gender:-</td>
                                                <td></td>
                                                <td>' . $_POST['gender'] . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data">Email:-</td>
                                                <td></td>
                                                <td>' . $email . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Education:-</td>
                                                <td></td>
                                                <td>' . $edu . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Contact no.:-</td>
                                                <td></td>
                                                <td>' . $contact . '</td>
                                              </tr>


                                               <tr >
                                                <td id="td_data"> Post Applied:-</td>
                                                <td></td>
                                                <td>' . $post . '</td>
                                              </tr>

                                              <tr >
                                                <td id="td_data"> Technical Skills:-</td>
                                                <td></td>
                                                <td>' . $skill . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data">Relevant experience:-</td>
                                              <td></td>
                                              <td id="td_field">' . $experience . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data">Current Employment:-</td>
                                              <td></td>
                                              <td id="td_field">' . $employment . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data"> Current CTC:-</td>
                                              <td></td>
                                              <td id="td_field">' . $CTC . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data"> Expected CTC:-</td>
                                              <td></td>
                                              <td id="td_field">' . $E_CTC . '</td>
                                              </tr>

                                              <tr>
                                              <td id="td_data">Resume:-</td>
                                              <td></td>
                                              <td id="td_field"><a href=' . $resumepath . $upload . '>' . $upload . '</a></td>
                                              </tr>

                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            $message = 'If we can read this, it means that our fake Sendmail setup works!';
                            $headers = 'From: myemail@egmail.com' . "\r\n" .
                                'Reply-To: myemail@gmail.com' . "\r\n" .
                                'X-Mailer: PHP/' . phpversion();
                            $geneFunc->Mail($to, $subject, $body);
                            echo '<script type="text/javascript">
                            alert("Thank you to fill the form, Ucodice will contact you soon!!!");
                            window.location="careers";
                            </script>';
                        }
                    } else {
                        echo '<script type="text/javascript">alert("You are already applied for this post.");</script>';
                    }
                }
            }
        }

    mysql_close($dbh2);
    $con=mysql_connect("localhost","ucodice_ucodice","&tEZKk}{In+?") or die("connection error");
     //$con=mysql_connect("localhost","root","") or die("connection error");
       // mysql_select_db("ucodice_ucodice") or die("not working ucodice db");
//       $con=mysql_connect("localhost","root","") or die("connection error");
        mysql_select_db("ucodice_ucodice") or die("not working select db");
}
?>
<div id="page_wrapper">
	<div id="slideshow" class="uh_zn_def_header_style portfolio_devices zn_slideshow">
        <div class="bgback"></div>
        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:#E9E9E9;padding:0px;margin-top:0px;margin-bottom:0px;max-height:700px;">

        </div>

        <div class="zn_header_bottom_style"></div>
    </div>

</div>
<div class="row carrerbanner"><img src="<?=SITE_URL?>images/career_2-new-d.png"  width="100%" /></div>

<div class="container carrermaindiv">
    <div class="container col-lg-12 col-sm-12 col-md-12 col-xs-12 margin_bott">
<!--        <div class="col-lg-4">
            <div class="serviceDiv">
                <h3>Career with us!!</h3>
                <ul>
                    <li id="join_us" class="mytb" ><a  class="activeColor" href="javascript:void(0)"> <img class="liststyle" alt="image" src="/image/1.png"/>  Join Us</a></li>
                    <li id="team_l"><a  href="javascript:void(0)"><img class="liststyle" alt="image" src="/image/1.png"/>  Team</a></li>
                    <li id="activity_l"><a  href="javascript:void(0)"><img class="liststyle" alt="image" src="/image/1.png"/>  Activities</a></li>

                </ul>
            </div>
        </div>-->
        <div class="col-lg-12">
            <div class="row-fluid">
                <div class="col-lg-12 text-center">
                    <div class="service_title"><h3 class="service_h3">Join Ucodice</h3></div>
                </div>
            </div>
            <div class="row">
                <div class="firstDiv">
                    <div class="j_us">
                        <p class="text-center fstyle">
                       We are looking for experienced IT professional to expand our team. We would like you to invite and join a positive team, Professional atmosphere of the company. </p>

                        <p class="text-center fstyle">
                           Ucodice is well known for its fun loving working atmosphere. We provide platform & opportunities to all our employees to grow in their career successfully. At ucodice we provide internal training to groom & develop you as a professional. We treat human as a human so they can easily balance their personal & professional life. There is no late seating for employees at Ucodice, On-time salary, frequent appraisals & frequent movie/outing plans & fun loving environment. </p>

                        <p class="text-center fstyle">
                             You can also see updates about company events at:
                             <a href="http://www.facebook.com/ucodice" target="_blank">www.facebook.com/ucodice</a>
                        </p>

                        <p class="msgjbopn text-center">
                                All job openings are at
                                <span class="inr_msg">Rohini (Delhi)</span>
                                office. We are open for salary if you can prove that you deserve for whatever you want.
                        </p>

                    </div>
        <div class="table table-responsive radius_new">
                <table class="table table-bordered table-responsive">
                            <thead class="bkcolor">
                              <tr>
                                <th class="text-center">Job Title</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Vacancies</th>
                                <th class="text-center">Req.Exp.</th>
                                <th class="text-center" style="width:10%;">Apply</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                            $query_j="select * from tbl_jobs where status='1'";
                            $i=1;
                            $result_j=mysql_query($query_j);
                            while($value_j=mysql_fetch_array($result_j))
                            {
                               $i++;  
                               if($i%2==0) {
                                   $tr = '#fbfbfa';
                                 
                               }
                               else{
                                   $tr = '#fff'; 
                               }
                               
                                          
                                ?>
                              <tr class="data_color" style="background-color:<?php echo $tr ;?>">
                                <td class="field new_padding job-title"><?php echo substr(db_functionsClass::dbout($value_j['position']),0,25);?></td>
                                <td class="field new_fields new_padding"><?php echo substr(db_functionsClass::dbout($value_j['job_description']),0,70)."...";?></td>
                                <td class="text-center field new_padding"><?php echo substr(db_functionsClass::dbout($value_j['no_of_post']),0,4)?></td>
                                <td class="text-center field new_padding"><?php
                                        if(isset($value_j['job_experience']) && trim($value_j['job_experience'])!="")
                                        {
                                            echo substr(db_functionsClass::dbout($value_j['job_experience']),0,4);
                                        }
                                        else
                                        {
                                            echo "NA";
                                        }?></td>
                                <td class="text-center new_padding"> <a id="apply" href="javascript:void(0);"   class="apply" title="Apply here for this job" data-target="#myModal_1" data-toggle="modal">Apply</a></td>
                              </tr>
                              <tr class="desc_box">
                                 
                                  <td colspan="5">
                                     <div > 
                                     <div class="ims-corner"> </div>
                                    <div class="dobdesc">
                                       <div class="job_desk_field">Job Title:</div>
                                       <div class="job_field_desc"><?php echo db_functionsClass::dbout($value_j['job_title']);?></div>
                                    </div>

                                    <div class="dobdesc">
                                        <div class="job_desk_field">Job Description:</div>
                                        <div class="job_field_desc"><?php echo db_functionsClass::dbout($value_j['job_description']);?></div>
                                    </div> 
                                    </div>
                                  </td>
                                  
                                  
                              </tr>
                              
                               <?php
                            }
                            ?>
                             
                            </tbody>
                            
                            <thead class="bkcolor">
                                
                              <tr class="bor_radius">
                                  
                                  <td class="text-center" colspan="5"><a class="linkclr" href="javascript:void(0);" onclick="popup();"  title="Apply here for future vacancy" data-target="#myModal" data-toggle="modal">Apply here for future vacancy</a></td>  
                                 
                              </tr>
                              
                            </thead>
                             

                          </table>
</div>    
                </div>
            </div>

             <div class="albm_vw" style="width: 500;"></div>
        </div>
    </div>
</div>


   

<script type="text/javascript">
        $(document).ready(function(){
           $(".field").click(function(){
                if($(this).parent().next().css("display")=="none") {
                     $(".desc_box").not(this).hide();
                 }
                $(this).parent().next().slideToggle();
           });


            $(".apply").click(function(){


                $(".desc_box").hide();
                document.getElementById('myModal_1').style.display = 'block';
                document.getElementById('myModal_1').style.display = 'block';


                if($(this).attr("id")=="apply") {
                    var job_title= $(this).parent().parent().children().html();


                   $('#post').empty().append('<option selected="selected" value="'+job_title+'">'+job_title+'</option>');
                }

            });

            /**********Show multiple galleries images by lightbox********/
            $(function(){
                $('.galleryDiv').each(function(){
                    $('.imagebox a', this).lightBox();
                });
            });
            /**********End:Show multiple galleries images by lightbox********/


        });
    </script>
    <div id="TB_overlay1" class="TB_overlayBG1" style="display:none" onclick="javascript: popupClose1()"></div>
  <div class="modal fade" id="myModal_1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header career-modal-header">
        <button type="button" class="close career-modal-close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="reg_f">
            <div class="job_header">
                <img src="<?=SITE_URL?>/images/job_title_img.png" class="briefcase"/>
            </div>
            <div class="job_header_content">
                <div class="jobapp">Job Application</div>
                <div class="job_ttl_content">Please complete the form below to apply for a position with us</div>
            </div>
        </div>
      </div>
      <div class="modal-body career-modal-body">
        <div class="massage_3 jobform">
            <form class="" action="" name="contact_us1" id="item" method="post"  enctype="multipart/form-data" onsubmit="return validate1()">
                <div class="details" style="padding: 5px;">
                     <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Name</label><span id="red">*</span>
                                <input class="form-control" type="text" name="fname" placeholder="First name" id="fname" tabindex="1" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Email</label><span id="red">*</span>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email" tabindex="2" />   </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Contact No</label><span id="red">*</span>
                           <input class="form-control" type="text" name="contact" id="contact" placeholder="Contact Number" tabindex="3" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Gender</label><span id="red">*</span>
                           <select class="form-control modify-select" name="gender" id="gender" tabindex="4" >
                                <option value="">--Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option></select>
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Highest Education</label>
                          <input class="form-control" type="text" name="edu" id="edu" placeholder="Highest Education" tabindex="5" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Post Applied</label><span id="red">*</span>
                           <select name="post" id="post" class="form-control modify-select" required="required" tabindex="6" >
                                <option value="">-Select-</option>
                                <?php
                                $query_p="select position from tbl_jobs";
                                $result_p=mysql_query($query_p);
                                while($value_p=mysql_fetch_array($result_p))
                                {
                                    $title_p=$value_p['position'];

                                    ?>


                                    <option value="<?php echo $title_p ?>"><?php echo $title_p ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Technical Skills</label>
                        <input class="form-control" type="text" name="skill" id="skill" placeholder="Enter all your technical skills" tabindex="7" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Relevant experience</label><span id="red">*</span>
                          <input class="form-control" type="text" name="experience" id="experience" placeholder="Enter your working experience" tabindex="8" />
                        </div>
                    </div>
                     <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Current CTC</label><span id="red">*</span>
                          <input class="form-control" type="text" name="CTC" id="CTC" placeholder="Enter your current CTC" tabindex="9"  />
                        </div>
                    </div>
                     <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Expected CTC</label><span id="red">*</span>
                           <input class="form-control" type="text" name="E_CTC" id="E_CTC" placeholder="Enter your Expected CTC" tabindex="10" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Current Employment</label>
                          <input id="employment" class="form-control" type="text" placeholder="Enter your current job details" name="employment" tabindex="11" >
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Upload Resume</label><span id="red">*</span>
                          <input class="inpt_fld file" type="file" name="upload"  id="upload" value="" />
                        </div>
                    </div>
                
            <div class="save col-lg-12">
                <input class="applyBtn" align="middle" type="submit" value="Submit" name="apply" onsubmit="javascript: popupClose1()"  />
            </div>
        </div>


      <div class="elements">
      </div>

    </form>
        </div>
      </div>
      <div class="modal-footer career-modal-footer">
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>
 
<div id="TB_overlay" class="TB_overlayBG" style="display:none" onclick="javascript: popupClose()"></div>


<!-- Apply here for future vacancy Model-->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header career-modal-header">
        <button type="button" class="close career-modal-close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="reg_f">
            <div class="job_header">
                <img src="<?=SITE_URL?>/images/job_title_img.png" class="briefcase"/>
            </div>
            <div class="job_header_content">
                <div class="jobapp">Job Application</div>
                <div class="job_ttl_content">Please complete the form below to apply for a position with us</div>
            </div>
        </div>
      </div>
      <div class="modal-body career-modal-body">
        <div class="massage_3 jobform">
            <form action="" name="contact_us" id="item" method="post"  enctype="multipart/form-data" onsubmit="return validate()" >
                <div class="details" style="padding: 5px;">
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Name</label><span id="red">*</span>
                                <input class="form-control" type="text" name="fname" placeholder="First name" id="fname" tabindex="1" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Email</label><span id="red">*</span>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email" tabindex="2" />   </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label>Contact No</label><span id="red">*</span>
                           <input class="form-control" type="text" name="contact" id="contact" placeholder="Contact Number" tabindex="3" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Gender</label><span id="red">*</span>
                           <select class="form-control modify-select" name="gender" id="gender" tabindex="4" >
                                <option value="">--Select Gender--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option></select>
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Highest Education</label>
                          <input class="form-control" type="text" name="edu" id="edu" placeholder="Highest Education" tabindex="5" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Post Applied</label><span id="red">*</span>
                           <select name="post" id="post" class="form-control modify-select" required="required" tabindex="6" >
                                <option value="">-Select-</option>
                                    <?php
                                    $query_p="select position from tbl_jobs";
                                    $result_p=mysql_query($query_p);
                                    while($value_p=mysql_fetch_array($result_p))
                                    {
                                        $title_p=$value_p['position'];

                                        ?>


                                        <option value="<?php echo $title_p ?>"><?php echo $title_p ?></option>
                                    <?php
                                    }
                                    ?>
                                    <option value="Others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Technical Skills</label>
                        <input class="form-control" type="text" name="skill" id="skill" placeholder="Enter all your technical skills" tabindex="7" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Relevant experience</label><span id="red">*</span>
                          <input class="form-control" type="text" name="experience" id="experience" placeholder="Enter your working experience" tabindex="8" />
                        </div>
                    </div>
                     <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Current CTC</label><span id="red">*</span>
                          <input class="form-control" type="text" name="CTC" id="CTC" placeholder="Enter your current CTC" tabindex="9"  />
                        </div>
                    </div>
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label class="new_lable">Expected CTC</label><span id="red">*</span>
                           <input class="form-control" type="text" name="E_CTC" id="E_CTC" placeholder="Enter your Expected CTC" tabindex="10" />
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Current Employment</label>
                          <input id="employment" class="form-control" type="text" placeholder="Enter your current job details" name="employment" tabindex="11" >
                        </div>
                    </div>
                    <div class="col-lg-6 new_height">
                        <div class="form-group">
                           <label class="new_lable">Upload Resume</label><span id="red">*</span>
                          <input class="inpt_fld file" type="file" name="upload"  id="upload" value="" />
                        </div>
                    </div>

                    <div class="save col-lg-12">
                        <input class="f_btn" align="middle" type="submit" value="Submit " name="submit" onsubmit="javascript: popupClose()"  />
                    </div>
                  </div>


            </form>
        </div>
      </div>
      <div class="modal-footer career-modal-footer">
<!--        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>-->
      </div>
    </div>
  </div>
</div>

<?php
	include('include/footer.php');
?>


                              
