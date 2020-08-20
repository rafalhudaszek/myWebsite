var xmlhttp = new XMLHttpRequest();
onmousedown = function()
{
    xmlhttp.open("GET", "changeTimer.php", false);
    xmlhttp.send(null);
    xmlhttp.responseText;
}

onkeydown = function()
{
    xmlhttp.open("GET", "changeTimer.php", false);
    xmlhttp.send(null);
    xmlhttp.responseText;
}

$(document).ready(function()
{
    $("#hej").get(0).scrollIntoView();
});

setInterval(function()
    {
        xmlhttp.open("GET", "timer.php", false);
        xmlhttp.send(null);
        if(xmlhttp.responseText == "logout")
        {
            window.location.href = 'clear.php';
        }
        document.getElementById("timer").innerHTML = xmlhttp.responseText;
    }, 1000);
