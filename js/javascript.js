$(document).ready(function() {
        
        var loc = window.location.href;

        if (loc.toLowerCase().indexOf(".php") < 0  || loc.toLowerCase().indexOf("index") >= 0 ){
          ChangeIt();
        } else {
          Menublack();
        }
});

function ChangeIt() 
{
    var totalCount = 3;
    var num = Math.ceil( Math.random() * totalCount );
    document.body.background = 'css/img/background/'+num+'.jpg';
}

function Menublack() 
{
    document.body.style.color = "black";
    document.getElementById("logoimg").src = "css/img/logoblack.png";

    var cssId = 'cssblack';  // you could encode the css path itself to generate id..
    if (!document.getElementById(cssId))
    {
        var head  = document.getElementsByTagName('head')[0];
        var link  = document.createElement('link');
        link.id   = cssId;
        link.rel  = 'stylesheet';
        link.type = 'text/css';
        link.href = 'css/cssblack.css';
        link.media = 'all';
        head.appendChild(link);
    }


}

function login() 
{
       if(document.getElementById("logincontent").style.display == "block"){
          document.getElementById("logincontent").style.display = "none";
       } else {
          document.getElementById("logincontent").style.display = "block";
       }
}

function validarLogin() 
{
       document.getElementById("logincontent").style.display = "none";
}



function radiobutton(elem)
{
  var elems = document.getElementsByTagName("input");
  var currentState = elem.checked;
  var elemsLength = elems.length;

  for(i=0; i<elemsLength; i++)
  {
    if(elems[i].type === "checkbox")
    {
       elems[i].checked = false;   
    }
  }

  elem.checked = currentState;
}
