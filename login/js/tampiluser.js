let userData = [];

function tampilkanDataKeTabel(dataArray, targetTbodyId) {

const tbody = document.getElementById(targetTbodyId);
tbody.innerHTML = '';

dataArray.forEach(user => {

const row = `
<tr>
<td>${user.id}</td>
<td>${user.username}</td>
<td>${user.email}</td>
<td>${user.level}</td>

<td>
<button onclick="editUser(${user.id}, '${user.username}', '${user.email}', '${user.level}')">Edit</button>
<button onclick="hapusUser(${user.id})">Hapus</button>
</td>

</tr>
`;

tbody.innerHTML += row;

});

}

function ambilData(){

fetch("https://herisusanta.my.id/java/api/endpoint.php")
.then(response => response.json())
.then(data => {

userData = data;

tampilkanDataKeTabel(userData,'data-all');

})
.catch(error => console.log(error));

}

function filterSiswa(){

return userData.filter(user => user.level === "siswa");

}

document.getElementById("tampilSiswaBtn").addEventListener("click",()=>{

const siswaData = filterSiswa();

tampilkanDataKeTabel(siswaData,"data-siswa");

});



/* =====================
EDIT USER
===================== */

function editUser(id,username,email,level){

const usernameBaru = prompt("Edit Username", username);
const emailBaru = prompt("Edit Email", email);
const levelBaru = prompt("Edit Level", level);

fetch("api/update.php",{

method:"POST",

headers:{
"Content-Type":"application/json"
},

body:JSON.stringify({

id:id,
username:usernameBaru,
email:emailBaru,
level:levelBaru

})

})
.then(res=>res.json())
.then(data=>{

alert(data.message);
ambilData();

});

}


/* =====================
HAPUS USER
===================== */

function hapusUser(id){

if(confirm("Yakin ingin menghapus user ini?")){

fetch("api/delete.php",{

method:"POST",

headers:{
"Content-Type":"application/json"
},

body:JSON.stringify({
id:id
})

})
.then(res=>res.json())
.then(data=>{

alert(data.message);
ambilData();

});

}

}

ambilData();
