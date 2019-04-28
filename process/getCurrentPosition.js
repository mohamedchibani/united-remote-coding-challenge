  
  /* We can use this script if we add Google Maps API, to get current position, **
  ** but in this project we fix the current position for your                   **
  ** company United Remote RABAT (lat: 33.9954189 - lng: -6.8522116)            ** 
  */
  
	/*Start Get Current Location*/

  var map = null;
   	
   function showLocation(position) {

        var current_latitude  = position.coords.latitude;
        var current_longitude = position.coords.longitude;

        
    }
       

       //Get error if the user refuse to give his current position        
       function errorHandler(err) {
          if(err.code == 1) {
             alert("Error: Activez votre GPS et actualisez la page !");
          } else if( err.code == 2) {
             alert("Error: Position is unavailable!");
          }
       }

       //panel of permission so as to get permission of user to accepting getting his current position
       function getLocation(){
          if(navigator.geolocation){
             // timeout at 60000 milliseconds (60 seconds)
             var options = {timeout:60000};
             navigator.geolocation.getCurrentPosition
             (showLocation, errorHandler, options);
             
          } else{
             alert("Sorry, browser does not support geolocation!");
          }

      }
  /*End Get Current Location*/
	




