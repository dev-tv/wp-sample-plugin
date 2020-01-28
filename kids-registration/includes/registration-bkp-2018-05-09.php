<link href="<?php echo plugin_dir_url(__FILE__); ?>main.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<?php
//session_start();
//echo plugin_dir_url( __FILE__ );"/main.css";die();
$reg_id = uniqid();
$code = md5($reg_id . 'kids#@!');
//echo $code; die();
?>
<div id="reg_form">
    <form method="post" name="customerData" action="<?php echo site_url(); ?>/index.php/contest-process/" enctype="multipart/form-data" onSubmit="return validate();">	
        <input type="hidden" name="tid" id="tid" readonly />
        <!--<input type="hidden" name="merchant_id" value=""/>-->
        <input type="hidden" name="order_id" value="<?php echo $reg_id; ?>"/>
<!--        <input type="hidden" name="amount" value=""/>-->
        <!--<input type="hidden" name="currency" value=""/>-->

        <input type="hidden" name="redirect_url" value="<?php echo site_url(); ?>/index.php/contest-payment-success/?reg_id=<?php echo $reg_id; ?>&code=<?php echo $code; ?>&status=success"/>
        <input type="hidden" name="cancel_url" value="<?php echo site_url(); ?>/index.php/contest-registration/"/>
        <!--<input type="hidden" name="language" value=""/>-->
        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Child's Name<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="child_name" class="form-input" pattern="[a-z A-Z]{1,40}$" required title="Child Name Should be Alphabets and not greater than 40 characters" />
            </div>
        </div>
        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Date Of Birth<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="date_of_birth" id="datepicker" required onchange="count_age(this.value)" placeholder="DD-MM-YYYY" pattern="(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$"  title="Date Must Be In DD-MM-YYYY"> 
            </div>
        </div>
        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Child's Age<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="age" class="form-input" id="age" readonly>
            </div>
        </div>
        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Gender<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="radio" name="gender" value="girl" class="form-input"><div class="gb"> Girl</div>
                <input type="radio" name="gender" value="boy" class="form-input"><div class="gb"> Boy</div>
            </div>
        </div>
        <!--div class="form-field gender">
        </div-->
        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Parent's Name<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="parent_name" class="form-input" pattern="[a-z A-Z]{1,40}$" required title="Parent Name Should be Alphabets and not greater than 40 characters" />
            </div>
        </div>
        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Contact Number<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="contact_number" class="form-input" pattern="[7-9]{1}[0-9]{9}"  required />
            </div>
        </div>

        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Parent's Email Id<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="email" name="email_id" class="form-input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
            </div>
        </div>

        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Facebook Address</label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="facebook_id" class="form-input" />
            </div>
        </div>

        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>Address<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <textarea name="address" class="form-input"  required></textarea>
            </div>
        </div>

        <div class="form-field">
            </div>
            <div class="sr-md-6 sr-sm-12">
                <label class="select_tab1">State<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <div class="select_tab select_state"><?php echo kids::states(); ?></div>
            </div>
        </div> 

        <div class="form-field">
            <div class="sr-md-6 sr-sm-12">
                <label>City<em>*</em></label>
            </div>
            <div class="sr-md-6 sr-sm-12">
                <input type="text" name="city" class="form-input" required />
            </div>
        </div>  
        <div class="image_box"> 
            <div class="form-field  photo5">
                <label>Upload Child Photo1<em>*</em></label>
            <input type="file" name="photo1" id="file1" class="form-input demoInputBox1" required><span id="file_error1"></span>
            </div>
            <div class="form-field  photo5">
                <label>Upload Photo2<em>*</em></label>
            <input type="file" name="photo2" id="file2" class="form-input demoInputBox2" required><span id="file_error2"></span>
            </div>
            <div class="form-field  photo5">
                <label>Upload Photo3<em>*</em></label>
            <input type="file" name="photo3" id="file3" class="form-input demoInputBox3" required><span id="file_error3"></span>
            </div>
            
        </div>
        <div class="form-field photo">
            <input type="checkbox" name="terms" value="1" required>
            <div class="gb">
                &nbsp;I have read all the <a href="http://indiacutestkids.com/terms-conditions/" title="Rules & Regulations" style="text-decoration:none; color:#242424; font-weight:bold"> terms & conditions.</a>
            </div>
            <div>
                <p>*Registration Fees : INR 750.00 /-</p>
            </div>
        </div>
        <div class="form-field marr">
        <input type="submit" id="btnSubmit" name="form_submit" value="Submit" class="form-input">&nbsp;&nbsp;
            <input type="reset" name="cancle" class="form-input">
        </div>

    </form>

</div>

<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
<script>
function validate() {
    $("#file_error").html("");
    $(".demoInputBox").css("border-color","#F0F0F0");

    var file_size1 = $('#file1')[0].files[0].size;
    var file_size2 = $('#file2')[0].files[0].size;
    var file_size3 = $('#file3')[0].files[0].size;

    if(file_size1>2097152) {

        $("#file_error1").html("File size is greater than 2MB");
        $(".demoInputBox1").css("border-color","#FF0000");
        $("#file_error2").html(" ");
        $("#file_error3").html(" ");
        $(".demoInputBox2").css("border-color","#F0F0F0");
        $(".demoInputBox3").css("border-color","#F0F0F0");
        return false;
    } 

    if(file_size2>2097152) {
        
        $("#file_error2").html("File size is greater than 2MB");
        $(".demoInputBox2").css("border-color","#FF0000");
        $("#file_error1").html(" ");
        $("#file_error3").html(" ");
        $(".demoInputBox1").css("border-color","#F0F0F0");
        $(".demoInputBox3").css("border-color","#F0F0F0");
        return false;
    } 

    if(file_size3>2097152) {
        
        $("#file_error3").html("File size is greater than 2MB");
        $(".demoInputBox3").css("border-color","#FF0000");
        $("#file_error1").html(" ");
        $("#file_error2").html(" ");
        $(".demoInputBox1").css("border-color","#F0F0F0");
        $(".demoInputBox2").css("border-color","#F0F0F0");
        return false;
    } 

    return true;
}
</script>

<script>

    function count_age(date_of_birth)
    {
        //alert(date_of_birth);
        var dob_array = date_of_birth.split('-');
        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth();
        if (month >= dob_array[1])
        {
            var year_diff = parseInt(year) - parseInt(dob_array[2]);
            var month_diff = parseInt(month) - parseInt(dob_array[1]);
        } else
        {
            var year_diff = parseInt(year) - parseInt(dob_array[2]) - parseInt(1);
            var month_diff = parseInt(12) - (parseInt(dob_array[1]) - parseInt(month));
        }


        document.getElementById("age").value = year_diff + ' years ' + month_diff + ' months';
    }
</script>
<script language="javascript" type="text/javascript" src="<?php echo plugins_url(); ?>/cute-kids/json.js"></script>