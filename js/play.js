// const video_player = document.querySelector('#player'),
//     mainVideo = video_player.querySelector('#main-video'),
//     player_control_bar = video_player.querySelector('.player-control-bar'),
//     player_control_tip = video_player.querySelector('.player-control-tip'),
//     player_prev_control = video_player.querySelector('.player-prev-control'),
//     player_replay_control = video_player.querySelector('.player-replay-control'),
//     player_play_control = video_player.querySelector('.player-play-control'),
//     player_play = video_player.querySelector('.player-play'),
//     player_forward_control = video_player.querySelector('.player-forward-control'),
//     player_next_control = video_player.querySelector('.player-next-control'),
//     player_volume_control = video_player.querySelector('.player-volume-control'),
//     change_icon_volume = video_player.querySelector('.change-icon-volume'),

//     player_current = video_player.querySelector('.player-current'),
//     player_duration = video_player.querySelector('.player-duration'),
//     player_progress_holder = video_player.querySelector('.player-progress-holder'),
//     player_play_progress = video_player.querySelector('.player-play-progress'),
//     player_seek_handle = video_player.querySelector('.player-seek-handle'),
//     player_light_control = video_player.querySelector('.player-light-control'),
//     picture_in_picture_control = video_player.querySelector('.picture-in-picture-control'),
//     player_setting_control = video_player.querySelector('.player-setting-control'),
//     player_fullscreen_control = video_player.querySelector('.player-fullscreen-control'),
//     player_board = video_player.querySelector('.player-board'),
//     player_board_close = video_player.querySelector('.player-board-close'),
//     setting_selector = video_player.querySelector('.setting-selector'),
//     setting_server = video_player.querySelector('.setting-server'),
//     setting_quality = video_player.querySelector('.setting-quality'),
//     ssetting_speed = video_player.querySelector('.setting-speed');

// function playVideo() {
//     player_play_control.innerHTML = "pause";
//     // player_play_control.title = "Pause";

//     video_player.classList.add('pause')
//     mainVideo.play();
// }

// function pauseVideo() {
//     player_play_control.innerHTML = "play_arrow";
//     // player_play_control.title = "Play";
//     video_player.classList.remove('pause')
//     mainVideo.pause();
// }
// player_play_control.addEventListener('click', () => {
//     const isVideoPause = video_player.classList.contains('pause');

//     isVideoPause ? pauseVideo() : playVideo();
// })

// mainVideo.addEventListener('play', () => {
//     playVideo();
// })

// mainVideo.addEventListener('pause', () => {
//     pauseVideo();
// })

// player_replay_control.addEventListener('click', () => {
//     mainVideo.currentTime -= 10;
// })

// player_forward_control.addEventListener('click', () => {
//     mainVideo.currentTime += 10;
// })


// // var hover_icons_volume = document.getElementById('hover-volume');
// // hover_icons.onmouseover = function() {
// //     hover_icons_volume.style.display = "block";
// //     hover_icons_volume.style.visibility = "visible";
// // };

// // hover_icons.onmouseout = function() {
// //     hover_icons.style.display = "none";
// //     hover_icons.style.visibility = "hidden";
// // };

// // function showplayVideo() {
// //     player_play.innerHTML = "<div  id= 'hover_play' class='player-control-tip' style='display:none;visibility:show; '><span>Phát</span></div><i class='material-icons player-play-control'>play_arrow</i>";
// //     // player_play_control.title = "Pause";

// //     video_player.classList.add('pause')
// //     mainVideo.play();
// // }

// mainVideo.addEventListener("loadeddata", (e) => {
//     let videoDuration = e.target.duration;
//     let totalMin = Math.floor(videoDuration / 60);
//     let totalSec = Math.floor(videoDuration % 60);

//     totalSec < 10 ? totalSec = "0" + totalSec : totalSec;
//     player_duration.innerHTML = `<span>${totalMin} : ${totalSec}</span>`
// })

// mainVideo.addEventListener("timeupdate", (e) => {
//     let currentVideoTime = e.target.currentTime;
//     let currenMin = Math.floor(currentVideoTime / 60);
//     let currenSec = Math.floor(currentVideoTime % 60);

//     currenSec < 10 ? currenSec = "0" + currenSec : currenSec;
//     player_current.innerHTML = `<span>${currenMin} : ${currenSec}</span>`

//     let videoDuration = e.target.duration
//     let progressWidth = (currentVideoTime / videoDuration) * 100;
//     player_play_progress.style.width = `${progressWidth}%`
//     player_seek_handle.style.left = `${progressWidth}%`

