let maxlength = 25;

window.addEventListener('load', function () {
  let form = document.querySelector("form");
  let inputs = document.querySelectorAll('input[type="text"]');

  inputs.forEach((input) => {
    if (input.name !== "email" && input.name !== "old_email" && input.name !== "new_email" && input.name !== "searchBook") {
      input.oninput = function () {
        if (this.value.length > maxlength) {
          this.value = this.value.slice(0, maxlength);
        }
      };
    }
  });

  form.onsubmit = function (event) {
    inputs.forEach((input) => {
      if (input.name !== "searchBook") {
        let trimmedValue = input.value.trim();
        let singleSpacedValue = trimmedValue.replace(/\s+/g, " ");

        input.value = singleSpacedValue;
      }
    });
  };
});