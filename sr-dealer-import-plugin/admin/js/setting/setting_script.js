var selected_parent_category = 0;
var selected_child_category = 0;
var pc_code = 0;
var cc_code = 0;
var property_type_id = 1;
var selected_template = null;
var selected_template_position = -1;
var selected_editor = null;


jQuery(document).ready(function ($) {
    var srCsvFiles = null;
    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
    function isNumber(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        var regx = new RegExp('^[0-9]+[.][0-9]*$');
        var regx2 = new RegExp('^[0-9]+$');

        var input = $(element).val() + String.fromCharCode(charCode);

        if ((!regx.test(input)) && charCode != 8) {
            if (!regx2.test(input)) {
                return false;
            }
        }
        return true;
    }

    // THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A INTEGER VALUE.
    function isInteger(evt, element) {

        var charCode = (evt.which) ? evt.which : event.keyCode

        var regx2 = new RegExp('^[0-9]+$');

        var input = $(element).val() + String.fromCharCode(charCode);

        if (!regx2.test(input) && charCode != 8) {
            return false;
        }
        return true;
    }


    function correctInput(element)
    {
        var input = $(element).val();
        var regx = new RegExp('^[0-9]*\.$');

        if (regx.test(input)) {
            $(element).val(input.replace(".", ""));
        }
    }

    $("#new_location").on("click", function (e)
    {
        $("#new_location_modal").modal("show");
        e.preventDefault();
        e.stopPropagation();
    });

    $(".import-btn").on("click", function (e)
    {
        var type = $(".import-btn").data("button-type");
        if (type == "import")
        {
            $("#import-input").click();
        } else if (type == "upload")
        {
            import_dealers_from_csv();
            //$("#import-form").submit();
        }
        e.preventDefault();
    });

    $("#import-input").on('change', function (e)
    {
        var type = $(".import-btn").data("button-type");
        if (type == "import")
        {
            var filename = $(this).val().split('\\').pop();
            var ext = filename.split(".");
            
            srCsvFiles = e.target.files;
            
            if (ext.length > 1)
                if (ext[ext.length - 1].toUpperCase() == "CSV")
                {
                    var dismiss_content = '<a href="#" id="dismiss-import" class="btn btn-transparent"><b>x</b></a>';

                    $("#uploaded-file").html(filename + dismiss_content);
                    $("#uploaded-file").fadeIn("slow");
                    $(".import-btn").data("button-type", "upload");
                    $(".import-btn").html("Upload");
                } else
                {
                    alert("Invalid File Input");
                }
        }
    });
    var slot = 0;
    $(document).on("click", "#dismiss-import", function (e)
    {
        var $el = $('#import-input');
        $el.wrap('<form>').closest('form').get(0).reset();
        $el.unwrap();
        $("#uploaded-file").html("");
        // $("#uploaded-file").value("");
        $("#uploaded-file").fadeOut("slow");
        $(".import-btn").data("button-type", "import");
        $(".import-btn").html("Import From CSV");
        e.preventDefault();
    });

    $(window).click(function (e) {
        if ($('.shortcode-btnn').css('display') === 'block' || $('.shortcode-btnn').css('display') === 'inline')
            $(".insert-shortcode-conts").hide('fast');
    });
    
    function import_dealers_from_csv() {
        //alert(wp_ajax.ajax_url + '?action=import_dealers_from_csv');
        //return;
        var data = new FormData("import-form");
        // data.append("csv", $("#import-input").val())
        $.each(srCsvFiles, function(key, value)
        {
            data.append('csv', value);
        });
        console.log("Request=>",JSON.stringify(data));
        jQuery.ajax({
            method: "POST",
            url: wp_ajax.ajax_url + '?action=import_dealers_from_csv',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function (data)
            {
                console.log("Responce=>",data);
                data = JSON.parse(data);
                if (data.status == 1) {
                    //success
                }
                   var $el = $('#import-input');
                   $el.wrap('<form>').closest('form').get(0).reset();
                   $el.unwrap();
                   $("#uploaded-file").html("");
                   // $("#uploaded-file").value("");
                   $("#uploaded-file").fadeOut("slow");
                   $(".import-btn").data("button-type", "import");
                   $(".import-btn").html("Import From CSV");
                  // e.preventDefault();
            },
            error: function (xhr)
            {
                console.log("Responce=>",xhr.data);
                console.log("An error occured: " + xhr.status + " " + xhr.statusText);
            }

        });
    }

});