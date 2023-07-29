//Toggle Dark/Light Mode

function myFunctionDark() {
    var element = document.body; 

element.classList.remove('light-mode');
element.classList.add('dark-mode');
  }
  
  function myFunctionLight() {
    var element = document.body; 
    element.classList.remove('dark-mode');
    element.classList.add('light-mode');
  }


function myFunctionmyDIV() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }



    function openBook(file) {
        window.open('uploads/files/' + file);
    }

    function downloadBook(file, title) {
        var link = document.createElement('a');
        link.href = 'uploads/files/' + file;
        link.download = title;
        link.click();
    }

    