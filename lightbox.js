

function gradient(id, level)
{
    var box = document.getElementById(id);
    box.style.opacity = level;
    box.style.MozOpacity = level;
    box.style.KhtmlOpacity = level;
    box.style.filter = "alpha(opacity=" + level * 100 + ")";
    box.style.display="block";
    return;
}


function fadein(id) 
{
    var level = 0;
    while(level <= 1)
    {
        setTimeout( "gradient('" + id + "'," + level + ")", (level* 1000) + 10);
        level += 0.01;
    }
}



function openbox(formtitle, fadin)
{
  var box = document.getElementById('box'); 
  document.getElementById('shadowing').style.display='block';

  var btitle = document.getElementById('boxtitle');
  btitle.innerHTML = formtitle;
  
  if(fadin)
  {
     gradient("box", 0);
     fadein("box");
  }
  else
  {     
    box.style.display='block';
  }     
}

function openbox2(formtitle, fadin)
{
  var box = document.getElementById('box2'); 
  document.getElementById('shadowing').style.display='block';

  var btitle = document.getElementById('boxtitle2');
  btitle.innerHTML = formtitle;
  
  if(fadin)
  {
     gradient("box", 0);
     fadein("box");
  }
  else
  {     
    box.style.display='block';
  }     
}


function closebox()
{
   document.getElementById('box').style.display='none';
   document.getElementById('shadowing').style.display='none';
}



