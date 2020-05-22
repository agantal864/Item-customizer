<?php

  include('config/db_connect.php');

  $name = $description = $price = $slot = $type = $rarity = '';
  $errors = array('name' => '', 'description' => '', 'price' => '', 'slot' => '', 'type' => '', 'rarity' => '');
  if (isset($_POST['submit'])) {
      if(empty($_POST['item_name'])) {
        $errors['name'] = "An item name is required";
      } else {
        $name = $_POST['item_name'];
  			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
  				$errors['name'] = 'Item name must be letters and spaces only';
  			}
      }
      if(empty($_POST['item_description'])) {
        $errors['description'] = "An item description is required";
      } else {
        $description = $_POST['item_description'];
      }
      if(empty($_POST['item_price'])) {
        $errors['price'] = "An item price is required";
      } else {
        $price = $_POST['item_price'];
  			if(!preg_match('/^\d*\.?\d*$/', $price)){
  				$errors['price'] = 'Item price must be numbers only';
  			}
      }
      if(empty($_POST['item_slot'])) {
        $errors['slot'] = "An item slot is required";
      } else {
        $slot = $_POST['item_slot'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $slot)){
  				$errors['slot'] = 'Item slot must be letters and spaces only';
  			}
      }
      if(empty($_POST['item_type'])) {
        $errors['type'] = "An item type is required";
      } else {
        $type = $_POST['item_type'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $type)){
  				$errors['type'] = 'Item type must be letters and spaces only';
  			}
      }
      if(empty($_POST['item_rarity'])) {
        $errors['rarity'] = "An item rarity is required";
      } else {
        $rarity = $_POST['item_rarity'];
        if(!preg_match('/^[a-zA-Z\s]+$/', $rarity)){
  				$errors['rarity'] = 'Item rarity must be letters and spaces only';
  			}
      }


    if (array_filter($errors)) {
        //No error
    } else {
      $name = mysqli_real_escape_string($connect, $_POST['item_name']);
      $description = mysqli_real_escape_string($connect, $_POST['item_description']);
      $price = mysqli_real_escape_string($connect, $_POST['item_price']);
      $slot = mysqli_real_escape_string($connect, $_POST['item_slot']);
      $type = mysqli_real_escape_string($connect, $_POST['item_type']);
      $rarity = mysqli_real_escape_string($connect, $_POST['item_rarity']);

      //save to sql database
      $sql = "INSERT INTO item_attribute(item_name, item_description, item_price, item_slot, item_type, item_rarity) VALUES('$name', '$description', '$price', '$slot', '$type', '$rarity')";

      if(mysqli_query($connect, $sql)) {
            //success
      } else {
        echo 'query error'. mysqli_error($conn);
      }

      header('Location: index.php');
    }

  }

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
          <h4 class="center">Add an Item</h4>
          <form class="white" action="additem.php" method="POST">
            <label for="">Item Name:</label>
            <input type="text" name="item_name" value="<?php echo htmlspecialchars($name); ?>">
            <div class="red-text">
              <?php echo $errors['name']; ?>
            </div>
            <label for="">Item Description:</label>
            <input type="text" name="item_description" value="<?php echo htmlspecialchars($description); ?>">
            <div class="red-text">
              <?php echo $errors['description']; ?>
            </div>
            <label for="">Item Price:</label>
            <input type="text" name="item_price" value="<?php echo htmlspecialchars($price); ?>">
            <div class="red-text">
              <?php echo $errors['price']; ?>
            </div>
            <label for="">Item Slot:</label>
            <input type="text" name="item_slot" value="<?php echo htmlspecialchars($slot); ?>">
            <div class="red-text">
              <?php echo $errors['slot']; ?>
            </div>
            <label for="">Item Type:</label>
            <input type="text" name="item_type" value="<?php echo htmlspecialchars($type); ?>">
            <div class="red-text">
              <?php echo $errors['type']; ?>
            </div>
            <label for="">Rarity:</label>
            <input type="text" name="item_rarity" value="<?php echo htmlspecialchars($rarity); ?>">
            <div class="red-text">
              <?php echo $errors['rarity']; ?>
            </div>
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>
          </form>
    </section>

    <?php include('templates/footer.php'); ?>
</html>