// })

// player_progress_holder.addEventListener('click', (e) => {
//     let videoDuration = mainVideo.duration;
//     let progressWidthval = player_progress_holder.clientWidth;
//     let ClickOffsetX = e.offsetX;
//     mainVideo.currentTime = (ClickOffsetX / progressWidthval) * videoDuration;
// })

// change_Volume();

function change_Volume() {
    // let volume_handle = video_player.querySelector('.volume-handle');
    // let volume_current = video_player.querySelector('.volume-current');
    // volume_current = volume_current.offsetHeight;
    // volume_handle = volume_handle.offsetHeight;
    // console.log(volume_current);
    // console.log(volume_handle);
    // mainVideo.volume = player_volume_control.value / 100;
    // if (player_volume_control.value == 0) {
    //     volume.innerHTML = "volume_off";
    // } else if (player_volume_control.value < 40) {
    //     volume.innerHTML = "volume_down";
    // } else {
    //     volume.innerHTML = "volume_up";
    // }
    // let volume_video = 100;

    // let volume_change = 

    // volume_current.style.height = `${volume_change}%`
    // volume_handle.style.bottom = `${volumeBottom}%`
}

// player_volume_control.addEventListener('change', (e) => {
//     change_Volume();
// })

// picture_in_picture_control.addEventListener('click', () => {
//     mainVideo.requestPictureInPicture();
// })

// player_fullscreen_control.addEventListener('click', () => {
//     if (!video_player.classList.contains('openFullScreen')) {
//         video_player.classList.add('openFullScreen')
//         player_fullscreen_control.innerHTML = "fullscreen_exit";
//         video_player.requestFullscreen();
//     } else {
//         video_player.classList.remove('openFullScreen')
//         player_fullscreen_control.innerHTML = "fullscreen";
//         document.exitFullscreen();
//     }
// })

//--------------------------------------------------------------------------------------------
function session_click(e) {
    var id_ss = e.getAttribute('data-id');
    var id_mv = document.getElementById('id_movie').value;
    var change_html = document.getElementById('list_movie_ss');
    var list_ss = document.querySelectorAll('.season-item');
    var list_ss_current = document.querySelectorAll('.season-active');
    document.querySelector('.season-list').classList.remove('activated');
    $.each(list_ss, function(k, value) {
        var id_item_ss = value.getAttribute('data-id');
        if (id_item_ss == id_ss) {
            value.classList.add('activated')
            list_ss_current[k].classList.add('activated')
            list_ss_current[k].classList.remove('hidden')
        } else {
            value.classList.remove('activated')
            list_ss_current[k].classList.remove('activated')
            list_ss_current[k].classList.add('hidden')
        }
    })
    $.ajax({
        url: "action_ajax_id_mv_ss.php",
        type: "POST",
        data: { id_session: id_ss, id_movie: id_mv },
        success: function(data) {
            change_html.innerHTML = data;
        }
    })
}
//-----------------------------------------------------------------------------------------
// function avatar_click() {
//     var id_user = e.getAttribute('data-id');
//     var id_mv = document.getElementById('id_movie').value;
//     var change_html = document.getElementById('list_movie_ss');

//     $.ajax({
//         url: "action_ajax_id_mv_ss.php",
//         type: "POST",
//         data: { id_session: id_user, id_movie: id_mv },
//         success: function(data) {
//             change_html.innerHTML = data;
//         }
//     })
// }
//-----------------------------------------------------------------------------------------

// var hover_icon1 = document.querySelector('.hover_icon1');
// var hover_play = document.getElementById('hover_play');

// hover_icon1.addEventListener('mouseover', function() {
//     hover_play.style.display = "block";
//     hover_play.style.visibility = "visible";
// })

// hover_icon1.addEventListener('mouseout', function() {
//     hover_play.style.display = "none";
//     hover_play.style.visibility = "hidden";
// })

// var hover_icon2 = document.querySelector('.hover_icon2');
// var hover_next = document.getElementById('hover_next');

// hover_icon2.addEventListener('mouseover', function() {
//     hover_next.style.display = "block";
//     hover_next.style.visibility = "visible";
// })

// hover_icon2.addEventListener('mouseout', function() {
//     hover_next.style.display = "none";
//     hover_next.style.visibility = "hidden";
// })

// var hover_icon3 = document.querySelector('.hover_icon3');
// var hover_prev = document.getElementById('hover_prev');

