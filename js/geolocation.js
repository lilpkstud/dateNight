let G, options, spans;

document.addEventListener('DOMContentLoaded', init);

function init(){
  if(navigator.geolocation){
    
    let giveUp = 1000 * 20; //20 seconds
    let tooOld = 1000 * 60 * 60; //One Hour

    options = {
      //Using GPS than celluar tower change to false to save battery life
      enableHighAccuracy: false,
      timeout: giveUp,
      //How long to cache the user's location
      maximumAge: tooOld
      

    }
    navigator.geolocation.getCurrentPosition(gotPos, posFail, options);
  } else {
    //User is using an old browser that doesn't support geolocation
  }
}

function gotPos(position){
  console.log(position.coords.latitude);
  console.log(position.coords.longitude);
  console.log(position.timestamp);
  document.getElementById("latitude").value = position.coords.latitude;
  document.getElementById("longitude").value = position.coords.longitude;
  document.getElementById("timestamp").value = position.coords.latitude;

  spans = document.querySelectorAll('p span');
  //spans[0].textContent = position.coords.latitude;
  //spans[1].textContent = position.coords.longitude;

  spans[2].textContent = position.timestamp;
}

function posFail(err){
  //err is a number
  let errors = {
    1: "No permission",
    2: "Unable to determine location",
    3: "Took too long...timed out"
  }
  document.querySelector('h1').textContent = errors[err];
}