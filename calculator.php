<?php
$page_title = 'Cost Calculator';
include ('header.html');

function calculate_total ($qty, $price,$tax = 20)
{
  $total = ($qty * $price);
  $taxrate = ($tax / 100);
  $total += ($total * $taxrate);

return number_format($total, 2);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // if quantity & price is numeric
    if (is_numeric($_POST['quantity']) && is_numeric($_POST['price']))
    {
      if(($_POST['quantity']) < 1)
      {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Quantity is < 1.</p>';
      }
      if(($_POST['price']) < 0.01)
      {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Price is < 0.01.</p>';
      }
      else
      {
      echo '<h3>Total Cost</h3>';
      // if tax is numeric
      if (is_numeric($_POST['tax']))
      {
        // is numeric and less than 0
        if(($_POST['tax']) < 0)
        {
          echo '<h3 class="error">Error!</h3>
          <p class="error">Tax is < 0.</p>';
        }
        // is numeric and greater than 0
        if(($_POST['tax']) > 0 )
        {
          $sum = calculate_total ($_POST['quantity'], $_POST['price'], $_POST['tax']);
          echo '<p>The total cost of purchasing ' . $_POST['quantity'] .' product(s) at &pound;' . number_format ($_POST['price'], 2) . ' each, with tax, is &pound;' . $sum . '.</p>';
        }
      }

      // if tax is not numeric
      if(!is_numeric($_POST['tax']))
      {
        if(($_POST['tax']) == "")
        {
          $sum = calculate_total ($_POST['quantity'], $_POST['price']);
          echo '<p>The total cost of purchasing ' . $_POST['quantity'] .' product(s) at &pound;' . number_format ($_POST['price'], 2) . ' each, with tax, is &pound;' . $sum . '.</p>';
        }
        else
        {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Tax is not a numeric value.</p>';
        }
      }

      }
    }
    // if quantity & price is not numeric
    else
    {
      if(($_POST['quantity']) == "")
      {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Quantity is not set.</p>';
      }
      else
      {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Quantity is not a numeric value</p>';
      }

      if(($_POST['price']) == "")
      {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Price is not set.</p>';
      }
      else
      {
        echo '<h3 class="error">Error!</h3>
        <p class="error">Price is not a numeric value</p>';
      }
      // if tax is empty
      if(($_POST['tax']) != "")
      {
        // if tax is not numeric
        if(!is_numeric($_POST['tax']))
        {
          echo '<h3 class="error">Error!</h3>
          <p class="error">Tax is not a numeric value.</p>';
        }
        // if tax is numeric
        elseif(is_numeric($_POST['tax']))
        {
          // and tax is < 0
          if(($_POST['tax']) < 0)
          {
            echo '<h3 class="error">Error!</h3>
            <p class="error">Tax is < 0.</p>';
          }
        }
      }
    }
}
?>



<h3>Cost calculator</h3>
<form action="calculator.php" method="post">
  <p>Quantity: <input type="text" name="quantity" size="5" maxlength="5"value="<?php if (isset($_POST['quantity'])) echo $_POST['quantity']; ?>"/></p>
  <p>Price (&pound;): <input type="text" name="price" size="5" maxlength="10"value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" /></p>
  <p>Tax (%): <input type="text" name="tax" size="5" maxlength="5"value="<?php if (isset($_POST['tax'])) echo $_POST['tax']; ?>" />(optional)</p>
  <p><input type="submit" name="submit" value="Calculate the cost" /><input type="reset" name="reset" value="Clear Values" onClic = clear(); /></p>

</form>

<?php
include ('footer.html');
?>
