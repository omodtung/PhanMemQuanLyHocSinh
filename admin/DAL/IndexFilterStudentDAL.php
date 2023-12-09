<?php
include_once("database.php");
include_once("DAL/getCategoriesStudent.php");
include_once("DAL/filterDataStudent.php");
include_once("BL/getcategoryBL.php");



?>

<form method="post" action="BL/reboundStudent.php?indexFilterStudent=1">

  <select name="filterByCategory1">

    <?php
    $getCategories = getCategoriesBL();

    foreach ($getCategories as $category) {

    ?>
      <option value="<?php echo $category['malop']; ?>" <?php echo  isset($_POST['filterByCategory1']) && $_POST['filterByCategory1'] == $category['malop'] ? 'selected' : ''; ?>>
        <?php echo $category['malop']; ?>
      </option>
    <?php } ?>


  </select>

  <input type="submit" name="filter1">

</form>


<?php
include_once("BL/displayDataStudent.php");
?>