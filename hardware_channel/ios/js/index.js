/* GLOBALS -------------------------------------------------------- */
(function () {

    if (window.MSApp && MSApp.execUnsafeLocalFunction) {

        // Some nodes will have an "attributes" property which shadows the Node.prototype.attributes property
        //  and means we don't actually see the attributes of the Node (interestingly the VS debug console
        //  appears to suffer from the same issue).
        //
        var Element_setAttribute = Object.getOwnPropertyDescriptor(Element.prototype, "setAttribute").value;
        var Element_removeAttribute = Object.getOwnPropertyDescriptor(Element.prototype, "removeAttribute").value;
        var HTMLElement_insertAdjacentHTMLPropertyDescriptor = Object.getOwnPropertyDescriptor(HTMLElement.prototype, "insertAdjacentHTML");
        var Node_get_attributes = Object.getOwnPropertyDescriptor(Node.prototype, "attributes").get;
        var Node_get_childNodes = Object.getOwnPropertyDescriptor(Node.prototype, "childNodes").get;
        var detectionDiv = document.createElement("div");

        function getAttributes(element) {
            return Node_get_attributes.call(element);
        }

        function setAttribute(element, attribute, value) {
            try {
                Element_setAttribute.call(element, attribute, value);
            } catch (e) {
                // ignore
            }
        }

        function removeAttribute(element, attribute) {
            Element_removeAttribute.call(element, attribute);
        }

        function childNodes(element) {
            return Node_get_childNodes.call(element);
        }

        function empty(element) {
            while (element.childNodes.length) {
                element.removeChild(element.lastChild);
            }
        }

        function insertAdjacentHTML(element, position, html) {
            HTMLElement_insertAdjacentHTMLPropertyDescriptor.value.call(element, position, html);
        }

        function inUnsafeMode() {
            var isUnsafe = true;
            try {
                detectionDiv.innerHTML = "<test/>";
            }
            catch (ex) {
                isUnsafe = false;
            }

            return isUnsafe;
        }

        function cleanse(html, targetElement) {
            var cleaner = document.implementation.createHTMLDocument("cleaner");
            empty(cleaner.documentElement);
            MSApp.execUnsafeLocalFunction(function () {
                insertAdjacentHTML(cleaner.documentElement, "afterbegin", html);
            });

            var scripts = cleaner.documentElement.querySelectorAll("script");
            Array.prototype.forEach.call(scripts, function (script) {
                switch (script.type.toLowerCase()) {
                    case "":
                        script.type = "text/inert";
                        break;
                    case "text/javascript":
                    case "text/ecmascript":
                    case "text/x-javascript":
                    case "text/jscript":
                    case "text/livescript":
                    case "text/javascript1.1":
                    case "text/javascript1.2":
                    case "text/javascript1.3":
                        script.type = "text/inert-" + script.type.slice("text/".length);
                        break;
                    case "application/javascript":
                    case "application/ecmascript":
                    case "application/x-javascript":
                        script.type = "application/inert-" + script.type.slice("application/".length);
                        break;

                    default:
                        break;
                }
            });

            function cleanseAttributes(element) {
                var attributes = getAttributes(element);
                if (attributes && attributes.length) {
                    // because the attributes collection is live it is simpler to queue up the renames
                    var events;
                    for (var i = 0, len = attributes.length; i < len; i++) {
                        var attribute = attributes[i];
                        var name = attribute.name;
                        if ((name[0] === "o" || name[0] === "O") &&
                            (name[1] === "n" || name[1] === "N")) {
                            events = events || [];
                            events.push({ name: attribute.name, value: attribute.value });
                        }
                    }
                    if (events) {
                        for (var i = 0, len = events.length; i < len; i++) {
                            var attribute = events[i];
                            removeAttribute(element, attribute.name);
                            setAttribute(element, "x-" + attribute.name, attribute.value);
                        }
                    }
                }
                var children = childNodes(element);
                for (var i = 0, len = children.length; i < len; i++) {
                    cleanseAttributes(children[i]);
                }
            }
            cleanseAttributes(cleaner.documentElement);

            var cleanedNodes = [];

            if (targetElement.tagName === 'HTML') {
                cleanedNodes = Array.prototype.slice.call(document.adoptNode(cleaner.documentElement).childNodes);
            } else {
                if (cleaner.head) {
                    cleanedNodes = cleanedNodes.concat(Array.prototype.slice.call(document.adoptNode(cleaner.head).childNodes));
                }
                if (cleaner.body) {
                    cleanedNodes = cleanedNodes.concat(Array.prototype.slice.call(document.adoptNode(cleaner.body).childNodes));
                }
            }

            return cleanedNodes;
        }

        function cleansePropertySetter(property, setter) {
            var propertyDescriptor = Object.getOwnPropertyDescriptor(HTMLElement.prototype, property);
            var originalSetter = propertyDescriptor.set;
            Object.defineProperty(HTMLElement.prototype, property, {
                get: propertyDescriptor.get,
                set: function (value) {
                    if(window.WinJS && window.WinJS._execUnsafe && inUnsafeMode()) {
                        originalSetter.call(this, value);
                    } else {
                        var that = this;
                        var nodes = cleanse(value, that);
                        MSApp.execUnsafeLocalFunction(function () {
                            setter(propertyDescriptor, that, nodes);
                        });
                    }
                },
                enumerable: propertyDescriptor.enumerable,
                configurable: propertyDescriptor.configurable,
            });
        }
        cleansePropertySetter("innerHTML", function (propertyDescriptor, target, elements) {
            empty(target);
            for (var i = 0, len = elements.length; i < len; i++) {
                target.appendChild(elements[i]);
            }
        });
        cleansePropertySetter("outerHTML", function (propertyDescriptor, target, elements) {
            for (var i = 0, len = elements.length; i < len; i++) {
                target.insertAdjacentElement("afterend", elements[i]);
            }
            target.parentNode.removeChild(target);
        });

    }

}());
// // FastClick.attach(document.body);


	// newly added in browser
	function getUrlParam( name, url ) {
	  if (!url) url = location.href;
	  name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	  var regexS = "[\\?&]"+name+"=([^&#]*)";
	  var regex = new RegExp( regexS );
	  var results = regex.exec( url );
	  return results == null ? null : results[1];
	}

  var alertP = function(msg) {
    alert(msg);
  }

