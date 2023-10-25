let jsonDataShop = [
    { "id": 1, "content": "Shop 1", "img": "shop1.jpg", "link": "shop1.php"},
    { "id": 2, "content": "Shop 2", "img": "shop2.jpg",  "link": "shop2.php"},
    { "id": 3, "content": "Shop 3", "img": "shop3.jpg",  "link": "shop3.php"},
];

const container = document.getElementById('container');

jsonDataShop.forEach(item => {
    const divShop = document.createElement('div');
    const linkProduct = document.createElement('a');
    const imgProduct = document.createElement('img');
    const descProduct = document.createElement('p');

    divShop.classList.add("shop");
    linkProduct.classList.add("shoplink");
    imgProduct.classList.add("shopimg");
    descProduct.classList.add("shopdesc");
    linkProduct.href = item.link;
    imgProduct.src = item.img;
    descProduct.textContent = item.content;
    
    divShop.appendChild(linkProduct);
    linkProduct.appendChild(imgProduct);
    linkProduct.appendChild(descProduct);
    container.appendChild(divShop);
});