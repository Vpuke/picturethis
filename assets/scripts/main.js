"use strict";

// Showing information on image click, profile page.
const editPost = document.querySelector(".updatePostContent");
const postContent = document.querySelector(".postContent");
const postImages = document.querySelectorAll(".profilePostSrc");
const likeForms = document.querySelectorAll(".likeForm");
const likeButtons = document.querySelectorAll(".button-liked");

postImages.forEach(postImage =>
  postImage.addEventListener("click", event => {
    const id = event.target.dataset.id;
    const imageInfo = document.querySelector(`.postContent[data-id="${id}"]`);
    imageInfo.classList.toggle("hidden");

    const editPost = document.querySelector(
      `.updatePostContent[data-id="${id}"]`
    );
    editPost.classList.toggle("hidden");
  })
);

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
