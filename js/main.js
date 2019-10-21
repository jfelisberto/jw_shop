/* start variables */
var alertTO, checkTO, signInviteTO, errorFieldFocus, validate;
var cadLocal, saveListBtn, prefix, fieldID, text = '';
var exitAfterSave, newAfterSave, returnSave, parameters = false;

/* initialize the map if we have one * ' + $(this).attr('data-prefix') + '*/
if ($('#mapArea').length > 0) {
  //do we have a venue or anything else?
  /*
  *if ($('#addressEditFld_latitude').length > 0) {
  * map_fieldsPrefix = 'addressEditFld_';
  *}
  */
  mapInit($('#' + map_fieldsPrefix + 'latitude').val(), $('#' + map_fieldsPrefix + 'longitude').val());
  $('#' + map_fieldsPrefix + 'address, #cityLocation, #' + map_fieldsPrefix + 'address_num, #' + map_fieldsPrefix + 'postcode').on('blur', function() {
    if ($('#' + map_fieldsPrefix + 'address').val() != '' && $('#cityLocation').val() != '') {
      //var addressString = ;
      mapSearchAddress($('#' + map_fieldsPrefix + 'address_num').val() + ' ' + $('#' + map_fieldsPrefix + 'address').val() + ', ' + $('#cityLocation').val());
    }
  });
}

function abortDTAjax() {
  if (typeof $ !== "undefined" && $.fn.dataTable) {
    var all_settings = $($.fn.dataTable.tables()).DataTable().settings();
    for (var i = 0, settings; (settings = all_settings[i]); ++i) {
      if (settings.jqXHR)
      settings.jqXHR.abort();
    }
  }
}

// Exibe mensagens na tela ao inves da janela alert
const swalBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success btn-js',
    cancelButton: 'btn btn-danger btn-js'
  },
  buttonsStyling: false,
});

function sa(type, title, text, timer, callbackFunction, callbackParams, showButton) {
  swalBootstrapButtons.fire({
    'position': 'top-right',
    'type': type,
    'title': title,
    'text': text,
    'showConfirmButton': showButton,
    'timer': timer
  }).then(function(result) {
    if ((typeof(callbackFunction) == 'string') && (typeof(window[callbackFunction]) == 'function')) {
      window[callbackFunction](callbackParams, result);
    }
  });
}

function sad(title, text, type, confirmButtonText, cancelButtonText, callbackFunction, callbackParams) {
  swalBootstrapButtons.fire({
    'title': title,
    'text': text,
    'type': type,
    'showCancelButton': true,
    'confirmButtonText': confirmButtonText,
    'cancelButtonText':cancelButtonText,
    'reverseButtons': false
  }).then(function(result) {
    if (result.value) {
      if (callbackFunction === 'sendForm') {
        window[callbackFunction](callbackParams[0], callbackParams[1], callbackParams[2], callbackParams[3], callbackParams[4]);
      }
    } else if (result.dismiss === Swal.DismissReason.cancel) {
    }
  });
}

function sendForm(form, path, target, allertSuccess, allertError, validateForm) {
  form = $.trim(form);
  path = $.trim(path);

  $('.saveButtons button').addClass('disabled').addClass('working').attr('disabled', 'disabled');

  if ((form !== undefined && path !== undefined) && (form !== '' && path !== '') && (form !== null && path !== null)) {
    if (validateForm) {
      validate = validate_form(form);
    } else {
      validate = true;
    }

    if (validate == true) {
      var formData = new FormData($(form)[0]);
      $.ajax({
        url: basePath + path,
        type: 'POST',
        typeData: 'json',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
          if (data.status === 'success') {
            $('#formTitle').html(data.newTitle);
            document.title = data.pageTitle;
            if (exitAfterSave) {
              //document.location.href=basePath + listURL;
              console.log('exitAfterSave: '+exitAfterSave);
            }
            if (newAfterSave) {
              //document.location.href=basePath + newURL;
              console.log('newAfterSave: '+newAfterSave);
            }
            //succesReturn(target, data);
            if (allertSuccess) {
              sa('success', translate.titles_success, data.message, 2000, 'succesReturn', [target, data]);
            } else {
              succesReturn([target, data]);
            }
          } else {
            if (data.status === 'error' && data.warning === true) {
              sa('warning', translate.titles_warning, data.message, 2000, 'errorReturn', [target, data]);
            } else if (data.status === 'error') {
              sa('error', translate.titles_error, data.message, 2000, 'errorReturn', [target, data]);
            } else {
              sa('error', translate.titles_error, translate.global_neterror, 3500);
            }
          }
        },
        error: function(data) {
          sa('error', translate.titles_error, translate.save_error, 3500);
        }
      }).fail(function() {
        sa('error', translate.titles_error, translate.global_neterror, 3500);
      });
    } else {
      sa('error', translate.titles_error, 'Todos os campos devem ser preenchidos', 2000);
    }
  } else {
    sa('error', translate.titles_error, translate.global_neterror, 3500);
  }

  setTimeout(function() {
    $('.saveButtons button').removeClass('working').removeClass('disabled').removeAttr('disabled');
  }, 4000);
}

