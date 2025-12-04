function likePost(postId){
  const likeButton = document.querySelector(`.btn-like-toggle[data-post-id='${postId}']`);
  const countLikesSpan = document.querySelector(`span[data-post-id='${postId}']`);
  const estatus = likeButton.getAttribute('aria-pressed');
  let url;
  let icon;
  if(estatus === 'true'){
    url = `/posts/${postId}/unlike`;
    icon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart text-danger" viewBox="0 0 16 16">
              <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15"/>
            </svg>`;
  } else {
    url = `/posts/${postId}/like`;
    icon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill text-danger" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"/>
            </svg>`;
  }
  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: document.querySelector('[name="_token"]').value
    },
    success: function(response) {
      if(response.estatus === 'isLiked'){
        likeButton.setAttribute('aria-pressed', 'true');
      } else {
        likeButton.setAttribute('aria-pressed', 'false');
      }
      likeButton.innerHTML = icon;
      countLikesSpan.textContent = response.likes_count;
    },
    error: function(xhr) {
      console.error('Error toggling like:', xhr);
    }
  });
}

function likePostButton(){
  const likeButtons = document.querySelectorAll('.btn-like-toggle');
  likeButtons.forEach(button => {
    button.addEventListener('click', event => {
      event.preventDefault();
      const postId = button.getAttribute('data-post-id');
      likePost(postId);
    });
  });
}

function likeComment(commentId){
  const likeButton = document.querySelector(`.btn-like-toggle--comment[data-comment-id='${commentId}']`);
  const postId = likeButton.getAttribute('data-post-id');
  const countLikesSpan = document.querySelector(`span[data-comment-id='${commentId}']`);
  const estatus = likeButton.getAttribute('aria-pressed');
  let url;
  let icon;
  if(estatus === 'true'){
    url = `/posts/${postId}/comments/${commentId}/unlike`;
    icon = `<i class="bi bi-heart text-danger"></i>`;
  } else {
    url = `/posts/${postId}/comments/${commentId}/like`;
    icon = `<i class="bi bi-heart-fill text-danger"></i>`;
  }
  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: document.querySelector('[name="_token"]').value
    },
    success: function(response) {
      if(response.estatus === 'isLiked'){
        likeButton.setAttribute('aria-pressed', 'true');
      } else {
        likeButton.setAttribute('aria-pressed', 'false');
      }
      likeButton.innerHTML = icon;
      countLikesSpan.textContent = response.likes_count;
    },
    error: function(xhr) {
      console.error('Error toggling like on comment:', xhr);
    }
  });
}

function likeCommentButton(){
  const likeButtons = document.querySelectorAll('.btn-like-toggle--comment');
  likeButtons.forEach(button => {
    button.addEventListener('click', event => {
      event.preventDefault();

      const commentId = button.getAttribute('data-comment-id');
      likeComment(commentId);
    });
  });
}

function setupLikeButtons(){
  likePostButton();
  likeCommentButton();
}

document.addEventListener('DOMContentLoaded', () => {
  setupLikeButtons();
});

document.addEventListener('content-loaded', setupLikeButtons);