document.addEventListener("deviceready", function(){
  ParsePushPlugin.on('openPN', function(pn){
      window.location = "whats_new.html";
  });



  if(device.platform == "iOS") {
      $(document).on('blur', 'input, textarea', function() {
        setTimeout(function() {
            $("#footer").show();
            $("#header").show();
        }, 0);
      });

      $(document).on('focus', 'input, textarea', function() {
        setTimeout(function() {
            $("#footer").hide();
            $("#header").hide();
        }, 0);
      });
  }

}, false);

var NETWORK_ERROR_MSG = "Please check your network connection";

var API_BASE = "http://headwaytechnologies.in/hardwareapi";
var LOGIN_ENDPOINT = "login"; // e.g. "login/admin@admin.com/admin"
var CATEOGRY_LIST_1_ENDPOINT = "/get_cat_level1_list";  // e.g. "/get_cat_level1_name"
var CATEOGRY_LIST_2_ENDPOINT = "/get_cat_level2_list";  // e.g. "/get_cat_level2_list/1"
var CATEOGRY_LIST_3_ENDPOINT = "/get_cat_level3_name";  // e.g. "/get_cat_level3_name/1"
var ADVERTISE_ENDPOINT = "/advertisement";
var REGISTER_ENDPOINT = "/add_manufracturer";
var GET_PRODUCT_BY_CAT_ENDPOINT = "/search_products";
var GET_PRODCUT_BY_SEARCH_ENDPOINT = "/search_products_by_keywords_list";
var INQUIRY_ENDPOINT = "/add_inquiry";
var ADD_DEALER_ENDPOINT = "/add_dealer";
var GET_PRODUCT_BY_ID_ENDPOINT = "/products_by_id";
var GET_PRODUCT_OTHER_IMAGES_ENDPOINT = "/products_images_list";
var GET_PRODUCT_BY_WHATS_NEW_ENDPOINT = "/whats_new_products";
var GET_WHATS_NEW_PRODUCT_DETAILS_ENDPOINT = "/whats_new_products_by_id";
var GET_WHATS_NEW_EVENTS_ENDPOINT = "/whats_new_events";
var GET_WHATS_NEW_EVENT_DETAILS_ENDPOINT = "/whats_new_events_by_id";
var ADD_PRODUCT_ENDPOINT = "/add_product";
var ADD_PRODUCT_IMAGES_ENDPOINT = "/add_product_images";
var EDIT_PRODUCT_ENDPOINT = "/update_product_by_id";
var DELETE_PRODUCT_BY_ID_ENDPOINT = "/delete_product_by_id";
var DELETE_PRODUCT_IMAGE_BY_ID_ENDPOINT = "/delete_prod_image";
var GET_PRODUCT_BY_MANF_ENDPOINT = "/products_by_manf_id";
var GET_BRANDS_BY_MANF_ID = "/get_brands_by_Manfid";
var SEND_NOTITICATION_ENDPOINT = "/send_notification_to_admin"


