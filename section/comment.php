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
    <p class="d-inline"> - <?= $num_cmt ?> comments</p>
</div>

<div id="display-comments" class="flex-fill p-2 order-sm-last"></div>

<div id="write-comment" class="order-first order-lg-last" class="border-top">
    <form id="post-cmt" class="d-flex p-3">
        <input type="text" class="flex-fill" name="cmt" style="border: none; border-bottom: 2px black solid; outline: none;"/>
        <input type="hidden" name="post_id" value="<?= $post_result['id'] ?>">
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="30px" height="30px">
                <path d="M115.9 448.9C83.3 408.6 64 358.4 64 304C64 171.5 178.6 64 320 64C461.4 64 576 171.5 576 304C576 436.5 461.4 544 320 544C283.5 544 248.8 536.8 217.4 524L101 573.9C97.3 575.5 93.5 576 89.5 576C75.4 576 64 564.6 64 550.5C64 546.2 65.1 542 67.1 538.3L115.9 448.9zM153.2 418.7C165.4 433.8 167.3 454.8 158 471.9L140 505L198.5 479.9C210.3 474.8 223.7 474.7 235.6 479.6C261.3 490.1 289.8 496 319.9 496C437.7 496 527.9 407.2 527.9 304C527.9 200.8 437.8 112 320 112C202.2 112 112 200.8 112 304C112 346.8 127.1 386.4 153.2 418.7z" fill="white"/>
            </svg>
        </button>
    </form>
</div>

<script>
    function load_comment(id) {
        d_comment = document.getElementById('display-comments')

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
</script>

<style>
    div#display-comments {
        height: 75vh;
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

    div.reply-section > a {
        cursor: pointer;
    }

    div.reply-box {
        border-left: 2px gray solid;
    }
</style>