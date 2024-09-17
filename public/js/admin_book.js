let selectedAvailability = "";

window.addEventListener("load", function () {
  const availabilityButtons = document.querySelectorAll("#available button");

  availabilityButtons.forEach((button) => {
    button.addEventListener("click", async function () {
      selectedAvailability = this.getAttribute("data-available");

      const response = await fetch(
        "../../api/api_admin_books.php?availability=" + selectedAvailability
      );
      const books = await response.json();

      const container = document.querySelector("#bookTable");
      container.innerHTML = `<div class="noBooksColumnAdmin">
      <img src="../images/no_books.png" alt="" height="300em">
      <p>No books found!</p>
  </div>`;

      let aux = true;

      for (const book of books) {
        if (aux) {
          container.innerHTML = `
        <tr>
            <th>ID</th>
            <th>Seller</th>
            <th>Price</th>
            <th>Title</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Publisher</th>
            <th>Release Date</th>
            <th>Condition</th>
            <th>Tradeable</th>
            <th>Available</th>
        </tr>
        `;
          aux = false;
        }

        let isAvailableText = "";
        if (book.isAvailable === 0) {
          isAvailableText = "Removed";
        } else if (book.isAvailable === 1) {
          isAvailableText = "Available";
        } else {
          isAvailableText = "Sold";
        }

        let isTradeableText = book.isTradeable ? "Yes" : "No";

        container.innerHTML += `
        <tr>
            <td>${book.id}</td>
            <td>${book.seller}</td>
            <td>${book.price}</td>
            <td>${book.title}</td>
            <td>${book.author}</td>
            <td>${book.genre}</td>
            <td>${book.publisher}</td>
            <td>${book.releaseDate}</td>
            <td>${book.condition}</td>
            <td>${isTradeableText}</td>
            <td>${isAvailableText}</td>
            <td><a href="../../actions/admin_actions/delete_book.action.php?id=${book.id}"><button class = "editButton">Delete Book</button></a></td>
        </tr>
        `;
      }
    });
  });
});