var IMAGE_BASE_URL_PRODUCTS = "http://headwaytechnologies.in/images/products/";
var IMAGE_BASE_URL_ADS = "http://headwaytechnologies.in/images/ads/";
var PDF_FILE_URL = "http://headwaytechnologies.in/doc/";

var LAST_INQUIRY_TYPE_ADS = "advertise";
var LAST_INQUIRY_TYPE_PRODUCT = "product";
var LAST_INQUIRY_TYPE_PRODUCT_WHATS_NEW = "Whatsnew";
var LAST_INQUIRY_TYPE_PRODUCT_MANUFACTURER = "man_inquery";
var LAST_INQUIRY_TYPE_DEALER = "dealer";
var LAST_PRODUCT_ID_EDIT = "last_product_id_edit";
var IS_LAST_ONLY_2_CATEGORY = "is_last_only_2_category";

var LAST_MANUFACTURER_ID = "last_manufacturer_id";

var LAST_LVL2_CAT_ID = "last_lvl2_cat_id";
var LAST_LVL3_CAT_ID = "last_lvl3_cat_id";


// document ready
$(function($){



  $('img').on('error', function(){
      $(this).attr('src', './img/no_image_found.png');
  });

  //Gloabal Ajax Complete
  $("body").bind("ajaxSend", function(e, xhr, settings){
     //Sent
  }).bind("ajaxComplete", function(e, xhr, settings){
     //Complete
     $('img').on('error', function(){
         $(this).attr('src', './img/no_image_found.png');
     });
  }).bind("ajaxError", function(e, xhr, settings, thrownError){
      //Error
  });

  // to homepage
  $("#header-logo-text").on('click', function(e){
    // window.location = "home.html";
  });
  $("#header-logo").on('click', function(e){
    // window.location = "home.html";
     window.history.back();
  });

  // try again
  $("#try-again").on('click', function(e){
    window.location.reload();
  });

  // to login
  $("#userIcon").on('click', function(e){
      if(getUserId() > 0) {
        window.location = "manufacturer_dashboard.html";
      } else {
        window.location = "singin_or_register.html";
      }
  });

  // to whats-new footer-notification
  $("#footer-notification").on('click', function(e){
      window.location = "whats_new.html";
  });

  // to what's new events
  $("#footer-events").on('click', function(e){
      window.location = "whats_new_events.html";
  });

  // to advertise
  $("#adIcon").on('click', function(e){
      window.location = "advertise.html";
  });



  // to grid products
  $("#footer-grid").on('click', function(e){
    if(window.localStorage.getItem('isgrid') == "no") {
      window.localStorage.setItem('isgrid', "yes");
      $(this).attr('src', "img/ic_action_navigation_apps.png");
      console.log(window.localStorage.getItem('isgrid'))
      window.location = "home.html";
    } else {
      window.localStorage.setItem('isgrid', "no");
      $(this).attr('src', "img/footer_list.png");
      window.location = "home.html";
    }
  });

  // to search
  $("#footer-search").on('click', function(e){
      window.location = "search.html";
  });

});



/* FUNCTIONS ------------------------------------------------------ */


var $errorDiv = $(".error-wrapper-screen");
var $dataErrorDiv = $(".error-wrapper-screen #error-data-div");
var $noConnectionErrorDiv = $(".error-wrapper-screen #error-no-connection-div");

Array.prototype.contains = function ( needle ) {
   for (i in this) {
       if (this[i] == needle) return true;
   }
   return false;
}

var inform = function(text) {
  alertP(text);
}

function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

function getRandomFileName()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 8; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

