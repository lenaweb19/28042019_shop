class Product {
    //данные
    constructor (productName, productPic, productPrice) {
        this.name = productName;
        this.pic = productPic;
        this.price = productPrice;
        this.el = document.querySelector('.goods');

    }
    // что мы делаем с этими данными
    createCard () {
    //1.создаем блок
        let productCardBlock = document.createElement ('div');
       

    //2.добавляем стили
        productCardBlock.classList.add ('goods-item');

    //3.вставляем HTML код в блок 
        productCardBlock.innerHTML = `
        <div class="foto-item" style ="background-image: url(/images/catalog/${this.pic})"></div>
        <div class="goods-name">${this.name}</div>
        <div class="goods-price">${this.price}</div>`;

    //4.добавляем уврточку товара в блок
        this.el.appendChild(productCardBlock);

    }
}


class Catalog {
    constructor () {
        this.el = document.querySelector('.goods');
    }

    cleanCatalog() {
        this.el.innerHTML = '';
    }

    preloaderOn() {
        let preloader = document.createElement('div');
        preloader.classList.add('preloader');
        this.el.appendChild(preloader);
    }

    preloaderOff() {
        this.cleanCatalog();
    }




    renderCatalog ( parentCatID ) {

        this.cleanCatalog();
        this.preloaderOn();

        //1. создаем пустой объект
        let xhr = new XMLHttpRequest; 

        


        //1.get параметр: window.location.search
        //2. id категории из селекта: parentCatID

        //проверяем есть ли  GET параметы в строке
        let catID = (window.location.search == '') ? '?id=1' :  window.location.search;
        //если был передан id подкатегории

        if ( parentCatID != undefined ) {

            catID = `?id=${parentCatID}`;

        }


        //2. наполняем данными для отправки
        xhr.open('GET', `/handlers/catalogHandler.php${catID}`);

        //3. отправляем данные 
        xhr.send();

        //4. ждем ответ от сервера
        xhr.addEventListener('load', () => { 
            //потеря контекста
            this.preloaderOff();

            //преобразовываем данные в формат json для js 
            let data = JSON.parse( xhr.responseText );
                
        data.forEach(function( value, index ) {
            let newProduct = new Product(value.name, value.pic, value.price);
            newProduct.createCard();
            
        });

        console.log( data );
        
        });
        
        // let catalogItems = [
        //     {
        //         name : "Куртка синяя",
        //         pic : '1.jpg',
        //         price : '5400'
    
        //     },

        //     {
        //         name : "Куртка с капюшоном",
        //         pic : '2.jpg',
        //         price : '6100'
    
        //     }

        // ];
        







       // console.log(catalogItems);
    }
}

let catalog = new Catalog();
catalog.renderCatalog();


//let newProduct = new Product ('Куртка бежевая', '1.jpg', '7 500');
//newProduct.createCard();


//newProduct = new Product ('Куртка красная', '2.jpg', '5 500');
//newProduct.createCard();

let catalogSelect = document.getElementById('category');
catalogSelect.addEventListener('change', function() {

//получаем выбранное значение в селекте 
let selectValue = catalogSelect.value;

//создаем новый экземпляр объекта catalog
let catalog = new Catalog();
catalog.renderCatalog( selectValue );


});