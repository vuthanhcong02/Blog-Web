$(document).ready(function() {
    $("#likeButton").on("click", function() {
        var postId = $(this).closest("form").find("#likeButton").data("post");

        $.ajax({
            url: "/blogs/post/like",
            type: "POST",
            data: {
                post_id: postId,
                _token: "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $('.like-count').text(response.likeCount);
                // Cập nhật số lượng "Like" và giao diện người dùng tại đây
                // Ví dụ: $("#likeCount").text(response.likeCount);
            }
        });
    });


});
