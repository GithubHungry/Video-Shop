<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>
                        


            <h4>Список заказов пользователя : <?php echo $name; ?></h4>

            <br/>

            
            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID заказа</th>
<!--                    <th>Имя покупателя</th>
                    <th>Телефон покупателя</th>-->
                    <th>Дата оформления</th>
                    <!--<th>Статус</th>-->
                    
                </tr>
                <?php foreach ($ordersList as $order): ?>
                    <tr>
                        <td>
                            <a href="/VideoMag/cabinet/history/view/<?php echo $order['id']; ?>">
                                <?php echo $order['id']; ?>
                            </a>
                        </td>
                        <!--<td><?php echo $order['id']; ?></td>-->
                        <td><?php echo $order['date']; ?></td>
                        <!--<td><?php echo Order::getStatusText($order['status']); ?></td>-->    
                       
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>

