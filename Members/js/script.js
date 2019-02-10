
function preventNumberInput(e) {
  var keyCode = (e.keyCode ? e.keyCode : e.which);
  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
  }
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

   $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later

         icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        excluded: [':disabled'],
        fields: {
            firstName: {
                validators: {
                        stringLength: {
                        //min: 2,
                    },
                        notEmpty: {
                        message: 'Please input first name'
                    }
                }
            },
             middleName: {
                validators: {
                     stringLength: {
                       // min: 2,
                    },
                    notEmpty: {
                        message: 'Please input last middle'
                    }
                }
            },

            lastName: {
                validators: {
                     stringLength: {
                       // min: 2,
                    },
                    notEmpty: {
                        message: 'Please input last name'
                    }
                }
            },
              civilStatus: {
                validators: {
                     stringLength: {
                        //min: 2,
                    },
                    notEmpty: {
                        message: 'Please select Civil Status'
                    }
                }
            },
          
            homeAddress: {
                validators: {
                     stringLength: {
                        //min: 2,
                    },
                    notEmpty: {
                        message: 'Please input address'
                    }
                }
            },
           currentAddress: {
                validators: {
                     stringLength: {
                        //min: 2,
                    },
                    notEmpty: {
                        message: 'Please input currentAddress'
                    }
                }
            },
            contactNum: {
                validators: {

                     stringLength: {
                        //min: 11,
                        max: 11,
                   message: ' Enter 11 characters long, between 0-9'
                    },
                    notEmpty: {
                       message: 'Please input contactNum'
                    }
                }
            },

            contactNum2: {
                validators: {

                     stringLength: {
                        //min: 11,
                        max: 11,
                         message: ' Enter 11 characters long, between 0-9'
                    }
                }
            },
            

             emailAdd: {
                validators: {
                    notEmpty: {
                        message: 'Please input email address'
                    },
                    emailAddress: {
                        message: 'Please input a valid email address'
                    }
                }
            },
            }
        })
        
});

