var date = new Date();
var d  = date.getDate();
var day = (d < 10) ? '0' + d : d;
var m = date.getMonth() + 1;
var month = (m < 10) ? '0' + m : m;
var yy = date.getYear();
var year = (yy < 1000) ? yy + 1900 : yy;

function startTime(){
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
var m=checkTime(m);
var s=checkTime(s);
document.getElementById('date').innerHTML= "Fecha:  "+ day + "/" + month + "/" + year+ "   |  Hora: "+h+":"+m+":"+s;
t=setTimeout('startTime()',500);}

function checkTime(i)
{if (i<10) {i="0" + i;}return i;}
window.onload=function(){startTime();}