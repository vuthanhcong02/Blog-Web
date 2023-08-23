// $(document).ready(function () {
//     $("#commentForm").submit(function (e) {
//         e.preventDefault(); // Ngăn chặn gửi biểu mẫu theo cách thông thường
//         var commentForm = $(this);
//         var formData = commentForm.serialize(); // Thu thập dữ liệu biểu mẫu
//         var postTitle = $("#commentForm").data("post-title");
//         var encodedTitle = encodeURIComponent(postTitle);
//         var commentUrl = "/blogs/" + encodedTitle;
//         //
//         $.ajax({
//             url: commentUrl, // Đường dẫn tới route xử lý comment
//             type: "POST",
//             data: formData,
//             dataType: "json", // Cho biết bạn đang gửi và mong đợi nhận dạng JSON
//             success: function (response) {
//                 if (response.status) {

//                     // Xử lý phản hồi JSON ở đây nếu comment thành công
//                     // console.log(response.comment);
//                     $('#commentForm')[0].reset();

//                     var newCommentHTML =
//                     '<div class="content" data-comment-id="' + response.comment.id + '">' +
//                     '<div class="d-flex flex-start align-items-center">' +
//                     '<img class="rounded-circle shadow-1-strong me-3 m-2" src="assets/images/avatar/default-avatar.jpeg alt="avatar" width="60" height="60" />' +
//                     '<div>' +
//                     '<h6 class="fw-bold">Cong</h6>' +
//                     '<p class="text-muted small mb-0">' + response.comment.created_at + '</p>' +
//                     '</div>' +
//                     '</div>' +
//                     '<p class="mt-2">' + response.comment.content + '</p>' +
//                     '<div class="small d-flex justify-content-start">' +
//                     '<a href="#!" class="d-flex align-items-center me-3 m-1">' +
//                     '<i class="bi bi-suit-heart"></i>' +
//                     '<p class="mb-0 p-2">Like</p>' +
//                     '</a>' +
//                     '<a class="d-flex align-items-center m-1 reply-cmt" style="cursor: pointer">' +
//                     '<i class="bi bi-reply "></i>' +
//                     '<p class="mb-0 p-2 ">Reply</p>' +
//                     '</a>' +
//                     '</div>' +
//                     '</div>';

//                     $("#comments-list").prepend(newCommentHTML);
//                     setupReplyEvents();

//                 } else {
//                     // Xử lý lỗi ở đây nếu comment không thành công
//                     console.log(response.errors);
//                 }
//             },
//             error: function (xhr, status, error) {
//                 // Xử lý lỗi AJAX ở đây
//                 console.error(error);
//             },
//         });
//     });
// });
