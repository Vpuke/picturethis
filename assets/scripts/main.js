"use strict";

const likeForms = document.querySelectorAll(".likeForm");
const likeButtons = document.querySelectorAll(".button-liked");

// Like function, using Json so I dont have to update page on buttonclick.
// Also changes color of heart on Like.

likeForms.forEach(likeForm => {
  likeForm.addEventListener("submit", event => {
    event.preventDefault();

    const formData = new FormData(likeForm);

    fetch("app/posts/likes.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(json => {
        let likeCount = document.querySelector(
          `.likeCount${likeForm[0].value}`
        );
        likeCount.innerText = json;

        const id = event.target.dataset.id;

        const likeButtons = document.querySelectorAll(`.like[data-id="${id}"]`);

        likeButtons.forEach(likeButton => {
          likeButton.classList.toggle("hidden");
        });
      });
  });
});
