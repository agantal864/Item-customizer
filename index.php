<?php

  include('config/db_connect.php');


  $data = 'SELECT id, item_name, item_description, item_price, item_slot, item_type, item_rarity FROM item_attribute ORDER BY time_of_creation';

  $result = mysqli_query($connect, $data);

  $all_items = mysqli_fetch_all($result, MYSQLI_ASSOC);


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php include('templates/header.php'); ?>
    <div class="container">
      <div class="row">
        <?php foreach($all_items as $item) {?>
            <div class="col s6 md3">
                  <div class="card z-depth-0" >
                    <div class="card-content center" id="test" style="padding: 20px; margin: 40px 30px;" >
                        <h5><?php echo htmlspecialchars($item['item_name']); ?></h5>
                        <p><?php echo htmlspecialchars($item['item_description']); ?></p>
                        <p>Price: <?php echo htmlspecialchars($item['item_price']); ?></p>
                        <p>Slot: <?php echo htmlspecialchars($item['item_slot']); ?></p>
                        <p>Type: <?php echo htmlspecialchars($item['item_type']); ?></p>
                        <p>Rarity: <?php echo htmlspecialchars($item['item_rarity']); ?></p>
                    </div>
                  </div>
            </div>
        <?php } ?>
      </div>
    </div>
    <?php include('templates/footer.php'); ?>
</html>
