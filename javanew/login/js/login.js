document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    fetch("api/login.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `username=${username}&password=${password}`
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            // simpan username
            localStorage.setItem("username", data.username);

            // redirect ke landing page
            window.location.href = "../index.html";
        } else {
            document.getElementById("message").innerText = "Login gagal";alert("Login gagal");
 
        }
    });
});