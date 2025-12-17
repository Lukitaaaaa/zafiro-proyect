function addComment(){
    const postId = $('#post').data('post-id');

    $('#addCommentBtn').prop('disabled', true);
    $('#content').on('input', function() {
        $('#addCommentBtn').prop('disabled', $(this).val().trim() === '');
    });

    $("#commentForm").submit(function(event){
        event.preventDefault(); // Prevent default form submission
        $('#addCommentBtn').prop('disabled', true); // Disable the submit button to prevent multiple submissions
        $('#button-text').addClass('d-none'); // Hide button text
        $('#spinner').removeClass('d-none'); // Show loading spinner

        setTimeout(() => {
            $('#button-text').removeClass('d-none'); // Show button text
            $('#spinner').addClass('d-none'); // Hide loading spinner
        }, 1000); // Simulate a delay for demonstration purposes

        $.ajax({
            
            type: 'POST',
            url: `/posts/${postId}/comments`,
            data: $(this).serialize(),
            success: function(response){
                if(response.success){
                    console.log('Comment added:', response);

                    // Clear the input field
                    $('#content').val('');

                    // Optionally, append the new comment to the comments list
                    $('.comments-box').prepend(response.comment_html);

                    //increment total comments 
                    $('#commentsCounter').text(parseInt($('#commentsCounter').text()) + 1);

                    // Remove message if exists
                    $('#noCommentsMessage').addClass('d-none');

                }
            },
            error: function(){
                $("#response").html("Error submitting form.");
            },
            complete: function(){
                addReply(); // Re-bind reply forms
                deleteComment(); // Re-bind delete buttons
            }
        });
    });
}

function addReply(){

    const comments = $('.comments-box').children();
    // console.log(comments);
    comments.each(function(){
        const id = $(this).data('comment-id');
        const form = $(this).find('.form');
        const input = form.find('input[name="content"]');
        const button = form.find('button[type="submit"]');
        const line = $(this).find('.line');
        const repliesBtn = $(this).find('.show-replies');
        const repliesCounter = repliesBtn.find('#repliesCounter');
        const repliesContainer = $(this).find('.replies').get(0);

        $(button).prop('disabled', true);
        // Enable/disable button based on input
        $(input).on('input', function() {
            $(button).prop('disabled', $(this).val().trim() === '');
        });

        $(form).submit(function(event){
            event.preventDefault(); // Prevent default form submission

            $(button).prop('disabled', true); // Disable the submit button to prevent multiple submissions
            $(button).find('#button-text').addClass('d-none'); // Hide button text
            $(button).find('#spinner').removeClass('d-none'); // Show loading spinner

            setTimeout(() => {
                $(button).find('#button-text').removeClass('d-none'); // Show button text
                $(button).find('#spinner').addClass('d-none'); // Hide loading spinner
            }, 1000); // Simulate a delay for demonstration purposes

            $.ajax({
                type: 'POST',
                url: `/comments/${id}/reply`,
                data: $(this).serialize(),
                success: function(response){
                    if(response.success){
                        console.log('Reply added:', response);
                        // Clear the input field
                        $(input).val('');

                        // OPTION, increment total comments
                        // $('#commentsCounter').text(parseInt($('#commentsCounter').text()) + 1);

                        // increment total replies for the comment
                        repliesCounter.text(parseInt(repliesCounter.text()) + 1);

                        // Add reply to replies container
                        repliesContainer.insertAdjacentHTML('beforeend', response.reply_html);
                        // repliesContainer.prepend(response.reply_html);

                        // Show/hide replies button
                        repliesBtn.removeClass('d-none');

                        // Show the line
                        $(line).removeClass('d-none');
                    }
                },
                error: function(){
                    console.log("Error submitting reply form.");
                },
                complete: function(){
                    deleteComment(); // Re-bind delete buttons
                }
            });
        });
    });
}

function deleteComment(){
    const comments = $('.comment');
    // console.log(comments);
    comments.each(function(){
        const id = $(this).data('comment-id');

        const parentId = $(this).data('parent-id');
        const commentParent = $(`article[data-comment-id='${parentId}']`);
        // const deleteBtn = $(`button.btn-delete-comment[data-comment-id='${id}']`);
        const form = $(this).find(`#deleteForm${id}`);
        const line = $(commentParent).find('.line');
        const repliesBtn = $(commentParent).find('.show-replies');
        const repliesCounter = repliesBtn.find('#repliesCounter');

        $(form).submit(function(event){
            event.preventDefault();
            $.ajax({
                url: `/comments/${id}`,
                type: 'DELETE',
                data: $(this).serialize(),
                success: function(response) {
                    // Remove the comment from the DOM
                    $(`article[data-comment-id='${id}']`).remove();
                    if(response.is_reply){
                        // Decrement replies count
                        repliesCounter.text(parseInt(repliesCounter.text()) - 1);
                        // If no more replies, hide replies button
                        if(repliesCounter.text() == '0'){
                            repliesBtn.addClass('d-none');
                            line.addClass('d-none');
                        }
                    } else {
                        // Decrement total comments count
                        $('#commentsCounter').text(parseInt($('#commentsCounter').text()) - 1);
                        // If no more comments, show "No comments yet" message
                        if($('#commentsCounter').text() == '0'){
                            $('#noCommentsMessage').removeClass('d-none');
                        }
                    }
                },
                error: function(xhr) {
                    console.error('Error disabling delete button:', xhr);
                }
            });
        });
    });
}

function ShowHideReplies(){
    $(document).on('click', '.show-replies', function(e){
        e.preventDefault();
        console.log('Show/hide replies clicked');
        const commentId = $(this).data('comment-id');
        const repliesList = $(`.replies[data-comment-id="${commentId}"]`);
        $(repliesList).toggleClass('d-none');
        const spans = $(this).find('span');
        spans.each(function(){
            $(this).toggleClass('d-none');
        });
        // const line = $(`article[data-comment-id='${commentId}']`).find('.line');
        // $(line).toggleClass('d-none');
    });
}

function toggleReplyForm(){
    $(document).on('click', '.reply', function(e){
        e.preventDefault();
        const commentId = $(this).data('comment-id');
        console.log('Reply button clicked for comment ID:', commentId);
        const form = $(`.form[data-comment-id="${commentId}"]`);
        $(form).toggleClass('d-none');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    addComment();
    addReply();
    deleteComment();
    ShowHideReplies();
    toggleReplyForm();
});

document.addEventListener('content-loaded', function() {
    addComment();
    addReply();
    deleteComment();
    ShowHideReplies();
    toggleReplyForm();
});