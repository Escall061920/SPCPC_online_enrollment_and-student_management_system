 <!-- Map Column -->
            <div class="col-md-6" style="background-color: #098744; color: white; padding: 20px; border-radius: 8px;">
 School Location
                <!-- Embedded Google Map -->
                <!-- <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed/v1/place?q=green%20valley%20%20General%20Paulino%20Santos%20Drive%2C%20Koronadal%20City%2C%209506%20South%20Cotabato%2C%20Philippines"></iframe> -->
           <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
           <div style="overflow:hidden;height:400px;width:100%;"><div id="gmap_canvas" style="height:100%;width:400px;">
           <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
           <a class="google-map-code" href="http://www.map-embed.com" id="get-map-data">embed google map</a>
           </div>
           <script type="text/javascript">
            function init_map() {
    var myOptions = {
        zoom: 19,
        center: new google.maps.LatLng(14.356540, 121.056370),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
    
    marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(14.356540, 121.056370)
    });
    
    infowindow = new google.maps.InfoWindow({
        content: "<div style='color: black;'><b>San Pedro City Polytechnic College</b><br/>(formerly San Pedro Technological Institute),<br/>Crismor Ave, Elvinda, Laguna<br/>4023 Philippines</div>"
    });
    
    google.maps.event.addListener(marker, "click", function() {
        infowindow.open(map, marker);
    });
    
    infowindow.open(map, marker);
}

google.maps.event.addDomListener(window, 'load', init_map);
</script>
</div>
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h3>Contact Details</h3>
                <p>
                  
                <br><b>San Pedro City Polytechnic College </b>(formerly San Pedro Technological Institute), Crismor Ave, Elvinda, Laguna<br>
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone"><b>P</b></abbr>: (02) 87777-352</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email"><b>Email</b></abbr>: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=spcpc2017ph@gmail.com">spcpc2017ph@gmail.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Hours"></abbr>: <b>Monday - Friday: 9:00 AM to 5:00 PM</b></p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="https://www.facebook.com/spcpcofficial"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    
                    <li>
                        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=spcpc2017ph@gmail.com"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>

 