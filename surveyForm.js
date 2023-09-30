let fb=document.getElementById("fb");
let fbScale=document.getElementById("fbScale");
let ig=document.getElementById("ig");
let igScale=document.getElementById("igScale");
let yt=document.getElementById("yt");
let ytScale=document.getElementById("ytScale");
let wp=document.getElementById("wp");
let wpScale=document.getElementById("wpScale");
let age =document.getElementById("age");

if(age.trim()===""){
    document.getElementById("ageError").innerHTML="*Age is a required field";
}
fb.addEventListener('input',function (){
    fbScale.textContent=fb.value;
})
ig.addEventListener('input',function (){
    igScale.textContent=ig.value;
})
yt.addEventListener('input',function (){
    ytScale.textContent=yt.value;
})
wp.addEventListener('input',function (){
    wpScale.textContent=wp.value;
})

