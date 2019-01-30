<?php
include ($_SERVER['DOCUMENT_ROOT'].'/include/header1.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/lib/core.php');





function send_email($to='',$cart){
    $to      = 'angara99@gmail.com';
    $subject = 'Заказ запчастей в Ангара';
    $message = "$cart";
    $message = <<<HTML
    <table class="table cart table-striped">
                                <thead>
                                    <tr>
                                        <th>Product </th>
                                        <th>Price </th>
                                        <th>Quantity</th>
                                        <th class="amount">Total </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Android 4.4 Smartphone</a> <small>4.7" Dual Core 1GB</small></td>
                                        <td class="price">$99.50 </td>
                                        <td class="quantity">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="2" disabled>
                                            </div>                                          
                                        </td>
                                        <td class="amount">$199.00 </td>
                                    </tr>
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Android 4.2 Tablet</a> <small>7.3" Quad Core 2GB</small></td>
                                        <td class="price"> $99.66 </td>
                                        <td class="quantity">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="3" disabled>
                                            </div>                                          
                                        </td>
                                        <td class="amount">$299.00 </td>
                                    </tr>
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Desktop PC</a> <small>Quad Core 3.2MHz, 8GB RAM, 1TB Hard Disk</small></td>
                                        <td class="price"> $499.66 </td>
                                        <td class="quantity">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="3" disabled>
                                            </div>                                          
                                        </td>
                                        <td class="amount">$1499.00 </td>
                                    </tr>
                                    <tr>
                                        <td class="total-quantity" colspan="3">Subtotal</td>
                                        <td class="amount">$1997.00</td>
                                    </tr>
                                    <tr>                                        
                                        <td class="total-quantity" colspan="2">Discount Coupon</td>
                                        <td class="price">iDeaDiscount25672</td>
                                        <td class="amount">-20%</td>
                                    </tr>
                                    <tr>
                                        <td class="total-quantity" colspan="3">Total 8 Items</td>
                                        <td class="total-amount">$1597.00</td>
                                    </tr>
                                </tbody>
                            </table>
HTML;
    
    
    
    
    
    
    $headers = "From: noreply77@gmail.com" . "\r\n";
    $headers .= "Reply-To: angara77@gmail.com" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
   


    if(mail($to, $subject, $message, $headers)){
        return true;
    }
}
 /*  if(send_email($to,$cart)){
   echo "email has sent!"; 
} else {
    echo "Email has not sent!";
}
*/

 $message = <<<HTML
 <section class="main-container">

                <div class="container">
                    <div class="row">

                        <!-- main start -->
                        <!-- ================ -->
                        <div class="main col-md-12">

                            <!-- page-title start -->
                            <!-- ================ -->
                            <h1 class="page-title margin-top-clear">Review Your Order</h1>
                            <!-- page-title end -->
                            <div class="space"></div>
                            <table class="table cart table-striped">
                                <thead>
                                    <tr>
                                        <th>Product </th>
                                        <th>Price </th>
                                        <th>Quantity</th>
                                        <th class="amount">Total </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Android 4.4 Smartphone</a> <small>4.7" Dual Core 1GB</small></td>
                                        <td class="price">$99.50 </td>
                                        <td class="quantity">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="2" disabled>
                                            </div>                                          
                                        </td>
                                        <td class="amount">$199.00 </td>
                                    </tr>
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Android 4.2 Tablet</a> <small>7.3" Quad Core 2GB</small></td>
                                        <td class="price"> $99.66 </td>
                                        <td class="quantity">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="3" disabled>
                                            </div>                                          
                                        </td>
                                        <td class="amount">$299.00 </td>
                                    </tr>
                                    <tr>
                                        <td class="product"><a href="shop-product.html">Desktop PC</a> <small>Quad Core 3.2MHz, 8GB RAM, 1TB Hard Disk</small></td>
                                        <td class="price"> $499.66 </td>
                                        <td class="quantity">
                                            <div class="form-group">
                                                <input type="text" class="form-control" value="3" disabled>
                                            </div>                                          
                                        </td>
                                        <td class="amount">$1499.00 </td>
                                    </tr>
                                    <tr>
                                        <td class="total-quantity" colspan="3">Subtotal</td>
                                        <td class="amount">$1997.00</td>
                                    </tr>
                                    <tr>                                        
                                        <td class="total-quantity" colspan="2">Discount Coupon</td>
                                        <td class="price">iDeaDiscount25672</td>
                                        <td class="amount">-20%</td>
                                    </tr>
                                    <tr>
                                        <td class="total-quantity" colspan="3">Total 8 Items</td>
                                        <td class="total-amount">$1597.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="space-bottom"></div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Billing Information </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td class="information">John Doe </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td class="information">johndoe@mail.com </td>
                                    </tr>
                                    <tr>
                                        <td>Telephone</td>
                                        <td class="information">+00 123 123 1234</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td class="information">One infinity loop, 54100, United States</td>
                                    </tr>
                                    <tr>
                                        <td>Additional Info</td>
                                        <td class="information">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum accusamus pariatur odit neque.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="space-bottom"></div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Shipping Information </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Full Name</td>
                                        <td class="information">John Doe </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td class="information">johndoe@mail.com </td>
                                    </tr>
                                    <tr>
                                        <td>Telephone</td>
                                        <td class="information">+00 123 123 1234</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td class="information">One infinity loop, 54100, United States</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="space-bottom"></div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="2">Payment </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Credit Card</td>
                                        <td class="information">Visa ***917 </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-right">    
                                <a href="shop-checkout-payment.html" class="btn btn-group btn-default btn-sm"><i class="icon-left-open-big"></i> Go Back</a>
                                <a href="shop-checkout-completed.html" class="btn btn-group btn-default btn-sm"><i class="icon-check"></i> Complete Your Order</a>
                            </div>
                        </div>
                        <!-- main end -->

                    </div>
                </div>
            </section>
            <!-- main-container end -->


            

            
HTML;

echo $message;

include ($_SERVER['DOCUMENT_ROOT'].'/include/footerjq.php');