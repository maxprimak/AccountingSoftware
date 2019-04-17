$(document).ready(function () {

    // Step show event
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //alert("You are on step "+stepNumber+" now");
        if (stepPosition === 'first') {
            $("#prev-btn").addClass('disabled');
        } else if (stepPosition === 'final') {
            $("#next-btn").addClass('disabled');
        } else {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
        }
    });


    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info')
        .on('click', function (e) { 
            if(!checkRequiredFields()){
                toastr.info("Please, fill in all the fields");
            } 
            else{
                e.preventDefault(); // avoid to execute the actual submit of the form.
                submitRegSteps();
            }
        });
    var btnCancel = $('<button></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function () { $('#smartwizard').smartWizard("reset"); });

        function checkRequiredFields(){
            var result = true;
            if($('#name_user').val() == "" || $('#phone_user').val() == "" || $('#address_user').val() == "" ||
                $('#name_company').val() == "" || $('#phone_company').val() == "" || $('#address_company').val() == "")
                result = false;
            return result;
        }

        function submitRegSteps(){
                var form = $("#reg_steps_submit");
                var url = form.attr('action');

                $.ajax({
                   type: "POST",
                   url: url,
                   dataType: 'json',
                   data: form.serialize(), // serializes the form's elements.
                   beforeSend: function() {
                       toastr.info("Loading");
                   },
                   success: function(data)
                   {
                    toastr.success("Success");
                    window.location.assign('/add_employees/' + data.company_id );
                   },
                   error: function(){
                    toastr.warning("Something went wrong");
                    }
                });
        }

    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'default',
        transitionEffect: 'fade',
        showStepURLhash: true,
        toolbarSettings: {
            toolbarPosition: 'both',
            toolbarButtonPosition: 'end',
            toolbarExtraButtons: [btnFinish, btnCancel]
        }
    });


    // External Button Events
    $("#reset-btn").on("click", function () {
        // Reset wizard
        $('#smartwizard').smartWizard("reset");
        return true;
    });

    $("#prev-btn").on("click", function () {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function () {
        // Navigate next
        $('#smartwizard').smartWizard("next");
        return true;
    });

    $("#theme_selector").on("change", function () {
        // Change theme
        $('#smartwizard').smartWizard("theme", $(this).val());
        return true;
    });

    // Set selected theme on page refresh
    $("#theme_selector").change();
});