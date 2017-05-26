$( ".toggleMySites" ).click(function() {
  $( ".notMySite" ).addClass( "active" );
  if($(".mySite").hasClass("active")) {
    $( ".mySite" ).toggleClass( "active" );
  };
});

$( ".toggleUpdates" ).click(function() {
  $( ".mySite" ).addClass( "active" );
  if($(".notMySite").hasClass("active")) {
    $( ".notMySite" ).toggleClass( "active" );
  };
});