// Handlebars.registerHelper("toDDMMYYYY", function(tmpDate) {
//     var tmpY = tmpDate.substring(0,4);
//     var tmpM = tmpDate.substring(5,7);
//     var tmpD = tmpDate.substring(8,10);
//
//     return "" + tmpD + "-" + tmpM + "-" + tmpY;
// });

function isValidPhoneNo(no) {
  if(isNaN(no) == false &&
      (parseInt(no) >= 1000000000 && parseInt(no) <= 9999999999) ) {
    return true;
  }

  return false;
}

function isValidEmail(email) {
  if(email.match('[.]') != null && email.match('[@]') != null) {
    return true;
  }

  return false;
}

function showError(msg) {
  var $error = $("#error");
  window.scrollTo(0, 0);
  $error.text(msg);
  $error.show();
}

function showDataError() {
    $errorDiv.show();
    $dataErrorDiv.show();
}

function showConnectionError() {
    $errorDiv.show();
    $noConnectionErrorDiv.show();
}

function hideError() {
  var $error = $("#error");
  $error.hide();
}

function hideBigLoader() {
  var $bigLoader = $(".center-spinner-wrapper");
  $bigLoader.hide();
}

function showBigLoader() {
  var $bigLoader = $(".center-spinner-wrapper");
  $bigLoader.show();
}

function getFileExtenstion(filename) {
    return filename.substr(filename.lastIndexOf('.') + 1);
}

// Attach Events Here when page loads
// Zepto(function($){
//     var $tryAgainButton = $("#try-again");
//     $tryAgainButton.on('click', function(e){
//         window.location = window.location;
//     });
// });
//
/*
data.data.id,
data.data.role,
data.data.email,
data.data.company_name,
data.data.first_name,
data.data.last_name,
data.data.profile_img,
data.data.brochure_img,
data.data.contact
*/
function saveLoginData(id, role, email, company_name, first_name
      , last_name, profile_img, brochure_img, contact) {
  window.localStorage.setItem('user_id', id);
  window.localStorage.setItem('user_role', role);
  window.localStorage.setItem('user_email', email);
  window.localStorage.setItem('user_companyname', company_name);
  window.localStorage.setItem('user_first_name', first_name);
  window.localStorage.setItem('user_last_name', last_name);
  window.localStorage.setItem('user_profileimg', profile_img);
  window.localStorage.setItem('user_brochure_img', brochure_img);
  window.localStorage.setItem('user_contact', contact);

}

function getUserId() {
  // return window.localStorage.getItem("user_id");
  var userID = getUrlParam("user_id");
  alert(userID)
  return userID;
}

function getUserRole() {
  return window.localStorage.getItem("user_role");
}

function getUserEmail() {
  return window.localStorage.getItem("user_email");
}

function getUserCompany() {
  return window.localStorage.getItem("user_companyname");
}

function getUserFirstName() {
  return window.localStorage.getItem("user_first_name");
}

function getUserLastName() {
  return window.localStorage.getItem("user_last_name");
}

function getUserProfileImg() {
  return window.localStorage.getItem("user_profileimg");
}

function getUserBroImg() {
  return window.localStorage.getItem("user_brochure_img");
}

function getUserContact() {
  return window.localStorage.getItem("user_contact");
}

// for manufacturer page
var LAST_MAN_PAGE_ID = "last_man_page_id";


var LAST_PRODUCT_FROM_CATEGORY = "category";
var LAST_PRODUCT_FROM_SEARCH = "search";
var LAST_PRODUCT_FROM_MAN_ID = "from_man_id"
function setLastProductListData(fromm, datalastproduct) {
  // fromm: category,
  window.localStorage.setItem('last-product-list-from', fromm);
  window.localStorage.setItem('last-product-list-data', datalastproduct);
}

function getLastProductFrom() {
  return window.localStorage.getItem('last-product-list-from');
}

function getLastProductData() {
  return window.localStorage.getItem('last-product-list-data');
}

function getLastProductId() {
  return window.localStorage.getItem('last-product-id');
}

function getLastInquiryType() {
  return window.localStorage.getItem('last-inquiry-type');
}

function removeLoginData() {
  window.localStorage.clear();
}

function getUserId() {
  // return window.localStorage.getItem("user_id");
  var userID = getUrlParam("user_id");
  return userID;
}

function getDisplayName() {
  return window.localStorage.getItem('user_personename');
}

