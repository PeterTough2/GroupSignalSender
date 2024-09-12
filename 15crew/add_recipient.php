<?php
require_once "../includes/main.php";
authsuperuser();
$name = NAME;
$pic = "$mi6/assets/img/icon.jpg";
$page_action = "Add Recipient";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>::: Community Manager - <?php echo $page_action; ?> :::</title>
    <link rel="shortcut icon" href="../assets_v2/img/favicon.png">

    <link rel="stylesheet" href="../assets/css/jqueryui.css">
    <!-- vendor css -->
    <link href="../assets_v2/lib/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../assets_v2/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../assets_v2/lib/typicons.font/typicons.css" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="../assets_v2/css/azia.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets_v2/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets_v2/css/custom_v2.css">

    <style>
        input.switch {
            height: 0;
            width: 0;
            visibility: hidden;
        }

        label.switch {
            cursor: pointer;
            text-indent: -9999px;
            width: 50px;
            height: 30px;
            background: grey;
            display: block;
            border-radius: 20px;
            position: relative;
            margin-bottom: 30px;
        }

        label:after {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            width: 20px;
            height: 20px;
            background: #fff;
            border-radius: 20px;
            transition: 0.3s;
        }

        input:checked + label.switch {
            background: #2279a4;
        }

        input:checked + label:after {
            left: calc(100% - 5px);
            transform: translateX(-100%);
        }

        label:active:after {
            width: 40px;
        }
    </style>

  </head>
  <body class="az-body az-body-sidebar az-body-dashboard-nine">

    <div class="az-sidebar az-sidebar-sticky az-sidebar-indigo-dark">
      <?php
      require_once "leftmenu.php";
      ?>
    </div><!-- az-sidebar -->
    <div class="az-content az-content-dashboard-nine">


      <?php
      require_once "topmenu.php";
      ?>
      <div class="az-content-header">
        <div class="az-content-header-top">
          <div>
            <h2 class="az-content-title mg-b-5 mg-b-lg-8"><?php echo $page_action; ?></h2>
          </div>
        </div><!-- az-content-body-title -->

      </div><!-- az-content-header -->
      <div class="az-content-body">
        <!-- your content starts here -->



<div id="status" style="margin-top: 10px; margin-bottom: 15px;"></div>
<div class="tblpagination">
 <div class="row row-sm">

