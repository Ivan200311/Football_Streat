document.addEventListener('DOMContentLoaded', () => {
    let productsConteiner = document.querySelector('.cont_product')
    let categoryChecks = document.querySelectorAll("[name='category']")

    let allProduct = []
    categoryChecks.forEach(item => {
        allProduct.unshift(item.value)
    })
    getProductsByCategory(allProduct)

    //отрабатываем выбор категории
    categoryChecks.forEach(item => {
        item.addEventListener('change', async (e) => {
            //формируем массив по id категорий по выбранным флажкам
            let categoriesCheck = [...categoryChecks].filter(item => item.checked).map(item => item.value)
            //получаем товары выбранных категорий
            await getProductsByCategory(categoriesCheck)
        })
    });

    async function getProductsByCategory(categories) {
        let param = new URLSearchParams()
        param.append('category', JSON.stringify(categories))
        let products = await getData('/app/admin/search.php', param);
        showProducts(products)
    }

    //вывод карточек на страницу
    function showProducts(products) {
        productsConteiner.innerHTML = ''
        products.forEach(product => {
            productsConteiner.insertAdjacentHTML('beforeend', getOneCard(product))
        })
       
    }

    //формирование одной карточки
    function getOneCard({ id, name, photo, price,year_release, country, category,brand}) {
        return `<tr class='tr_block'>
        <td>${id}</td>
        <td> ${name}</td>
        <td> ${price}</td>
        <td> ${year_release}</td>
        <td> <img class="img-tov-adm" src=/upload/${photo}></td>
        <td> ${country}</td>
        <td> ${category}</td>
        <td> ${brand}</td>
        <td class="doing">
            <button class="delete" data-image="${photo}"  data-id="${id}">Удалить</button>
            <a href="/app/tables/products/show.php?id=${id}" class="btn btn-primary delete">Подробнее</a>
            <a href="/app/admin/update2.php?id=${id}" class="btn btn-primary delete update">Редактировать</a>
        </td>
        </tr>`
    }
})