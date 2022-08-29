jQuery.validator.addMethod(
  "phoneRule",
  function (phone_number, element) {
    phone_number = phone_number.replace(/\s+/g, "");
    return (
      this.optional(element) ||
      (phone_number.length > 9 &&
        phone_number.match(
          /^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/
        ))
    );
  },
  "Please specify a valid phone number"
);

$(document).ready(function () {
  $("#form-message-success").hide();
  $(".loader").hide();
  $("#contactForm").validate({
    rules: {
      fname: {
        required: true,
        minlength: 2,
      },
      lname: {
        required: true,
        minlength: 2,
      },
      email: {
        required: true,
        email: true,
      },
      number: {
        required: true,
        phoneRule: true,
      },
      message: {
        required: true,
        minlength: 5,
      },
    },
    messages: {
      fname: {
        required: "Please enter your first name",
        minlength: "Please enter more than 2 characters",
      },
      lname: {
        required: "Please enter your first name",
        minlength: "Please enter more than 2 characters",
      },
      email: "Please enter a valid email address",
      number: {
        required: "Please enter a phone number",
      },
      message: "Please enter a message",
    },

    submitHandler: function (form) {
      $(".loader").show();
      var form_data = new FormData(form);
      form_data.append("action", "user_hook");
      form_data.append("nonce", myLink.nonce);
      $.ajax({
        url: myLink.ajax_link,
        type: "POST",
        contentType: false,
        processData: false,
        data: form_data,
        success: function (response) {
          if (response) {
            $("#form-message-success").show();
            $("#contactForm")[0].reset();
            $(".loader").hide();
            setTimeout(function () {
              location.reload(true);
            }, 5000);
          }
        },
      });
    },
  });
});