<?php
if (!empty($_GET['channel_id'])) {
  if ((int)$_GET['channel_id'] > 0) {
    $channel_id = (int)$_GET['channel_id'];
    $SQLi_a = mysqli_query($conn, "SELECT * FROM cm_channel WHERE id = '$channel_id'");
    while($ix_data = mysqli_fetch_assoc($SQLi_a)) {
        $channel_id = $ix_data['id'];
        $channel_name = $ix_data['channel_name'];
        $channel_status = $ix_data['link_status'];
        $created = $ix_data['created'];
        $updated = $ix_data['updated'];
    }

    $id_url = base64_encode($channel_id);
    $created_url = base64_encode($created);
    if ($channel_status == 'active') {
      $class_status = "on";
    }else {
      $class_status = "";
    }

    $onboard_url = $mi6."onboard.php"."?channel_id=$id_url&channel_cd=$created_url";

?>

    <div class="col-md-8 col-sm-12 form-partition">

      <div class="input-group mb-3">
          <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Channel Name</span>
          </div>
          <input type="text" readonly class="form-control" name="channel_name" id="channel_name" autocomplete="off" aria-describedby="basic-addon1" value="<?php echo $channel_name; ?>" required>
      </div><!-- input-group -->

      Activate URL: Members can register to this channel only when URL is activated.
      <br>
      <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="basic-addon1">Channel URL</span>
      </div>
      <input type="text" readonly class="form-control" name="channel_url" id="channel_url" autocomplete="off" aria-describedby="basic-addon1" value="<?php echo $onboard_url; ?>" required>
      </div><!-- input-group -->

      <div class='az-toggle az-toggle-success <?php echo $class_status; ?>' link_toggle_status='<?php echo $channel_status; ?>'><span></span></div>
    </div>

    <div class="col-md-8 col-sm-12 form-partition">


<!-- edit form start -->

<form id="edit_service_form" method="post" enctype="multipart/form-data">

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Subscriber Name</span>
</div>
<input type="text" class="form-control" name="subscriber_name" id="subscriber_name" autocomplete="off" aria-describedby="basic-addon1" required>
<input type="hidden" class="form-control" name="channel_id" id="channel_id" value="<?php echo $channel_id; ?>" required>
</div><!-- input-group -->

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Subscriber Email <small>(optional)</small></span>
</div>
<input type="email" class="form-control" name="email" id="email" autocomplete="off" aria-describedby="basic-addon1" required>
</div><!-- input-group -->

<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text" id="basic-addon1">Phone Number</span>
</div>
<select name="countrycode" id="countrycode" class="form-control">
    <option value="">- Select Country Code -</option>
    <option data-countryCode="NG" value="234" Selected>Nigeria (+234)</option>
    <option data-countryCode="GB" value="44">UK (+44)</option>
	<option data-countryCode="US" value="1">USA (+1)</option>
	<optgroup label="Other countries">
		<option data-countryCode="DZ" value="213">Algeria (+213)</option>
		<option data-countryCode="AD" value="376">Andorra (+376)</option>
		<option data-countryCode="AO" value="244">Angola (+244)</option>
		<option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
		<option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
		<option data-countryCode="AR" value="54">Argentina (+54)</option>
		<option data-countryCode="AM" value="374">Armenia (+374)</option>
		<option data-countryCode="AW" value="297">Aruba (+297)</option>
		<option data-countryCode="AU" value="61">Australia (+61)</option>
		<option data-countryCode="AT" value="43">Austria (+43)</option>
		<option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
		<option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
		<option data-countryCode="BH" value="973">Bahrain (+973)</option>
		<option data-countryCode="BD" value="880">Bangladesh (+880)</option>
		<option data-countryCode="BB" value="1246">Barbados (+1246)</option>
		<option data-countryCode="BY" value="375">Belarus (+375)</option>
		<option data-countryCode="BE" value="32">Belgium (+32)</option>
		<option data-countryCode="BZ" value="501">Belize (+501)</option>
		<option data-countryCode="BJ" value="229">Benin (+229)</option>
		<option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
		<option data-countryCode="BT" value="975">Bhutan (+975)</option>
		<option data-countryCode="BO" value="591">Bolivia (+591)</option>
		<option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
		<option data-countryCode="BW" value="267">Botswana (+267)</option>
		<option data-countryCode="BR" value="55">Brazil (+55)</option>
		<option data-countryCode="BN" value="673">Brunei (+673)</option>
		<option data-countryCode="BG" value="359">Bulgaria (+359)</option>
		<option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
		<option data-countryCode="BI" value="257">Burundi (+257)</option>
		<option data-countryCode="KH" value="855">Cambodia (+855)</option>
		<option data-countryCode="CM" value="237">Cameroon (+237)</option>
		<option data-countryCode="CA" value="1">Canada (+1)</option>
		<option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
		<option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
		<option data-countryCode="CF" value="236">Central African Republic (+236)</option>
		<option data-countryCode="CL" value="56">Chile (+56)</option>
		<option data-countryCode="CN" value="86">China (+86)</option>
		<option data-countryCode="CO" value="57">Colombia (+57)</option>
		<option data-countryCode="KM" value="269">Comoros (+269)</option>
		<option data-countryCode="CG" value="242">Congo (+242)</option>
		<option data-countryCode="CK" value="682">Cook Islands (+682)</option>
		<option data-countryCode="CR" value="506">Costa Rica (+506)</option>
		<option data-countryCode="HR" value="385">Croatia (+385)</option>
		<option data-countryCode="CU" value="53">Cuba (+53)</option>
		<option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
		<option data-countryCode="CY" value="357">Cyprus South (+357)</option>
		<option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
		<option data-countryCode="DK" value="45">Denmark (+45)</option>
		<option data-countryCode="DJ" value="253">Djibouti (+253)</option>
		<option data-countryCode="DM" value="1809">Dominica (+1809)</option>
		<option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
		<option data-countryCode="EC" value="593">Ecuador (+593)</option>
		<option data-countryCode="EG" value="20">Egypt (+20)</option>
		<option data-countryCode="SV" value="503">El Salvador (+503)</option>
		<option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
		<option data-countryCode="ER" value="291">Eritrea (+291)</option>
		<option data-countryCode="EE" value="372">Estonia (+372)</option>
		<option data-countryCode="ET" value="251">Ethiopia (+251)</option>
		<option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
		<option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
		<option data-countryCode="FJ" value="679">Fiji (+679)</option>
		<option data-countryCode="FI" value="358">Finland (+358)</option>
		<option data-countryCode="FR" value="33">France (+33)</option>
		<option data-countryCode="GF" value="594">French Guiana (+594)</option>
		<option data-countryCode="PF" value="689">French Polynesia (+689)</option>
		<option data-countryCode="GA" value="241">Gabon (+241)</option>
		<option data-countryCode="GM" value="220">Gambia (+220)</option>
		<option data-countryCode="GE" value="7880">Georgia (+7880)</option>
		<option data-countryCode="DE" value="49">Germany (+49)</option>
		<option data-countryCode="GH" value="233">Ghana (+233)</option>
		<option data-countryCode="GI" value="350">Gibraltar (+350)</option>
		<option data-countryCode="GR" value="30">Greece (+30)</option>
		<option data-countryCode="GL" value="299">Greenland (+299)</option>
		<option data-countryCode="GD" value="1473">Grenada (+1473)</option>
		<option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
		<option data-countryCode="GU" value="671">Guam (+671)</option>
		<option data-countryCode="GT" value="502">Guatemala (+502)</option>
		<option data-countryCode="GN" value="224">Guinea (+224)</option>
		<option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
		<option data-countryCode="GY" value="592">Guyana (+592)</option>
		<option data-countryCode="HT" value="509">Haiti (+509)</option>
		<option data-countryCode="HN" value="504">Honduras (+504)</option>
		<option data-countryCode="HK" value="852">Hong Kong (+852)</option>
		<option data-countryCode="HU" value="36">Hungary (+36)</option>
		<option data-countryCode="IS" value="354">Iceland (+354)</option>
		<option data-countryCode="IN" value="91">India (+91)</option>
		<option data-countryCode="ID" value="62">Indonesia (+62)</option>
		<option data-countryCode="IR" value="98">Iran (+98)</option>
		<option data-countryCode="IQ" value="964">Iraq (+964)</option>
		<option data-countryCode="IE" value="353">Ireland (+353)</option>
		<option data-countryCode="IL" value="972">Israel (+972)</option>
		<option data-countryCode="IT" value="39">Italy (+39)</option>
		<option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
		<option data-countryCode="JP" value="81">Japan (+81)</option>
		<option data-countryCode="JO" value="962">Jordan (+962)</option>
		<option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
		<option data-countryCode="KE" value="254">Kenya (+254)</option>
		<option data-countryCode="KI" value="686">Kiribati (+686)</option>
		<option data-countryCode="KP" value="850">Korea North (+850)</option>
		<option data-countryCode="KR" value="82">Korea South (+82)</option>
		<option data-countryCode="KW" value="965">Kuwait (+965)</option>
		<option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
		<option data-countryCode="LA" value="856">Laos (+856)</option>
		<option data-countryCode="LV" value="371">Latvia (+371)</option>
		<option data-countryCode="LB" value="961">Lebanon (+961)</option>
		<option data-countryCode="LS" value="266">Lesotho (+266)</option>
		<option data-countryCode="LR" value="231">Liberia (+231)</option>
		<option data-countryCode="LY" value="218">Libya (+218)</option>
		<option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
		<option data-countryCode="LT" value="370">Lithuania (+370)</option>
		<option data-countryCode="LU" value="352">Luxembourg (+352)</option>
		<option data-countryCode="MO" value="853">Macao (+853)</option>
		<option data-countryCode="MK" value="389">Macedonia (+389)</option>
		<option data-countryCode="MG" value="261">Madagascar (+261)</option>
		<option data-countryCode="MW" value="265">Malawi (+265)</option>
		<option data-countryCode="MY" value="60">Malaysia (+60)</option>
		<option data-countryCode="MV" value="960">Maldives (+960)</option>
		<option data-countryCode="ML" value="223">Mali (+223)</option>
		<option data-countryCode="MT" value="356">Malta (+356)</option>
		<option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
		<option data-countryCode="MQ" value="596">Martinique (+596)</option>
		<option data-countryCode="MR" value="222">Mauritania (+222)</option>
		<option data-countryCode="YT" value="269">Mayotte (+269)</option>
		<option data-countryCode="MX" value="52">Mexico (+52)</option>
		<option data-countryCode="FM" value="691">Micronesia (+691)</option>
		<option data-countryCode="MD" value="373">Moldova (+373)</option>
		<option data-countryCode="MC" value="377">Monaco (+377)</option>
		<option data-countryCode="MN" value="976">Mongolia (+976)</option>
		<option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
		<option data-countryCode="MA" value="212">Morocco (+212)</option>
		<option data-countryCode="MZ" value="258">Mozambique (+258)</option>
		<option data-countryCode="MN" value="95">Myanmar (+95)</option>
		<option data-countryCode="NA" value="264">Namibia (+264)</option>
		<option data-countryCode="NR" value="674">Nauru (+674)</option>
		<option data-countryCode="NP" value="977">Nepal (+977)</option>
		<option data-countryCode="NL" value="31">Netherlands (+31)</option>
		<option data-countryCode="NC" value="687">New Caledonia (+687)</option>
		<option data-countryCode="NZ" value="64">New Zealand (+64)</option>
		<option data-countryCode="NI" value="505">Nicaragua (+505)</option>
		<option data-countryCode="NE" value="227">Niger (+227)</option>
		<!-- <option data-countryCode="NG" value="234">Nigeria (+234)</option> -->
		<option data-countryCode="NU" value="683">Niue (+683)</option>
		<option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
		<option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
		<option data-countryCode="NO" value="47">Norway (+47)</option>
		<option data-countryCode="OM" value="968">Oman (+968)</option>
		<option data-countryCode="PW" value="680">Palau (+680)</option>
		<option data-countryCode="PA" value="507">Panama (+507)</option>
		<option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
		<option data-countryCode="PY" value="595">Paraguay (+595)</option>
		<option data-countryCode="PE" value="51">Peru (+51)</option>
		<option data-countryCode="PH" value="63">Philippines (+63)</option>
		<option data-countryCode="PL" value="48">Poland (+48)</option>
		<option data-countryCode="PT" value="351">Portugal (+351)</option>
		<option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
		<option data-countryCode="QA" value="974">Qatar (+974)</option>
		<option data-countryCode="RE" value="262">Reunion (+262)</option>
		<option data-countryCode="RO" value="40">Romania (+40)</option>
		<option data-countryCode="RU" value="7">Russia (+7)</option>
		<option data-countryCode="RW" value="250">Rwanda (+250)</option>
		<option data-countryCode="SM" value="378">San Marino (+378)</option>
		<option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
		<option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
		<option data-countryCode="SN" value="221">Senegal (+221)</option>
		<option data-countryCode="CS" value="381">Serbia (+381)</option>
		<option data-countryCode="SC" value="248">Seychelles (+248)</option>
		<option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
		<option data-countryCode="SG" value="65">Singapore (+65)</option>
		<option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
		<option data-countryCode="SI" value="386">Slovenia (+386)</option>
		<option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
		<option data-countryCode="SO" value="252">Somalia (+252)</option>
		<option data-countryCode="ZA" value="27">South Africa (+27)</option>
		<option data-countryCode="ES" value="34">Spain (+34)</option>
		<option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
		<option data-countryCode="SH" value="290">St. Helena (+290)</option>
		<option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
		<option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
		<option data-countryCode="SD" value="249">Sudan (+249)</option>
		<option data-countryCode="SR" value="597">Suriname (+597)</option>
		<option data-countryCode="SZ" value="268">Swaziland (+268)</option>
		<option data-countryCode="SE" value="46">Sweden (+46)</option>
		<option data-countryCode="CH" value="41">Switzerland (+41)</option>
		<option data-countryCode="SI" value="963">Syria (+963)</option>
		<option data-countryCode="TW" value="886">Taiwan (+886)</option>
		<option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
		<option data-countryCode="TH" value="66">Thailand (+66)</option>
		<option data-countryCode="TG" value="228">Togo (+228)</option>
		<option data-countryCode="TO" value="676">Tonga (+676)</option>
		<option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
		<option data-countryCode="TN" value="216">Tunisia (+216)</option>
		<option data-countryCode="TR" value="90">Turkey (+90)</option>
		<option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
		<option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
		<option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
		<option data-countryCode="TV" value="688">Tuvalu (+688)</option>
		<option data-countryCode="UG" value="256">Uganda (+256)</option>
		<!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
		<option data-countryCode="UA" value="380">Ukraine (+380)</option>
		<option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
		<option data-countryCode="UY" value="598">Uruguay (+598)</option>
		<!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
		<option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
		<option data-countryCode="VU" value="678">Vanuatu (+678)</option>
		<option data-countryCode="VA" value="379">Vatican City (+379)</option>
		<option data-countryCode="VE" value="58">Venezuela (+58)</option>
		<option data-countryCode="VN" value="84">Vietnam (+84)</option>
		<option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
		<option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
		<option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
		<option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
		<option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
		<option data-countryCode="ZM" value="260">Zambia (+260)</option>
		<option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
	</optgroup>
</select>
<input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="08035541924" autocomplete="off" aria-describedby="basic-addon1" required>
</div><!-- input-group -->

<div class="box-footer">
<button type="submit" class="btn btn-info pull-left update_service">Add Recipient</button>
</div><!-- /.box-footer -->

 </div><!-- col -->
</div><!-- row -->


</form>
<!-- end edit form -->
<?php
  }
}
?>

