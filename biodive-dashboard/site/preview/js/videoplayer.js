showVideo = (videoFile) => {
  if (videoFile != '') {
    if ($('#video-player source').attr('src') != videoFile) {
      $('#video-player source').attr('src', videoFile);
      $('#video-player')[0].load();
    }
  }

  $('.video-background').show();
  $('#video-player')[0].play();
};

setVideo = (videoFile) => {
  $('#video-player source').attr('src', videoFile);
  $('#video-player')[0].load();
  showVideo();
};

hideVideo = () => {
  $('.video-background').hide();
  if ($('#video-player')[0] != null) {
    $('#video-player')[0].pause();
  }
};
