<div class="col-4" style="height:609px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">

  <div class="widget-styles">
    <h4 class="widget-title">Filter By:</h4>
 

    <p>
      <button id="filter-button" class="btn btn-primary" data-toggle="collapse" type="button" data-target="#filterMilk" aria-expanded="false" aria-controls="filterMilk">View Milk</button>
    </p>

    <div class="collapse" id="filterMilk">
      <?php

      echo "<h5>Milk Types</h5>";

      $popularCheese = mysqli_query($con, "SELECT * FROM cheese_db GROUP BY type ORDER BY Count(*) DESC LIMIT 5");
      while ($row = mysqli_fetch_array($popularCheese)) {
        $type = $row['type'];
        $cid = $row['cid'];
        echo "<a class=\"dropdown-item\" href=\"" . BASE_URL . "index.php?displayby=type&displayvalue=$type\">$type</a>" . "<br />";
      }
      ?>
    </div>


    <p>
      <button id="filter-button" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filterClass" aria-expanded="false" aria-controls="filterClass">View Class</button>
    </p>

    <div class="collapse" id="filterClass">
      <h5>Classification</h5>
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=classification&displayvalue=hard">Hard</a>
      <br />
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=classification&displayvalue=semi-hard">Semi-Hard</a>
      <br />
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=classification&displayvalue=semi-soft">Semi-Soft</a>
      <br />
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=classification&displayvalue=soft">Soft</a>
      <br />
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=classification&displayvalue=blue">Blue</a>
      <br />
    </div>


    <p>
      <button id="filter-button" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#filterAge" aria-expanded="false" aria-controls="filterAge">View Age</button>
    </p>


    <div class="collapse" id="filterAge">
      <h5>Filter by an Age</h5>
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=age&min=1&max=4">1-4 Months</a>
      <br />
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=age&min=5&max=14">5-14 Months</a>
      <br />
      <a class="dropdown-item" href="<?php echo BASE_URL; ?>index.php?displayby=age&min=15&max=24">15-24 Months</a>
      <br />
    </div>











    <?php
    //////////////////////////////////////// ALPHABETICAL LIST WITH HEADINGS
    // from http://www.webhostingtalk.com/showthread.php?t=717692
    // user "bigfan"

    // echo "<h3>Alphabetical List</h3>";

    /*Mysql Left Function is used to return the leftmost string character from the string.
Column Alias: 
http://www.geeksengine.com/database/basic-select/column-alias.php

*/

    ///////////////////////////////////////////

    ////////////////////////////////////////// ALPHABETICAL A - Z LINKS
    echo "<h5>Alphabetical</h5>";

    $qry = "SELECT *, LEFT(cheese, 1) AS first_char FROM cheese_db 
        WHERE UPPER(cheese) BETWEEN 'A' AND 'Z'
        ORDER BY cheese";

    $result = mysqli_query($con, $qry);
    $current_char = '';
    while ($row = mysqli_fetch_assoc($result)) {
      if ($row['first_char'] != $current_char) {
        $current_char = $row['first_char'];
        $thisChar = strtoupper($current_char);
        echo "<a href=\"" . BASE_URL . "index.php?displayby=cheese&displayvalue=$thisChar%\">$thisChar</a> | ";
      }
    }

    ?>

  </div>
</div>