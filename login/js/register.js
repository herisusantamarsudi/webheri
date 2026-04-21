document.getElementById("registerForm").addEventListener("submit", function(e){

e.preventDefault();

const username = document.getElementById("username").value;
const email = document.getElementById("email").value;
const password = document.getElementById("password").value;
const confirmPassword = document.getElementById("confirmPassword").value;
const level = document.getElementById("level").value;

const pesan = document.getElementById("pesan");

if(password !== confirmPassword){

pesan.innerHTML = "Password tidak sama!";
return;

}

fetch("api/register.php",{

method:"POST",

headers:{
"Content-Type":"application/json"
},

body: JSON.stringify({
username:username,
email:email,
password:password,
level:level
})

})

.then(response => response.json())
.then(data => {

if(data.status === "success"){

pesan.innerHTML = "Registrasi berhasil, silakan login";

setTimeout(()=>{
window.location.href = "index.html";
},2000);

}else{

pesan.innerHTML = data.message;

}

})

.catch(error => console.log(error));

});