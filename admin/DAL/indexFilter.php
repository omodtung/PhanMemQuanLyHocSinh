<?php
include_once("database.php");

include_once("filter-data.php");
include_once("BL/getcategoryTeacherBL.php")
?>

<form method="post" action="BL/rebound.php?indexFilter=1">

  <select name="filterByCategory">

    <?php
    $getCategories = getcategoryBL();


    foreach ($getCategories as $category) {

    ?>
      <option value="<?php echo $category['mamonhoc']; ?>" <?php echo  isset($_POST['filterByCategory']) && $_POST['filterByCategory'] == $category['mamonhoc'] ? 'selected' : ''; ?>>
        <?php echo $category['mamonhoc']; ?>
      </option>
    <?php } ?>


  </select>

  <input type="submit" name="filter">

</form>


<?php
include_once("BL/displayFilterDataTeacherBL.php");
?>