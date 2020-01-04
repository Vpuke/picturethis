"use strict";

const editPost = document.querySelector(".updatePostContent");
const postContent = document.querySelector(".postContent");
const postImages = document.querySelectorAll(".profilePostSrc");

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
