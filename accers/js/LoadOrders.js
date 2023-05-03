document.addEventListener("click", async (e) => {

    if (e.target.classList.contains("save")) {
      id = e.target.dataset.orderId;
      let statusId = document.querySelector(`#select${id}`).value
      let reason_cancel = ""
      document.querySelectorAll(".reason_cancel").forEach(item => {
        if(item.dataset.textarea == id){
          reason_cancel = item.value
        }
      })
      let response = await fetch("/app/admin/change.php", {
        method: "POST",
        headers: { "Content-Type": "application/json;charset=UTF-8", },
        body: JSON.stringify({ id, statusId, reason_cancel }),
      });
      await response.json();
    }
  
    
  });
  
  let select = document.querySelectorAll(".select");
    select.forEach(item => {
    item.addEventListener("change", (e) => {
      let stat = e.target.value;
      let reason_cancel = document.querySelector(`[data-textarea = "${item.dataset.orderId}"]`);
      console.log(reason_cancel)
      if (stat == 3 ) {
        reason_cancel.disabled = false;
      } else {
        reason_cancel.disabled = true;
      }
    })
    })