/* search history */
var SEARCH_HISTORY_PREFIX = "search_history_prefix_";
var SEARCH_HISTORY_INDEX_KEY = "search_history_index";
function addToSearchHistory(query) {
    sindex = window.localStorage.getItem(SEARCH_HISTORY_INDEX_KEY);
    if(sindex == null) { sindex = 1; }
    else { sindex = parseInt(sindex); }
    window.localStorage.setItem(SEARCH_HISTORY_PREFIX + sindex, query);
    sindex++;
    window.localStorage.setItem(SEARCH_HISTORY_INDEX_KEY, sindex);

}

function getAllSearchHistory() {
  var keyList = [];
  for (var i = 0; i < window.localStorage.length; i++){
      var key = window.localStorage.key(i);
      if(key.match(SEARCH_HISTORY_PREFIX)) {
          keyList.push(window.localStorage.getItem(key));
      }
  }
  console.log(keyList);
  return keyList;
}

function removeAllSearchHistory() {
  var keyList = [];
  for (var i = 0; i < window.localStorage.length; i++){
      var key = window.localStorage.key(i);
      if(key.match(SEARCH_HISTORY_PREFIX)) {
          keyList.push(key);
      }
  }

  for(var i=0; i<keyList.length; i++) {
      window.localStorage.removeItem(keyList[i]);
      console.log("Removed: " + keyList[i]);
  }
}

function removeHistoryOfThisWord(word) {
  for (var i = 0; i < window.localStorage.length; i++){
      var key = window.localStorage.key(i);
      if(key.match(SEARCH_HISTORY_PREFIX)) {
          var val = window.localStorage.getItem(key);
          if(val == word) {
              window.localStorage.removeItem(key);
              break;
          }
      }
  }
}

function getImageStoreString(ccl, catid) {
    return "cc_" + ccl + "_" + "cat_" + catid;
}

function randomBetween(min,max)
{
    return Math.floor(Math.random()*(max-min+1)+min);
}


//
function getSubSubCategoryProduct(cat, subcat, subsubcat, fn) {
   URL_API = API_BASE + GET_PRODUCT_BY_CAT_ENDPOINT;
   console.log("API_URL: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX: " + type);
     }
   });
}

function getProductByManfId(manId, fn) {
   URL_API = API_BASE + GET_PRODUCT_BY_MANF_ENDPOINT + "/" + manId;
   console.log("API_URL: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX: " + type);
     }
   });
}

function getProductBySubSubCategory(lastProductData, fn) {
   // URL_API = API_BASE + GET_PRODUCT_BY_CAT_ENDPOINT  + lastProductData;
   URL_API = API_BASE + '/get_manf_list_by_cat/'  + lastProductData;
   var isFrom2Cat = window.localStorage.getItem(IS_LAST_ONLY_2_CATEGORY)
   if(isFrom2Cat) {
       URL_API = API_BASE + '/get_manf_list_by_cat_subcat/' + getLastProductData();
   } else {
     URL_API = API_BASE + "/get_manf_list_by_cat/" + getLastProductData();
   }
   console.log("API_URL GET PRODUCT BY SUB SUB CATEGORY: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX GET PRODUCT BY SUB SUB CATEGORY: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX GET PRODUCT BY SUB SUB CATEGORY: " + type);
     }
   });
}

function getBrandsByManfId(manId, fn) {
   URL_API = API_BASE + GET_BRANDS_BY_MANF_ID  + "/" + manId;
   console.log("API_URL GET_BRANDS_BY_MANF_ID: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX: " + type);
     }
   });
}


function getDealearsCityByManId(manId, fn) {
   URL_API = API_BASE + "/get_dealers_city_by_manf_id"  + "/" + manId;
   console.log("API_URL getDealearsCityByManId: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX: " + type);
     }
   });
}

function getDealersByManId(manId, fn) {
   URL_API = API_BASE + "/dealers_by_manf_id"  + "/" + manId;
   console.log("API_URL getDealersByManId: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX: " + type);
     }
   });
}

function getManfDetailsByManfId(manId, fn) {
   URL_API = API_BASE + "/manf_details_by_id/" + manId;
   console.log("API_URL getManfDetailsByManfId: " + URL_API);
   $.ajax({
     type: 'GET',
     url: URL_API,
     data: { },
     dataType: 'json',
     timeout: 10000,
     context: $('body'),
     success: function(data) {
         console.log("Response via AJAX: ");
         console.log(data);
         fn(data);
     },
     error: function(xhr, type){
         console.log("Erro in AJAX: " + type);
     }
   });
}

