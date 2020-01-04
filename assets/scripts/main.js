"use strict";

// Showing information on image click, profile page.
const editPost = document.querySelector(".updatePostContent");
const postContent = document.querySelector(".postContent");
const postImages = document.querySelectorAll(".profilePostSrc");
const likeForms = document.querySelectorAll(".likeForm");

postImages.forEach(postImage =>
  postImage.addEventListener("click", event => {
    // postContent.classList.toggle("hidden");
    // console.log(event.target.dataset.id);
    const id = event.target.dataset.id;
    const imageInfo = document.querySelector(`.postContent[data-id="${id}"]`);
    imageInfo.classList.toggle("hidden");

    const editPost = document.querySelector(
      `.updatePostContent[data-id="${id}"]`
    );
    editPost.classList.toggle("hidden");
  })
);

likeForms.forEach(likeForm => {
  likeForm.addEventListener("submit", event => {
    event.preventDefault();

    const formData = new FormData(likeForm);
    console.log(likeForm);

    fetch("app/posts/likes.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(json => console.log(json));
  });
});
