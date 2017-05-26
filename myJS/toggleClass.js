$( ".toggleMySites" ).click(function() {
  $( ".notMySite" ).addClass( "active-client" );
  if($(".mySite").hasClass("active-client")) {
    $( ".mySite" ).toggleClass( "active-client" );
  };
});

$( ".toggleUpdates" ).click(function() {
  $( ".mySite" ).addClass( "active-client" );
  if($(".notMySite").hasClass("active-client")) {
    $( ".notMySite" ).toggleClass( "active-client" );
  };
});
