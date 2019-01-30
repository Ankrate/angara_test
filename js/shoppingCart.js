
// Shoping cart functions
 //**************************************************************
        
        
        var shoppingCart = {};
        shoppingCart.cart = [];
        shoppingCart.Item = function(name,price,count) {
            this.name = name;
            this.price = price;
            this.count = count;
            
        };
        
        shoppingCart.addItemCart = function(name,price,count) {
            for (var i in this.cart) {
                if (this.cart[i].name === name) {
                    this.cart[i].count += count;
                    this.saveCart();
                    //alert("Товар добавлен в корзину");
                    return;
                }
            }
            var item = new this.Item(name,price,count);
            //console.log(this.cart);
            if(this.cart == null){
            	this.cart = new Array();
            }
            this.cart.push(item);
            this.saveCart();
            alert("Товар добавлен в корзину");
        };
        
        shoppingCart.removeItemFromCart = function(name) {
            for (var i in this.cart) {
                if (this.cart[i].name === name) {
                    this.cart[i].count --;
                    if (this.cart[i].count === 0) {
                        this.cart.splice(i,1);
                    }
                    break;
                }
            }
            this.saveCart();
        };
        
        shoppingCart.removeItemFromCartAll = function (name) {
            for (var i in this.cart) {
                if (this.cart[i].name === name) {
                   this.cart.splice(i,1);
                    break;
                }
            }
            this.saveCart();
        };
        
       shoppingCart.clearCart = function () {
           if(confirm("Удалить все товары из корзины?")){
           this.cart = [];
           this.saveCart();
           }
       };
       
       shoppingCart.countCart = function () {
          var totalCount = 0;
          for (var i in this.cart) {
              totalCount += this.cart[i].count;
          } 
          return totalCount;
       };
       
       shoppingCart.totalCart = function ()  {
           var totalCost = 0;
           for (var i in this.cart) {
               totalCost += this.cart[i].price * this.cart[i].count;
           }
           return totalCost.toFixed(0);
       };
       
       shoppingCart.listCart = function () {
           var cartCopy = [];
           for (var i in this.cart) {
               var item = this.cart[i];
               var itemCopy = {};
               for (var p in item) {
                   itemCopy[p] = item[p];
               }
               itemCopy.total = (item.price * item.count).toFixed(2);
               cartCopy.push(itemCopy);
           }
           return cartCopy;
       };
       
       
      shoppingCart.saveCart = function () {
           localStorage.setItem("shoppingCart",JSON.stringify(this.cart));
       };
       
       shoppingCart.loadCart = function () {
           this.cart = JSON.parse(localStorage.getItem("shoppingCart"));
           //return this.cart;
       };
       

		$(".add-to-cart").click(function(event){
            event.preventDefault();
            var name = $(this).attr("data-name");
            var price = Number($(this).attr("data-price"));
            
            
            shoppingCart.addItemCart(name,price,1);
            displayCart();
        });
        
        $(".clear-cart").click(function(event){
           shoppingCart.clearCart();
           displayCart();
        });
        
        function displayCart() {
        	
           var cartArray = shoppingCart.listCart();
           var output = "";
           for (var i in cartArray) {
             output += "<tr class='cart-li'>"
             +"<td class='td-name'>"
             +cartArray[i].name
             +"</td>"
             +"<td>"
             +cartArray[i].price
             +"</td>"
             +"<td>"
             +cartArray[i].count
             +"</td>"
             +"<td class='td-delete'>"
             +"<button class='plus-item btn btn-xs btn-info ' data-name='"+cartArray[i].name+"'>+</button>"
             +" <button class='substract-item btn btn-xs btn-success ' data-name='"+cartArray[i].name+"'>-</button>"
             +" <button class='delete-item btn btn-xs btn-danger' data-name='"+cartArray[i].name+"'>x</button>"
             +"</td>"
             +"<td>"
             +cartArray[i].total
             +"</td>"
             +"</tr>";  
           }
           $(".show-cart").html(output);
           $(".count-cart").html(shoppingCart.countCart()); 
           $(".total-cart").html(shoppingCart.totalCart());
           
        }
        
        function displayCartMenu() {
        	
           var cartArray = shoppingCart.listCart();
           var output = "";
           for (var i in cartArray) {
             output += "<li>"
             +"<div class='col-sm-10'>"
             +cartArray[i].name
             +" "
             +cartArray[i].count
             +" x "+cartArray[i].price
             +" = "+cartArray[i].total
             +"</div>"
             +"<div class='col-sm-2'>"
             +" <button class='delete-item btn btn-xs btn-danger' data-name='"+cartArray[i].name+"'>x</button>"
             +"</div>"
             +"</li>";  
           }
           $(".show-cart-menu").html(output);
           $(".count-cart").html(shoppingCart.countCart()); 
           $(".total-cart").html(shoppingCart.totalCart());
        }
        
        
        
       
        
        
        
        
        
        
        $(".show-cart").on("click", ".delete-item",function(event){
            var name = $(this).attr("data-name");
            shoppingCart.removeItemFromCartAll(name);
            displayCart();
        });
        
         $(".show-cart-menu").on("click", ".delete-item",function(event){
            var name = $(this).attr("data-name");
            shoppingCart.removeItemFromCartAll(name);
            displayCart();
        });
        
        $(".show-cart").on("click", ".substract-item", function(event){
            var name = $(this).attr("data-name");
            shoppingCart.removeItemFromCart(name);
            displayCart();
        });
        
        $(".show-cart").on("click", ".plus-item", function(event){
            var name = $(this).attr("data-name");
            shoppingCart.addItemCart(name, 0, 1);
            displayCart();
        });
        
        
        //var load = [];
        shoppingCart.loadCart();
       
       
		displayCart();
		load = shoppingCart.listCart();
		
		
		
		




