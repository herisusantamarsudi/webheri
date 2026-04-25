document.getElementById("loginForm").addEventListener("submit", function(e) {

e.preventDefault();

const username = document.getElementById("username").value;
const password = document.getElementById("password").value;

fetch("https://herisusanta.my.id/java/api/login.php", {

method: "POST",

headers: {
"Content-Type": "application/json"
},

body: JSON.stringify({
username: username,
password: password
})

})
.then(response => response.json())
.then(data => {

const pesan = document.getElementById("pesan");

if(data.status === "success"){
pesan.innerHTML = "Login berhasil!";
window.location.href = "../index.html";
}else{
pesan.innerHTML = "Login gagal: " + data.message;
window.location.href = "index.html";  
}

})
.catch(error => console.log(error));

});
