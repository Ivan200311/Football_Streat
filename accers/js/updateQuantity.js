document.addEventListener("DOMContentLoaded", () => {

document.getElementById('size_id').addEventListener('change', async(e)=>{
   
    let id=e.target.value
    console.log(id)
    let param = new URLSearchParams();
    param.append("id", JSON.stringify(id));
    let res=await getData("/app/admin/updateQuantity.php",param);
    console.log(res)
    document.querySelector('[name="quantity"]').value=res.quantity
})

})