</div><!-- /.tblpagination -->


        <!-- your content ends here -->
      </div><!-- az-content-body -->
      <div class="az-footer">
      <?php
      require_once "footer.php";
      ?>
      </div><!-- az-footer -->
    </div><!-- az-content -->

    <!--For autocomplete to work-->
    <!--<script src="../assets_v2/lib/jquery/jquery.min.js"></script>-->
    <script src="../assets/js/jQuery-2.1.4.min.js"></script>
    <script src="../assets/js/jquery-ui.js"></script>
    <script src="../assets_v2/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets_v2/lib/ionicons/ionicons.js"></script>
    <script src="../assets_v2/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="../assets_v2/js/azia.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Page script -->
    <script src="../assets_v2/js/functions.js"></script>
    <script>
      $(function(){
        'use strict'

        $('.az-sidebar .with-sub').on('click', function(e){
          e.preventDefault();
          $(this).parent().toggleClass('show');
          $(this).parent().siblings().removeClass('show');
        })

        $(document).on('click touchstart', function(e){
          e.stopPropagation();

          // closing of sidebar menu when clicking outside of it
          if(!$(e.target).closest('.az-header-menu-icon').length) {
            var sidebarTarg = $(e.target).closest('.az-sidebar').length;
            if(!sidebarTarg) {
              $('body').removeClass('az-sidebar-show');
            }
          }
        });

        $('#azSidebarToggle').on('click', function(e){
          e.preventDefault();

          if(window.matchMedia('(min-width: 992px)').matches) {
            $('body').toggleClass('az-sidebar-hide');
          } else {
            $('body').toggleClass('az-sidebar-show');
          }
        });

        new PerfectScrollbar('.az-sidebar-body', {
          suppressScrollX: true
        });

        // Toggle Switches
        $(document).on('click', '.az-toggle', function(event){
            $(this).toggleClass('on');
        });

      });


