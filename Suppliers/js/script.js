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
            companyName: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                         message: 'Please input company name'
                    }
                }
            },
            address: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please input address'
                    }
                }
            },

            telephoneNum: {
                validators: {

                     stringLength: {
                        min: 10,
                         max: 10,
                    }
                }
            },
            mobileNum: {
                validators: {
                     stringLength: {
                         min: 11,
                         max: 11,
                    }
                }
            },
             salesRepresentative: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please input fullname'
                    }
                }
            },

            accountName: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please input account name'
                    }
                }
            },
              srContactNum: {
                validators: {
                     stringLength: {
                        min: 11,
                        max: 11,

                    }
                }
            },
           emailAdd: {
                validators: {
                    notEmpty: {
                        message: 'Please input supplier email address'
                    },
                    emailAddress: {
                        message: 'Please input a valid email address'
                    }
                }
            },

             bankName: {
                validators: {
                     stringLength: {
                    },
                    notEmpty: {
                        message: 'Please prefered bank'
                    }
                }
            },
            
           accountNum: {
                validators: {
                     stringLength: {
                        min: 10,
                        max: 10,
                    },
                    notEmpty: {
                        message: 'Please supply your currentAddress'
                    }
                }
            },

            consignor: {
                validators: {
                     stringLength: {
                    },
                    notEmpty: {
                        message: 'Please Choose'
                    }
                }
            }
            
            
            }
        })
        
});

