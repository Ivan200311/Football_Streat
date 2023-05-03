async function outResult(productId, action) {
    let { productInBasket, sum, count } = await postJSON('/app/tables/basket/save.basket.php', productId, action)
    if (sum > 0) {
        if (productInBasket != 'delete') {
            console.log(productInBasket)
            document.getElementById(`count-${productInBasket.product_id}`).textContent = productInBasket.quantity

            document.querySelector(`[data-price-position="${productInBasket.product_id}"]`).textContent = `${productInBasket.price_position}₽`
        }
    }
    else {
        document.querySelector('.empty').textContent = 'Пока ничего нет'
        sum = 0
        count = 0
        document.querySelector('.order').disabled = true
        document.querySelector('.clear').style.display = 'none'
        document.querySelector('.sum').style.display = 'none'
        document.querySelector('.count').style.display = 'none'
    }
    // document.getElementById(`count-${productInBasket.product_id}}`).textContent = productInBasket.quantity

    document.querySelector('.sum').textContent = `Итого: ${sum}₽`
    document.querySelector('.count').textContent = `Итого: ${count}шт`
}

document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('minus')) {
            outResult({"product_id":e.target.dataset.productId, "size_product_id":e.target.dataset.sizeProductsId}, 'reduce')
        }
        if (e.target.classList.contains('plus')) {
            outResult({"product_id":e.target.dataset.productId, "size_product_id":e.target.dataset.sizeProductsId}, 'add')
        }
        if (e.target.classList.contains('delete')) {
            outResult(e.target.dataset.productId, 'delete')
            e.target.closest('.block_basket-foot').remove()
        }
        if (e.target.classList.contains('clear')) {
            outResult('', 'clear')
            document.querySelectorAll('.block_basket-foot').forEach(item=>{
                item.remove()
            }) 
        }
    })
})