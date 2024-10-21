document.addEventListener("DOMContentLoaded", () => {
    document
      .getElementById("contact-form")
      .addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent form from submitting the default way
  
        var formData = new FormData(this);
  
        fetch("https://api.web3forms.com/submit", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.success) {
              Swal.fire({
                title: "Thank you!",
                text: "Your message has been sent successfully. We will get back to you soon.",
                icon: "success",
              });
            } else {
              // popup.textContent = 'There was an error submitting the form: ' + data.message;
              Swal.fire({
                title: "Error!",
                text: "There was an error submitting the form: " + data.message,
                icon: "error",
              });
            }
            popup.style.display = "block";
          })
          .catch((error) => {
            var popup = document.getElementById("popup");
            popup.textContent =
              "There was an error submitting the form: " + error.message;
            popup.style.display = "block";
          });
      });
      var scrollToBottomBtn = document.getElementById("contact-btn");
  
      scrollToBottomBtn.addEventListener("click", function (event) {
        event.preventDefault();
        window.scrollTo({
          top: document.body.scrollHeight,
          behavior: "smooth",
        });
      });
    });