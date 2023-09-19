$(document).ready(function () {
  $("#addProductForm").submit(function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "add-product.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        alert("Produkt erfolgreich hinzugefügt!");
        $("#name").val("");
        $("#price").val("");
        $("#quantity").val("");
        $("#description").val("");
        $("#image").val("");
      },
      error: function (xhr, status, error) {
        alert("Fehler beim Hinzufügen des Produkts: " + error);
      },
    });
  });
});
