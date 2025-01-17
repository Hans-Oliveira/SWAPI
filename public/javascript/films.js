$(document).ready(function() {

    let people = [];
    let ids = [];

    $("#testee").click(() => {
        createModalBody(people);

    });


    const getPeople = async (characters) => {

        for (const key of characters) {
            ids.push(key.split("/")[5]);
        }
        
        try {

            Swal.fire({
                title: 'Carregando...',
                text: 'Aguarde enquanto processamos seus dados.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            await $.ajax({
                type: "GET",
                url: "../../controller/FilmsControl.php",
                data: {type: "people", api: "api", id: ids},
                success: function (response) {
                    people = JSON.parse(response);
                }
            });
                
        } catch (error) {

            Swal.close();

            Swal.fire({
                title: 'Erro',
                text: 'Algo inesperado aconteceu, tente novamente!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
        }

        getImage("people", people)
    }

    getPeople(characters);
    

    const getImage = async (type, people) => {

        try {

            await $.ajax({
                type: "GET",
                url: `../../controller/FilmsControl.php`,
                data: {typeImage: type, api: "api",},
                success: function (response) {
                    
                    response.forEach(e => {
                        for (const key of people) {
                            e.name == key.name ? key.photo = e.url : null;
                        } 
                    });
                }
            });

            Swal.close();

            createModalBody(people);
            
        } catch (error) {
            Swal.fire({
                title: 'Erro',
                text: 'Algo inesperado aconteceu, tente novamente!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
        }

    }


    const createModalBody = (people) => {
        
        $(".scroll-info").empty();

        for (const key of people) {
            $(".scroll-info").append(`<div class="container-info mx-3" id="${key.name}" style="background: url(${key.photo})" data-toggle="modal" data-target="#infoModal"></div>`);    
        };

        startPeople(people);
    };

    const startPeople = (people) => {

        $(".container-info").click(function () {
            
            $("#perfil").empty();
            $("#description").empty();

            const character = people.filter(people => people.name == $(this).attr("id"));

            $("#titeInfoModal").text(character[0].name)

            $("#perfil").append(`<div class="perfil" style="background: url(${character[0].photo})"></div>`);

            $("#description").append(`
                <h3>Tamanho: ${character[0].height}</h3>
                <h3>Peso: ${character[0].mass}</h3>
                <h3>Antes da Batalha de Yavin: ${character[0].birth_year}</h3>
                <h3>Cor dos olhos: ${character[0].eye_color}</h3>
                <h3>Cor da pele: ${character[0].skin_color}</h3>
            `);

        });

    };

});