$(document).on('click', 'button.create_service', function(event){
    event.preventDefault();
    var channel_name = $('input#channel_name').val();

    if ( (channel_name == '') || (channel_name == ' ')) {
        alert('Please enter Channel name');
        return false;
    }
    var doService = document.getElementById('add_service_form');

    var loading = $('<div id="loading" style="display: none;margin: 0 auto;position: absolute;left: 45%;top: 42%;width: 70px;padding: 10px;"><img src="../assets/img/double_ring.gif" alt="Loading..." style="width: 50px;"></div>').insertBefore('div.tblpagination');
    loading.show();
    $('div#status').html('');
    $.ajax({
        type: 'POST',
        url: 'do_create_channel.php',
        dataType: 'json',
        data: new FormData(doService),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        $("html, body, #add_service_form").animate({ scrollTop: 0 }, 1200);
    },
    success: function(msg){
        var status = msg.status;
        var response = msg.data;
        if(status == 'OK'){
        var service_id = msg.id;
            $('div#status').html(response);
            $("#add_service_form")[0].reset();
        }if(status == 'ERROR'){
            $('div#status').html(response);
        }
        loading.remove();
    },
    error: function(jqXHR, textStatus, errorThrown){
        loading.remove();
        alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
    }
    });
});

$(document).on('click', 'button.update_service', function(event){
    event.preventDefault();
    var subscriber_name = $('input#subscriber_name').val();
    var countrycode = $('input#countrycode').val();
    var phone_number = $('input#phone_number').val();

    if ( (subscriber_name == '') || (subscriber_name == ' ')) {
        alert('Please enter Subscriber name');
        return false;
    }
    if ( (countrycode == '') || (countrycode == ' ')) {
        alert('Please select country code');
        return false;
    }
    if ( (phone_number == '') || (phone_number == ' ')) {
        alert('Please enter phone number');
        return false;
    }
    var doService = document.getElementById('edit_service_form');

    var loading = $('<div id="loading" style="display: none;margin: 0 auto;position: absolute;left: 45%;top: 42%;width: 70px;padding: 10px;"><img src="../assets/img/double_ring.gif" alt="Loading..." style="width: 50px;"></div>').insertBefore('div.tblpagination');
    loading.show();
    $('div#status').html('');
    $.ajax({
        type: 'POST',
        url: 'do_add_recipient.php',
        dataType: 'json',
        data: new FormData(doService),
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        $("html, body, #edit_service_form").animate({ scrollTop: 0 }, 1200);
    },
    success: function(msg){
        var status = msg.status;
        var response = msg.data;
        if(status == 'OK'){
            var service_id = msg.id;
            $('div#status').html(response);
            $('input#subscriber_name').val('');
        }if(status == 'ERROR'){
            $('div#status').html(response);
        }
        loading.remove();
    },
    error: function(jqXHR, textStatus, errorThrown){
        loading.remove();
        alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
    }
    });
});


