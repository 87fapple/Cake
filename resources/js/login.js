const sign = document.getElementById('login_check');
fetch(
    "php/sign/login.php"
)
.then(function(response){
    return response.text();
})
.then(function(data){
    sign.innerHTML = data;
    console.log(data);
})