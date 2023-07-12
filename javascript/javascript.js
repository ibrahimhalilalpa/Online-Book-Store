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
