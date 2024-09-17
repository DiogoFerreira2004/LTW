let selectedGenre = "";
let selectedMaxPrice = -1;
let searchBook;

window.addEventListener("load", function () {
  const genreButtons = document.querySelectorAll("#genres button");
  const priceFilter = document.querySelector('#priceFilter');
  searchBook = document.querySelector("#searchBook");

  priceFilter.addEventListener('input', function () {
    selectedMaxPrice = this.value === '' ? -1 : this.value;
    if (searchBook) {
      searchBook.dispatchEvent(new Event("input"));
    }
  });

  genreButtons.forEach((button) => {
    button.addEventListener("click", function () {
      selectedGenre = this.getAttribute("data-genre");
      if (searchBook) {
        searchBook.value = "";
        searchBook.dispatchEvent(new Event("input"));
      }
    });
  });

  if (searchBook) {
    searchBook.addEventListener("input", async function () {
      if (this.value.length >= 3 || this.value.length === 0) {
        const response = await fetch(
          "../api/api_books.php?search=" +
            this.value +
            "&genre=" +
            selectedGenre +
            "&maxPrice=" +
            selectedMaxPrice
        );
        const books = await response.json();

        const container = document.querySelector(".bookContainer");
        container.innerHTML = "";

        for (const book of books) {
          container.innerHTML += `
            <article>
                <a href="../pages/profile.php?username=${book.seller}">
                    <p class="bookSeller">${book.seller}</p>
                </a>
                <a href="../pages/book.php?id=${book.id}">
                    <img src="../images/user_uploads/${book.imagePath}" class="bookPicture">
                    <p class="bookTitle">${book.title}</p>
                    <p class="bookPrice">${book.price}$</p>
                </a>
            </article>
          `;
        }
      }
    });
  }
});
