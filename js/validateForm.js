$(document).ready(function() {
    $("#SignUp-Form").validate({
      rules: {
        name : {
          required: true,
          minlength: 3
        },
        email: {
          required: true,
          email: true
        },
        phone: {
          required: true,
          number: true,
          min: 10
        },
        city: {
            required: true
          },
        Date: {
            required: true
        },
        Month: {
            required: true
        },
        year: {
            required: true
        },
        gender: {
            required: true
        },
        board: {
            required: true
        },
        standard: {
            required: true
        },
        password: {
            required: true,
            password: true,
            minlength: 8
        },
        confirmpassword: {
            required: true,
            password: true,
            minlength: 8
        }
      },
      messages : {
        name: {
          minlength: "Name should be at least 3 characters"
        },
        phone: {
          required: "This Field is required",
          number: "Please enter your number",
          min: "You number must be 10 digit"
        },
        email: {
          email: "The email should be in the format: abc@domain.com"
        },
        city: {
            required: "This Field is required",
            city: "Please Enter Your City"
          },
        Date: {
            required: "This Field is required",
            Date: "Please Choose Date"
        },
        Month: {
            required: "This Field is required",
            Month: "Please Choose Month"
        },
        year: {
            required: "This Field is required",
            year: "Please Choose Year"
        },
        gender: {
            required: "This Field is required",
            gender: "Please Choose Your Gender"
        },
        board: {
            required: "This Field is required",
            board: "Please Enter your Board"
        },
        standard: {
            required: "This Field is required",
            standard: "Please Enter your Standard"
        },
        password: {
            required: "This Field is required",
            password: "Please Enter your Password",
            minlength: "Your Password Must be atleast 8 Character"

        },
        confirmpassword: {
            required: "This Field is required",
            confirmpassword: "Please Confirm your Password",
            minlength: "Your Password Must be atleast 8 Character"
        }
      }
    });

    // Login Form
    $("#login_form").validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        
        password: {
            required: true,
            password: true,
            minlength: 8
        }  
      },
      messages : {
        
        email: {
          required: "This Field is required",
          email: "The email should be in the format: abc@domain.com"
        },
        password: {
            required: "This Field is required",
            password: "Please Enter your Password",
            minlength: "Your Password Must be atleast 8 Character"

        }
      }
    });

    // To validate upload Video
    
});


$(document).ready(function() {
  $("#videoUpload").validate({
    rules: {
      board_select: {
        required: true
      },
      class_select: {
          required: true
      },
      subject_select: {
        required: true
      },
      chapter_select: {
        required: true
      },
      video_file: {
        required: true
      },
      topic_select: {
        required: true
      },
      video_title: {
        required: true,
        minlength: 8
      },
      video_desc: {
        required: true
      },
      terms_conditns: {
        required: true
      }  
    },
    messages : {
      board_select: {
        required: "This Field is required"
      },
      class_select: {
        required: "This Field is required"
      },
      subject_select: {
        required: "This Field is required"
      },
      chapter_select: {
        required: "This Field is required"
      },
      video_file: {
        required: "This Field is required",
        extension: "mp4",
      },
      topic_select: {
        required: "This Field is required"
      },
      video_title: {
        required: "This Field is required",
        minlength: "Title must be minimum 8 long"
      },
      video_desc: {
        required: "This Field is required"
      },
      terms_conditns: {
        required: "This Field is required"
      }
    }
  });

  // To Upload File
  
  
  
  $("#fileUpload").validate({
    rules: {
      board_select: {
        required: true
      },
      class_select: {
          required: true
      },
      subject_select: {
        required: true
      },
      chapter_select: {
        required: true
      },
      pdf_file: {
        required: true
      },
      topic_select: {
        required: true
      },
      file_title: {
        required: true,
        minlength: 8
      },
      file_desc: {
        required: true
      },
      terms_conditns: {
        required: true
      }  
    },
    messages : {
      board_select: {
        required: "This Field is required"
      },
      class_select: {
        required: "This Field is required"
      },
      subject_select: {
        required: "This Field is required"
      },
      chapter_select: {
        required: "This Field is required"
      },
      pdf_file: {
        required: "This Field is required",
        extension: "mp4",
      },
      topic_select: {
        required: "This Field is required"
      },
      file_title: {
        required: "This Field is required",
        minlength: "Title must be minimum 8 long"
      },
      file_desc: {
        required: "This Field is required"
      },
      terms_conditns: {
        required: "This Field is required"
      }
    }
  });
});

  // $(document).ready(function() {
    
  // });