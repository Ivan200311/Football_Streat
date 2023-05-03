document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", async (e) => {
    if (e.target.classList.contains("btn-basket")) {
      if (document.querySelector("#size_selecter").value == 0) {
        document.querySelector(".error").innerHTML = "Выберете размер";
      } else {
        let id = e.target.dataset.btnId;
        console.log({
          product_id: e.target.dataset.btnId,
          size_product_id: document.querySelector("#size_selecter").value,
        });
        let res = await postJSON(
          "/app/tables/basket/save.basket.php",
          {
            product_id: e.target.dataset.btnId,
            size_product_id: document.querySelector("#size_selecter").value,
          },
          "add"
        );
      }
    }
  });
});
