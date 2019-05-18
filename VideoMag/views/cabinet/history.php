
<?php include ROOT . '/views/layouts/header.php'; ?>


<h4>Просмотр заказа #<?php echo $orderId; ?></h4>
            <br/>
<table class="table-admin-medium table-bordered table-striped table ">
                <tr>

                    <th>Артикул фильма</th>  
                    <th>Название фильма</th>
                    <th>Цена</th>
                    <th>Ключ</th>
                    
                </tr>

               <?php  foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['code']; ?></td> 
                        <td><?php echo $product['name']; ?></td> 
                        <td><?php echo $product['price']; ?></td> 
                        <td><?php echo $product['site']; ?></td> 

                        
                        
                    </tr>
                <?php endforeach; ?>
            </table>



<?php include ROOT . '/views/layouts/footer.php'; ?>




                