function showCities(countryid){
    if(countryid =="0")
    {
        document.getElementById("citylist").innerHTML="";
        return;
    }
let ajax;
if(window.XMLHttpRequest)
{
    ajax=new XMLHttpRequest();
}
else {
    ajax=ActiveXObject('Microsoft.XMLHTTP');
}

ajax.onreadystatechange = function()
{
    if(ajax.readyState==4 && ajax.Status==200)
    { 
        document.getElementById("citylist").innerHTML= ajax.responseText;
    }
}
ajax.open("GET", "pages/ajax1.php?cid=" +countryid, true);
ajax.send(null);
}

function showHotels(cityid){   
    let h =  document.getElementById("h");
    if(cityid =="0")
    {
         h.innerHTML = " ";
        return;
    }
let ajax;
if(window.XMLHttpRequest)
{
    ajax=new XMLHttpRequest();
}
else {
    ajax=ActiveXObject('Microsoft.XMLHTTP');
}

ajax.onreadystatechange = function()
{
    if(ajax.readyState==4 && ajax.Status==200)
    {
        h.innerHTML= ajax.responseText;
    }
}
ajax.open("POST", "pages/ajax2.php", true);
ajax.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
ajax.send("cid"+cityid);

}


