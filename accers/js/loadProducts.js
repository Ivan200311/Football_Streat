document.addEventListener("click", async (e) => {
  
    if (e.target.classList.contains("delete")) {
    id = e.target.dataset.id;
    image=e.target.dataset.image
    let response = await fetch("/app/admin/delete.product.php", {
      method: "POST",
      headers: {"Content-Type": "application/json;charset=UTF-8",},
      body: JSON.stringify({ id, image}),
    });
console.log(response)
    e.target.closest(".tr_block").remove();

  }

});

let btnModalShow = document.querySelector('.insert');
let wrapper = document.querySelector('.modal-wrapper');

let closeModal = () => wrapper.style.display = 'none';

btnModalShow.onclick = function () {
wrapper.style.display = 'block';
}

wrapper.addEventListener('click', event => {
if (event.target == event.currentTarget)
closeModal();
})

//отработка нажатия на esc
document.addEventListener('keyup', (e) => {
if (e.key == 'Escape') {
closeModal();
}
})