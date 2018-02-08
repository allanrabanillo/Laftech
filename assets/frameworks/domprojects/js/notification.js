 $(document).ready(function() {

     if (Notification.permission !== "granted")
         Notification.requestPermission();
     else {
         $.ajax({
             url: "./../dashboard/critical",
             type: "GET",
             success: function(data, textStatus, jqXHR) {
                 var data = jQuery.parseJSON(data);
                 if (data.result == true) {

                     var notifikasi = new Notification('Critical Parts', {
                         icon: './../../upload/avatar/icon2.png',
                         body: 'Click here to view the Critical Parts.',
                     });
                     notifikasi.onclick = function() {
                         window.open('./../stocks/critical');
                         notifikasi.close();
                     };
                     setTimeout(function() {
                         notifikasi.close();
                     }, 10000);
                 }
             },
             error: function(jqXHR, textStatus, errorThrown) {

             }
         });

     }


     if (Notification.permission !== "granted")
         Notification.requestPermission();
     else {
         $.ajax({
             url: "./../dashboard/outofstock",
             type: "GET",
             success: function(data, textStatus, jqXHR) {
                 var data = jQuery.parseJSON(data);
                 if (data.result == true) {

                     var notifikasi1 = new Notification('Out of Stock', {
                         icon: './../../upload/avatar/icon2.png',
                         body: 'Click here to view the Out of Stock Parts.',
                     });
                     notifikasi1.onclick = function() {
                         window.open('./../stocks/outofstock');
                         notifikasi1.close();
                     };
                     setTimeout(function() {
                         notifikasi1.close();
                     }, 10000);
                 }
             },
             error: function(jqXHR, textStatus, errorThrown) {

             }
         });

     }
 });