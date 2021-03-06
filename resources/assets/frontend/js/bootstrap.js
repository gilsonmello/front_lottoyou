window._ = require("lodash");
window.Popper = require("popper.js").default;
window.qs = require("qs");

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = require("jquery");

  require("bootstrap");

  window.moment = require("moment");

  require("./plugins/AppWscratchPad.js");

  require("jquery.inputmask/dist/jquery.inputmask.bundle.js");

  require("bootstrap-datepicker");
  require("bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css");
  window.toastr = require("toastr");
  require("jquery-maskmoney/dist/jquery.maskMoney.min.js");
  require("toastr/build/toastr.min.css");

  require("tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js");
  require("tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css");

  require("jquery-validation");
  require("jquery-validation/dist/additional-methods.js");

  $.validator.addMethod(
    "filesize",
    function(value, element, arg) {
      var minsize = 1000; // min 1kb
      if (element.files[0].size > minsize && element.files[0].size <= arg) {
        return true;
      } else {
        return false;
      }
    },
    "Arquivo muito grande"
  );
  //require('jquery-maskmoney/dist/jquery.maskMoney.min.js');

  // CommonJS
  window.swal = require("sweetalert2");

  window.VMasker = require("vanilla-masker");
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
} else {
  console.error(
    "CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token"
  );
}

function getParamsUrl() {
  var s1 = location.search.substring(1, location.search.length).split("&"),
    r = {},
    s2,
    i;
  for (i = 0; i < s1.length; i += 1) {
    s2 = s1[i].split("=");
    r[decodeURIComponent(s2[0]).toLowerCase()] = decodeURIComponent(s2[1]);
  }
  return r;
}

$("<img/>")
  .attr("src", "/img/load.gif")
  .on("load", function() {
    $(this).remove();
  });

/*window.addEventListener('storage', function(e) {
    if((event.key == "authUser") || (e.storageArea.length == 0 || e.newValue == null)) {
        tokenData = "";
        access_token = "";
        Cookies.remove('authUser');
        window.location.href = '/';
    }
});*/

//window.QueryString = getParamsUrl();

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
