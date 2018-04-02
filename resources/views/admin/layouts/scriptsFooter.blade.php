<script src="{{ asset('admin/myjs/jquery.min.js') }}"></script>

<script src="{{ asset('admin/myjs/bootstrap.min.js') }}"></script>

<script src="{{ asset('admin/myjs/jasny-bootstrap.min.js') }}"></script>

<script src="{{ asset('admin/myjs/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/myjs/jquery.slimscroll.js') }}"></script>

<script src="{{ asset('admin/myjs/toast-data.js') }}"></script>

<script src="{{ asset('admin/myjs/moment.min.js') }}"></script>
<script src="{{ asset('admin/myjs/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('admin/myjs/simpleweather-data.js') }}"></script>

<script src="{{ asset('admin/myjs/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('admin/myjs/jquery.counterup.min.js') }}"></script>

<script src="{{ asset('admin/myjs/dropdown-bootstrap-extended.js') }}"></script>

<script src="{{ asset('admin/myjs/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('admin/myjs/jquery.easypiechart.min.js') }}"></script>

<script src="{{ asset('admin/myjs/owl.carousel.min.js') }}"></script>

<script src="{{ asset('admin/myjs/Chart.min.js') }}"></script>

<script src="{{ asset('admin/myjs/raphael.min.js') }}"></script>
<script src="{{ asset('admin/myjs/morris.min.js') }}"></script>
<script src="{{ asset('admin/myjs/jquery.toast.min.js') }}"></script>

<script src="{{ asset('admin/myjs/switchery.min.js') }}"></script>  
<script src="{{ asset('admin/myjs/jquery.matchHeight.js') }}" type="text/javascript"></script>

<script src="{{ asset('admin/myjs/init.js?d=555') }}"></script>
<script src="{{ asset('admin/myjs/dashboard-data.js') }}"></script>


<!-- alertify js -->
<!-- <script src="//cdn.jsdelivr.net/alertifyjs/1.10.0/alertify.min.js"></script> -->
<!-- end alertify js -->


<script>
  $(function(){
    
    'use strict'

    if ($(".equalheight").length) {
      $('.equalheight').matchHeight();
    }

    if ($(".digitsOnly").length) {
      /*numbers only text fields*/
      $(".digitsOnly").keydown(function (e) {
          // Allow: backspace, delete, tab, escape, enter and .
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
               // let it happen, don't do anything
               return;
          }
          // Ensure that it is a number and stop the keypress
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
          }
      });
    }

  });

  //fetch data
  function loadRxdata (url, params) {
      return $.ajaxAsObservable({
          url: url,
          dataType: 'json',
          data: params
      });
  }

  //start fetch select box data
    function fetchSelectData(url, method, params, loader_div, data_div){
      load_overlay(loader_div);
      $.ajax({
        url: url,
        type: method,
        data: params,
        dataType: "json",
        success: function(data) {
          console.log(data);
          $(data_div).html("<option>Please Select</option>");
          hide_overlay(loader_div);
          if (data.data.length > 0){
              $.each(data.data, function(index, item){
                var row = "<option value=" + item.id + ">" + item.name + "</option>";
                $(data_div).append(row);
              });            
          } else {
              $(data_div).html("<option>No data found</option>");
          }
        }
      });     
    }
    //end fetch select box data

    function load_overlay(overlay_container)
      {
        if (overlay_container)
        {
          $(overlay_container).LoadingOverlay("show", {
            image       : "/admin/images/loader.gif"
          }); 
        } else {
          $.LoadingOverlay("show", {
            image       : "/admin/images/loader.gif"
          });   
        }
      }

    function hide_overlay(overlay_container)
    {
      if (overlay_container)
      {
        $(overlay_container).LoadingOverlay("hide"); 
      } else {
        $.LoadingOverlay("hide");   
      }
    }
    
</script>