$(document).on('click', '.az-toggle', function(event){

    var channel_id = '<?php echo (int)$_GET['channel_id']; ?>';
    var link_toggle_status = $(this).attr('link_toggle_status');
    var toggle_attr = $(this);

    if (link_toggle_status == 'active') {
        var toggle = "off";
    }
    if (link_toggle_status == 'inactive') {
        var toggle = "on";
    }
    //alert(link_toggle_status+" ->"+toggle);

    if ( (channel_id.length > 0) ) {
        $.ajax({
        type: 'POST',
        url: 'toggle_channel.php?channel_id='+channel_id+"&deliver="+toggle,
        dataType: 'json',
        data: '',
        contentType: false,
        cache: false,
        processData:false,
        beforeSend: function(){
        //$("html, body, #edit_service_form").animate({ scrollTop: 0 }, 1200);
        },
        success: function(msg){
            var status = msg.status;
            var response = msg.data;
            if(status == 'OK'){
                if (deliver_status == 'on') {
                    toggle_attr.attr('deliver', 'off');
                }
                if (deliver_status == 'off') {
                    toggle_attr.attr('deliver', 'on');
                }
            }if(status == 'ERROR'){
                alert(response);
                if (toggle_attr.hasClass('off')) {
                    toggle_attr.addClass('on');
                }else {
                    toggle_attr.removeClass('on'); 
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Sorry, but an error occurred: '+textStatus+' ('+errorThrown+')');
        }
        });
    }
});

    </script>
  </body>
</html>