function getProductDetailById(pid, fn) {
  URL_API = API_BASE + GET_PRODUCT_BY_ID_ENDPOINT + "/" + pid;
  console.log("API_URL getProductDetailById: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via AJAX: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX: " + type);
    }
  });
}

function deleteProductById(pid, fn) {
  URL_API = API_BASE + DELETE_PRODUCT_BY_ID_ENDPOINT + "/" + pid;
  console.log("API_URL deleteProductById: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via AJAX: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX: " + type);
    }
  });
}


function deleteProductImageById(pid, fn) {
  URL_API = API_BASE + DELETE_PRODUCT_IMAGE_BY_ID_ENDPOINT + "/" + pid;
  console.log("API_URL deleteProductImageById: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via AJAX: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX: " + type);
    }
  });
}

var NOTI_TYPE_BRANDS = "brands";
var NOTI_TYPE_PRODUCTS = "products";
var NOTI_TYPE_DEALERS = "dealers";
var NOTI_TYPE_EDIT_PROFILE = "edit-profile";
function sendNotification(type, fn) {
  URL_API = API_BASE + "/" + SEND_NOTITICATION_ENDPOINT + "/" + getUserId() + "/" + type;
    + "/" + type;
  console.log("API_URL sendNotification: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via AJAX: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX: " + type);
        fn(xhr);
    }
  });
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    url = url.toLowerCase(); // This is just to avoid case sensitiveness
    name = name.replace(/[\[\]]/g, "\\$&").toLowerCase();// This is just to avoid case sensitiveness for query parameter name
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


// Donwload File
var donwloadFileToDevice = function(url, filename, fn) {
  $("#download_percent").text("");
  var tmpDirLoc = cordova.file.externalRootDirectory;
  if(device.platform == "iOS") {
      tmpDirLoc = cordova.file.documentsDirectory;
  }
  resolveLocalFileSystemURL(tmpDirLoc, function(entry) {
    var deviceUrl = entry.toInternalURL() + "Hardware/" + filename;
    fileUrl = url;
    var fileTransfer = new FileTransfer();
    var uri = encodeURI(fileUrl);
    var $downloadPer = $("#download_percent");

    fileTransfer.onprogress = function(progressEvent) {
      if (progressEvent.lengthComputable) {
        var perc = Math.floor(progressEvent.loaded / progressEvent.total * 100);
        $downloadPer.text("Progress: " + perc + "%");
      }
    };

    fileTransfer.download(
        uri,
        deviceUrl,
        function(entry) {
            console.log("download complete: " + entry.toURL());
            fn(entry, null);
        },
        function(error) {
            console.log("download error source " + error.source);
            console.log("download error target " + error.target);
            console.log("upload error code" + error.code);
            fn(null, error);
        },
        true,
        { }
    );
  });

}



// country state cit API
function getAllCountries(fn) {
  URL_API = API_BASE + "/get_all_countries/";
  console.log("API_URL getAllCountries: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via getAllCountries: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX getAllCountries: " + type);
    }
  });
}

function getAllStateByCountryId(id, fn) {
  URL_API = API_BASE + "/get_state_by_country_id/" + id;
  console.log("API_URL getAllStateByCountryId: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via getAllStateByCountryId: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX getAllStateByCountryId: " + type);
    }
  });
}

function getAllCityByStateId(id, fn) {
  URL_API = API_BASE + "/get_city_by_state_id/" + id;
  console.log("API_URL getAllCityByStateId: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via getAllCityByStateId: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX getAllCityByStateId: " + type);
    }
  });
}

function getPageById(id, fn) {
  URL_API = API_BASE + "/get_page_by_id/" + id;
  console.log("API_URL getPageById: " + URL_API);
  $.ajax({
    type: 'GET',
    url: URL_API,
    data: { },
    dataType: 'json',
    timeout: 10000,
    context: $('body'),
    success: function(data) {
        console.log("Response via getPageById: ");
        console.log(data);
        fn(data);
    },
    error: function(xhr, type){
        console.log("Erro in AJAX getPageById: " + type);
        fn(null, type);
    }
  });
}
