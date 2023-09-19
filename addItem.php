 <!DOCTYPE html>
<html>
  <head>
    <title>Add item</title>
    <link rel="stylesheet" type="text/css" href="../AddItem.css" />
   <h1>Add Item</h1>




    <div class="container">
      <form
        action="http://localhost/add_product.php"
        method="post"
        enctype="multipart/form-data" id="addProductForm"
      >
        <h1>Add item</h1>
 
        <label for="name">Name</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Geben Sie hier den Namen des Artikels ein"
          required
        />

        <label for="price">Price</label>
        <input
          type="number"
          id="price"
          name="price"
          placeholder="Geben Sie hier den Preis des Artikels ein"
          step="0.01"
          min="0"
          required
        />

        <label for="quantity">Quantity</label>
        <input
          type="number"
          id="quantity"
          name="quantity"
          placeholder="Geben Sie hier die Menge des Artikels ein"
          min="1"
          required
        />

        <label for="description">Description</label>
        <textarea
          id="description"
          name="description"
          placeholder="Geben Sie hier eine Beschreibung des Artikels ein"
          required
        ></textarea>

        <label for="image">Image</label>
        <input type="file" id="image" name="image" accept="image/*" required />

        <button type="submit" class="btn">Add item</button>
      </form>
    </div>
    
  </body>
</html>
