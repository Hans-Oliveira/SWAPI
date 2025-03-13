$(document).ready(function() {
    
    $("#login").click(() => {

        const user = $("#user").val();
        const pass = $("#pass").val();
        
        login(user, pass);
    });



    const login = (user, pass) => {

        try {
            $.ajax({
                type: "POST",
                url: "../../controller/LoginControl.php",
                data: {user, pass, login: 1},
                success: function (response) {
    
                   response == "true" ? window.location.href = window.location.href.split("?")[0] + "?page=home" : 
                   
                    Swal.fire({
                        icon: 'warning',
                        title: 'Erro:',
                        text: 'Usuário e senha não correspondem!',
                        confirmButtonText: 'OK',
                        timer: 3000,
                        timerProgressBar: true
                    });
                }
            });
        } catch (error) {
            Swal.fire({
                title: 'Erro',
                text: 'Algo inesperado aconteceu, tente novamente!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
        }

       
    };

});
