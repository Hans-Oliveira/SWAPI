$(document).ready(function() {
    
    let type = "films"
    let result;
    let info = [];

    $("#types").change(() => { 
        
        type = $("#types").val();

        api(type);
       
    });

    const api = async (type, id) => {
        
        id = id ?? "";

        try {
            await $.ajax({
                type: "GET",
                url: `../../controller/FilmsControl.php`,
                data: {type, id, api: "api"},
                success: function (response) {
                    response = JSON.parse(response);
                    result = id == "" ? response.results : response;
                }
            });
    
            getImages(type)
        } catch (error) {
            console.log(error);
            Swal.fire({
                title: 'Erro',
                text: 'Algo inesperado aconteceu, tente novamente!',
                icon: 'warning',
                confirmButtonText: 'OK'
            })
        }
    }


    const getImages = (type, infoModal) => {

        $.ajax({
            type: "GET",
            url: "../../controller/FilmsControl.php",
            data: {image: type},
            success: function (response) {
      
                if (infoModal == undefined) {
                    
                    response.forEach(e => {
                        for (const key of result) {
                            e.name == key.title ? key.photo = e.url : null;
                            e.name == key.title ? key.synopsis = e.synopsis : null;
                        }
                    });

                    createAttCarrousel(type, result)
                }else{

                    response.forEach(e => {
                        for (const key of infoModal) {
                            e.name == key.name ? key.photo = e.url : null;
                        }
                    });
                    createModalBody(infoModal);
                }
            }
        });
    }

    const createAttCarrousel = (type, result) => {
        
        const carrousel = $(".carousel-inner");

        carrousel.empty();
        
        result.forEach((e, i) => {

            const activeClass = i === 0 ? "active" : "";

            carrousel.append(` 
            <div class="carousel-item ${activeClass}">
                <a data-toggle="modal" data-target="#infoPeople" style="cursor: pointer; text-decoration: none; color: white;" class="openModal ${i}">
                    <h5>Name: ${e.title}</h5>
                    <h5>Release Date: ${e.release_date}</h5>
                    <img class="d-block w-100" src="${e.photo}" alt="Film: ${e.title} and Release Date:${e.release_date}">
                    <p class="d-flex justify-content-center mt-3 btn btn-info">Mais informações!</p> 
                </a>
            </div>`);
        });

        startFilmModal(type, result);
    }

    const startFilmModal = async (type, result) => {

        $(".openModal").click(async function ()  {

            $("#titePeople").empty();

            const id = $(this).attr("class").split(" ")[1];
            const promises = result[id].characters.map(url => fetch(url));
            const responses = await Promise.all(promises);
            info = await Promise.all(responses.map(response => response.json()));
            
            $("#titePeople").text(`${type}: ${result[id].title}`);

            $("#info").append(`
                <h3>Nome: ${result[id].title}</h3>
                <h3>Nº episódio: ${result[id].episode_id}</h3>
                <h3>Data de Lançamento: ${result[id].release_date}</h3>
                <h3>Sinopse:</h3>
                <textarea  name="w3review" rows="8" cols="80" readonly>
                    ${result[id].synopsis}
                </textarea>
                <h3>Diretores: ${result[id].director}</h3>
                <h3>Produtores: ${result[id].producer}</h3>
                <h3>Este filme tem: ${result[id].age}</h3>
            `);

            getImages(type == "films" ? "people" : "films", info);
        });
    }


    const createModalBody = (infoModal) => {
        
        $(".scroll-info").empty();

        for (const key of infoModal) {
            $(".scroll-info").append(`<div class="container-info mx-3" id="${key.name}" style="background: url(${key.photo})" data-toggle="modal" data-target="#infoModal"></div>`);    
        };

        startPeople(infoModal);
    };

    const startPeople = (infoModal) => {

        $(".container-info").click(function () {
            
            $("#titeInfoModal").empty();

            console.log(infoModal);

            const character = infoModal.filter(people => people.name == $(this).attr("id"));

            $("#titeInfoModal").text(character[0].name)

            $("#perfil").append(`<div class="container-info" style="background: url(${character[0].photo})"></div>`);

            
            

        });

    };
    

});
