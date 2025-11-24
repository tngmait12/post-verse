<?php
    $query = "SELECT count(*)
                FROM comments
                WHERE post_id = ?";

    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 's', $post_result['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_cmt = mysqli_fetch_row($result)[0];
?>

<div id="comment-title" class="text-center border-bottom order-first">
    <h3 class="d-inline">Comment</h3>
</div>

<div id="display-comments" class="flex-fill p-2 order-sm-last"></div>

<div id="write-comment" class="order-first order-lg-last" class="border-top">
    <form id="post-cmt" class="d-flex p-3">
        <textarea id="input-cmt" type="text" class="flex-fill" rows="1" name="cmt" placeholder="viết bình luận..." style="border: none; border-bottom: 2px black solid; outline: none; resize: none;"></textarea>
        <input id="post-id" type="hidden" name="post_id" value="<?= $post_result['id'] ?>">
        <input id="reply" type="hidden" name="reply" value="">
        <button type="submit" name="submit" class="ml-3"
            style="
                background-color: #1877F2; 
                color: white; 
                width: 35px; 
                height: 35px; 
                border: none; 
                border-radius: 50%; 
                display:flex; 
                justify-content: center; 
                align-items: center;"
        >
            <i class="bi bi-chat-fill"></i>
        </button>
    </form>
</div>

<script>
    form = document.getElementById('post-cmt')
    input_cmt = form.querySelector('#input-cmt')
    input_reply =form.querySelector('#reply')
    d_comment = document.getElementById('display-comments')

    function reset_form() {
        input_reply.value = ''
        input_cmt.value = ''
        input_cmt.placeholder = 'viết bình luận...'
    }
    
    function load_comment(id) {

        const xhr = new XMLHttpRequest()
        xhr.open('GET', 'features/display-comment.php?id=' + id, true)
        xhr.onload = function () {
            if (xhr.status === 200) {
                d_comment.innerHTML = xhr.responseText
            }
        }
        xhr.send()
    }
    
    document.addEventListener('submit', function (e) {
        if (e.target && e.target.id === 'post-cmt') {
            e.preventDefault()

            const formData = new FormData(e.target);
            fetch('features/post-comment.php', { method: 'POST', body: formData })
            .then(res => res.text())
            .then(data => {
                e.target.reset()
                load_comment(<?= $post_result['id'] ?>)
                console.log(data)
            })
            .catch(error => { 
                console.error('error: ' + error) 
            })
            reset_form()
        }
    })

    document.addEventListener('click', function (e) {
        const clickInsideForm = form.contains(e.target) || d_comment.contains(e.target)
        if (!clickInsideForm) {
            reset_form()
        }
    })
    
    load_comment(<?= $post_result['id'] ?>)

    function expand_reply(id) {
        replies_section = document.getElementById('replies-' + id)
        
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'features/reply-comment.php?parent_id=' + id, true)
        xhr.onload = function () {
            if (xhr.status === 200) {
                replies_section.innerHTML = xhr.responseText
            }
        }
        xhr.send()
    }

    function collase_reply(id, num_replies) {
        replies_section = document.getElementById('replies-' + id)
        txt = "<a id='expand-"+id+"' onclick='expand_reply("+id+")'>Mở rộng - "+num_replies+" bình luận</a>"
        
        replies_section.innerHTML = txt
    }

    function replyCmt(reply_id, name) {
        input_cmt.placeholder = 'Trả lời bình luận của ' + name  + '...'
        input_cmt.focus()
        input_reply.value = reply_id
        console.log(input_reply.value)
    }
</script>

<style>
    div#display-comments {
        height: 80vh;
        overflow-y: auto;
    }

    div.comment-box {
        width: 100%;
        color: black;
        background-color: #f2eeed;
        padding: 5px;
        border-radius: 10px;
    }

    div.name-field {
        border-bottom: 1px black solid;
        font-weight: bolder;
    }

    div.content-field {
        margin: 0;
        padding: 0;
        white-space: pre-line;
        line-height: 1.5;
    }

    div.reply-section > a {
        cursor: pointer;
    }

    div.reply-box {
        border-left: 2px gray solid;
    }
</style>