// hover_icon3.addEventListener('mouseover', function() {
//     hover_prev.style.display = "block";
//     hover_prev.style.visibility = "visible";
// })

// hover_icon3.addEventListener('mouseout', function() {
//     hover_prev.style.display = "none";
//     hover_prev.style.visibility = "hidden";
// })

// var hover_icon4 = document.querySelector('.hover_icon4');
// var hover_replay = document.getElementById('hover_replay');

// hover_icon4.addEventListener('mouseover', function() {
//     hover_replay.style.display = "block";
//     hover_replay.style.visibility = "visible";
// })

// hover_icon4.addEventListener('mouseout', function() {
//     hover_replay.style.display = "none";
//     hover_replay.style.visibility = "hidden";
// })

// var hover_icon5 = document.querySelector('.hover_icon5');
// var hover_forward = document.getElementById('hover_forward');

// hover_icon5.addEventListener('mouseover', function() {
//     hover_forward.style.display = "block";
//     hover_forward.style.visibility = "visible";
// })

// hover_icon5.addEventListener('mouseout', function() {
//     hover_forward.style.display = "none";
//     hover_forward.style.visibility = "hidden";
// })

// var hover_icon6 = document.querySelector('.hover_icon6');
// var hover_sunny = document.getElementById('hover_sunny');

// hover_icon6.addEventListener('mouseover', function() {
//     hover_sunny.style.display = "block";
//     hover_sunny.style.visibility = "visible";
// })

// hover_icon6.addEventListener('mouseout', function() {
//     hover_sunny.style.display = "none";
//     hover_sunny.style.visibility = "hidden";
// })

// var hover_icon7 = document.querySelector('.hover_icon7');
// var hover_picture = document.getElementById('hover_picture');

// hover_icon7.addEventListener('mouseover', function() {
//     hover_picture.style.display = "block";
//     hover_picture.style.visibility = "visible";
// })

// hover_icon7.addEventListener('mouseout', function() {
//     hover_picture.style.display = "none";
//     hover_picture.style.visibility = "hidden";
// })

// var hover_icon9 = document.querySelector('.hover_icon9');
// var hover_full = document.getElementById('hover_full');

// hover_icon9.addEventListener('mouseover', function() {
//     hover_full.style.display = "block";
//     hover_full.style.visibility = "visible";
// })

// hover_icon9.addEventListener('mouseout', function() {
//     hover_full.style.display = "none";
//     hover_full.style.visibility = "hidden";
// })

//-------------------------------------------------------------------------


var like = document.getElementById("id_mv_like");
var folow = document.getElementById("id_mv_folow");
var id_ur = document.querySelector(".id_ur").value;
id_mv = like.getAttribute('data-movie');
// var click_like = document.querySelector(".count-box");
// var change_color = document.querySelector(".change_color");
// var change_color_fl = document.querySelector(".change_color_fl");


like.addEventListener('click', function() {
    if (!id_ur.value) {
        window.location = "login.php";
    }

    url = 'check_like.php';
    check_like_folow(url, id_mv, id_ur, 'like');


})


folow.addEventListener('click', function() {
    if (!id_ur.value) {
        window.location = "login.php";
    }
    url = 'check_folow.php';
    check_like_folow(url, id_mv, id_ur, 'folow');
})

function check_like_folow(url, id_mv, id_ur, like_or_folow) {
    $.ajax({
        url: url,
        type: 'POST',
        data: { id_movie: id_mv, id_user: id_ur },
        success: function(data) {
            change_color_icon(data, like_or_folow);
        }
    });
}

function change_color_icon(check, like_or_folow) {

    if (like_or_folow == 'like') {
        change_color = document.querySelector(".change_color");
        click_like = document.querySelector(".count-box");
        color = "#e50d1e";
    } else {
        change_color = document.querySelector(".change_color_fl");
        click_like = document.querySelector(".count-box-fl");
        color = "#00ffe7";

    }
    sl = click_like.innerText;

    if (check == 'add') {
        change_color.style.color = color;
        click_like.innerHTML = Number(sl) + 1;

    } else {
        change_color.style.color = "white";
        click_like.innerHTML = Number(sl) - 1;
    }
}

//---------------------------------------------------------------

comment_send = document.querySelector(".comment-send");

comment_send.addEventListener('click', function() {
    ct = document.getElementById('comment-content')
    $.ajax({
        url: 'send_comment.php',
        type: 'POST',
        data: { id_user: id_ur, content: ct, id_movie: id_mv },
        success: function() {}

    });
})