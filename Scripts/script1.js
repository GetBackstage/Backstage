var div = document.getElementById('data');
//Generate div for putting a picture in 5X4 in another div named 'data'
  for (i = 0; i < 20; i++) {
    if(i%5==0){
        div.innerHTML= div.innerHTML + '<br/>';
    }
    div.innerHTML = div.innerHTML + '<div id="div1" ondrop="drop(event)" style="display: inline-block;" ondragover="allowDrop(event)"></div>';
  }

  var imagesX = document.getElementById('imagesX');
  var imagesO = document.getElementById('imagesO')
  //Create images with picture 'X'
  for(i = 0; i < 10;i++){
    imagesX.innerHTML = imagesX.innerHTML + '<img id="drag'+i +'" style=" position:absolute" src="Resources/x.png" alt="X" draggable="true" ondragstart="drag(event)" width="80" height="69">';
  }
//Create images with picture 'O'
  for(i = 10; i < 20;i++){
    imagesO.innerHTML = imagesO.innerHTML + '<img id="drag'+i +'" style=" position:absolute" src="Resources/o.png" alt="O" draggable="true" ondragstart="drag(event)" width="80" height="69">';
  }

  function allowDrop(ev) {
      ev.preventDefault();
  }

  function drag(ev) {
      ev.dataTransfer.setData("text", ev.target.id);
  }
  var X = false;

  function drop(ev) {
    //Als "X" invisible is, wordt deze terug visible na het draggen van "O" en deze
    //wordt omgedraaid na het draggen van "X"
    if(X==false){
      document.getElementById("imagesX").style.visibility = "visible";
      document.getElementById("imagesO").style.visibility = "hidden";
      X = true;
    }else{

      document.getElementById("imagesX").style.visibility = "hidden";
      document.getElementById("imagesO").style.visibility = "visible";
      X = false;
    }
      ev.preventDefault();
      var data = ev.dataTransfer.getData("text");
      ev.target.appendChild(document.getElementById(data));
      var item = document.getElementById(data);
  }
