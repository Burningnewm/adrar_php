let deleteCard = document.querySelectorAll(".cross");

function deleteElement(element) {
    fetch(`http://localhost/php_adrar/TP_Animaux/deleteAnimal.php?nom=${element}`, {
            "method": "GET"
        })
        .then(response => response.text())
        .catch(err => {
            console.error(err);
        });
}
const cardElements = document.querySelectorAll(".animaux");
deleteCard.forEach(element => {
    element.addEventListener("click", ()=>{
        let card = document.getElementById(element.id);
        card.parentNode.removeChild(card);
        deleteElement(element.id)
    }) 
});

    