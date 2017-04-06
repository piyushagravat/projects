$(function($) {

  $stateSelect = $("#state");
  $citySelect = $("#city");
  $countrySelect = $("#country");

  var isOnOpenCalled = false;

  $.mobileSelect.defaults = {

      title: 'Select from following or Search',
      padding: {'top': '0px', 'left': '0px', 'right': '0px', 'bottom': '0px' },
      animationSpeed: 0,
      animation: 'none',
      onOpen: function(){

          $("#blackoverlay").show();
          isOnOpenCalled = true;
          $(this).mobileSelect('refresh');
         $(".mobileSelect-title").html("<input type='text' class='select-search' placeholder='Search/Select' />");

         var $thisSelect = $(this);
         $(".select-search").on('keyup', function(){
           var findThis = $(this).val();
           var findThisLen = findThis.length;
           var isIndiaAlready = false;
           $('.list-container a.mobileSelect-control').each(function(){
             var thisText = $(this).text();
             var thisTextSub = thisText.substring(0, findThisLen);
             if(thisTextSub.toLowerCase() == findThis.toLowerCase()) {
               if(thisText.toLowerCase() == "india") {
                  if( ! isIndiaAlready) {
                    $(this).show();
                  } else { $(this).hide(); }
                  isIndiaAlready = true;
                }
               else {
                  $(this).show();
               }

             } else {
               $(this).hide();
             }
             if(thisText.trim() == "") { $(this).show(); }
           });
         });
      },
      onClose: function() {
        $("#blackoverlay").hide();
      }

    };

    function changeCity(state_id) {
      getAllCityByStateId(state_id, function(data){
        var tHtml = "<option value='Select City...'>Select City...</option>";
        var cList = data.data;
        for(var i=0; i<cList.length; i++) {
          tHtml += "<option data-id='" + cList[i].id + "' value='" + cList[i].name + "'>" + cList[i].name + "</option>";
        }

        $citySelect.html(tHtml);
        $citySelect.mobileSelect('refresh');
      });
    }

    function changeState(country_id) {
      getAllStateByCountryId(country_id, function(data){
        var tHtml = "<option value='Select State...'>Select State...</option>";
        var cList = data.data;
        for(var i=0; i<cList.length; i++) {
          tHtml += "<option data-id='" + cList[i].id + "' value='" + cList[i].name + "'>" + cList[i].name + "</option>";
        }

        $stateSelect.html(tHtml);
        $stateSelect.mobileSelect('refresh');
      });
    }

    getAllCountries(function(data){
        var tmpHTML = "";
        for(var i=0; i<data.data.length; i++) {
            tmpHTML += "<option data-id='" + data.data[i].id + "' value='" + data.data[i].country_name + "' >" +
              data.data[i].country_name + "</option>";
        }

        $("#country").html($("#country").html() + tmpHTML);
        $countrySelect.mobileSelect('refresh');
    });

    $countrySelect.mobileSelect({
      onClose: function(){
        $("#blackoverlay").hide();
        if(isOnOpenCalled) {
          changeState($(this).find(':selected').data('id'));
          isOnOpenCalled = false;
        }
      }
    });

    $stateSelect.mobileSelect({
      onClose: function(){
        $("#blackoverlay").hide();
        if(isOnOpenCalled) {
          changeCity($(this).find(':selected').data('id'));
          isOnOpenCalled = false;
        }
      }
    });

    $citySelect.mobileSelect();




});
