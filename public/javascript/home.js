$(document).ready(function() {
    
    let type = "films"
    let result;

    const api = async (type) => {

        try {
            await $.ajax({
                type: "GET",
                url: `../../controller/FilmsControl.php`,
                data: {type, api: "api"},
                success: function (response) {
                    result = JSON.parse(response).results;
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

    api(type);


    const getImages = (type, ) => {

        $.ajax({
            type: "GET",
            url: "../../controller/FilmsControl.php",
            data: {typeImage: type, api: "api"},
            success: function (response) {

                response.forEach(e => {
                    for (const key of result) {
                        e.name == key.title ? key.photo = e.url : null;
                    }
                });

                createAttCarrousel(type, result)
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
                <a href="/view/films.php?id=${e.url.split("/")[5]}&type=${type}" style="cursor: pointer; text-decoration: none; color: white;"">
                    <h5>Name: ${e.title}</h5>
                    <h5>Release Date: ${e.release_date}</h5>
                    <img class="d-block w-100" src="${e.photo}" alt="Film: ${e.title} and Release Date:${e.release_date}">
                    <p class="d-flex justify-content-center mt-3 btn btn-info">Mais informações!</p> 
                </a>
            </div>`);
        });
    }
    
});