function validate_form(form) {
  var result = new Array();
  var i=0;
  var itemID, content, returned;

  if ($('input').hasClass('validate')) {
    $('.validate').each(function() {
      itemID = $(this).attr('id');
      content = $.trim($('#' + itemID).val());
      $(form).addClass('was-validated');
      if (content === '' || content === null) {
        result[i] = false;
      } else {
        result[i] = true;
      }
      i++;
    });

    $.each(result, function(i, e) {
      if (e == false) {
        returned = false;
      }
      if (returned != false) {
        returned = true;
      }
    });
  } else {
    returned = true;
  }

  return returned;
}

function succesReturn(params, sweetReturn) {
  target = params[0];
  parameters = params[1];
  console.log(target);
  console.log(parameters);
  console.log(sweetReturn);

  switch (target) {
    case 'singup':
      $('#nsReturn').html(parameters.messageLink);
      break;
    case 'login':
      setTimeout(function() {
        document.location.href = parameters.goto;
      }, 1200);
      break;
    case 'resendPassword':
      console.log('succes sendNewLink');
      break;
    case 'recoverPassword':
      document.location.href=parameters.url.replace('/login', '');
      break;
    case 'exibeProdutos':
      $('#exibeProdutos').html(parameters.data);
      break;
    case 'aviseMe':
      $('#userName').val('');
      $('#userMail').val('');
      $('#aviseMe').removeClass('was-validated');
      break;
    default:
      return false;
      break;
  }
}

function errorReturn(params, sweetReturn) {
  target = params[0];
  parameters = params[1];
  console.log(target);
  console.log(parameters);
  console.log(sweetReturn);

  switch (target) {
    case 'singup':
      $('#nsReturn').html(parameters.messageLink);
      break;
    case 'login':
      $('.card-footer').removeClass('hidden');
      $('#jsReturn').html(parameters.messageLink);
      break;
    case 'resendPassword':
      console.log('erro sendNewLink');
      break;
    case 'recoverPassword':
      if (parameters.shakeField == 'resendPassword') {
        $('#formPwdRecovery').addClass('hidden');
        $('#formSendRecovery').removeClass('hidden');
      } else {
        $(parameters).focus();
      }
      break;
    default:
      $(parameters).focus();
      return false;
      break;
  }
}

$(document).ready(function() {

  /**** start plugins ****/
  /* Bootstrap Switch */
  //$(".lock").bootstrapSwitch('size', 'mini');
  $(window).scroll(function() {
    if($(this).scrollTop() != 0) {
      $('#toTop').fadeIn();
    } else {
      $('#toTop').fadeOut();
    }
  });

  $('#toTop').click(function() {
    $('body,html').animate({
      scrollTop:0
    },800);
  });

  $(document).on('click', '.abortDT', function(e) {
    e.preventDefault();
    abortDTAjax();
  });

  $('.price').maskMoney({
    prefix: currencyPrefix + ' ',
    thousands: currencyThousands,
    decimal: currencyDecimal,
    //precision: currencyPrecision,
    allowNegative: currencyNegative
  });


  /** Bloqueando o ENTER nos formularios **/
  $('.no_enter').keypress(function(e) {
    if (e.which == 13 || e.keyCode == 13) {
      return false;
    }
  });

  /**
  * login user site
  **/
  var signInviteTO = 0;
  $(document).on('click', '.openLogIn', function() {
    $('#recruitModal').modal('show');
    clearTimeout(signInviteTO);
  });

  $(document).on('change', '#userLogin', function() {
    $('#password').val($('#userLogin option:selected').attr('data-pwd'));
  });

  $(document).on('click', '#doLogin', function() {
    target = null;
    if ($('#user').val() === '' || $('#user').val() === null) {
      sa('error', translate.titles_error, 'Digite seu nome de usuário.', 2000, 'errorReturn', [target, '#user']);
      return false;
    }
    if ($('#password').val() === '' || $('#password').val() === null) {
      sa('error', translate.titles_error, 'Digite sua senha.', 2000, 'errorReturn', [target, '#password']);
      return false;
    }
    sendForm('#' + $(this).attr('data-form'), 'takeLogin', 'login');
  });

  $(document).on('click', '.searchProduto', function() {
    id = $(this).attr('data-id');
    $('#subCategoria .nav-link').removeClass('active');
    $('#navLinkID' + id).addClass('active');
    $('#tagID').val(id);
    $('#masterID').val($(this).attr('data-parent'));
    $('#tagNormalName').val($(this).attr('data-nname'));

    //sendForm('#searchProduto', 'produtos', 'exibeProdutos');
  });

  $(document).on('click', '#aviseMeBtn', function() {
    sendForm('#aviseMe', 'sendmail/', 'aviseMe', true, null, true);
  });

  $(document).on('click', '#addCartBtn', function() {
    if (validate_form('#addCartForm')) {
      $('#addCartForm').removeClass('was-validated');
      $('#addCartForm').submit();
    } else {
      sa('error', translate.titles_error, 'Informe a quantidade do produto.', 2000);
    }
  });
});
