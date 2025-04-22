var host = window.location.origin + "/watcheno/";
$(document).ready(function () {
  if ($("input").hasClass("error")) {
    $($("input")).css({ border: "1px solid #f00 !important" });
  } else if ($("input").hasClass("valid")) {
    $($("input")).css({ border: "1px solid #008000 !important" });
  }

  $(".signup-form").validate({
    rules: {
      first_name: {
        required: true,
        maxlength: 12,
      },
      last_name: {
        required: true,
        maxlength: 12,
      },
      username: {
        required: true,
        minlength: 4,
        remote: {
          url: "../checkuser.php",
          type: "post",
          data: {
            username: function () {
              return $(".username_signup").val();
            },
          },
        },
      },
      email: {
        required: true,
        email: true,
        remote: {
          url: "../checkemail.php",
          type: "post",
          data: {
            email: function () {
              return $(".email").val();
            },
          },
        },
      },
      password: {
        required: true,
        minlength: 6,
        maxlength: 15,
      },
      rpassword: {
        required: true,
        equalTo: "#password",
      },
    },
    messages: {
      first_name: {
        required: "هذا الحقل ضروري",
        maxlength: "اقصى حد 12 حرف",
      },
      last_name: {
        required: "هذا الحقل ضروري",
        maxlength: "اقصى حد 12 حرف",
      },
      username: {
        required: "هذا الحقل ضروري",
        minlength: "ادنى حد 4 احرف",
        remote: "يوجد حساب بهذا المستخدم",
      },
      email: {
        required: "هذا الحقل ضروري",
        email: "هذا الايميل غير صحيح",
        remote: "هذا الايميل غير متاح ",
      },
      password: {
        required: "هذا الحقل ضروري",
        minlength: "ادنى حد 6 احرف",
        maxlength: "اقصى حد 15 حرف",
      },
      rpassword: {
        required: "هذا الحقل ضروري",
        equalTo: "كلمتان السر غير متطابقتان",
      },
    },
    submitHandler: submit_signup_form,
  });
  function submit_signup_form() {
    $.post(
      "../ajax_signup.php",
      {
        first_name: $(".first_name").val(),
        last_name: $(".last_name").val(),
        username: $(".username_signup").val(),
        email: $(".email").val(),
        password: $(".password").val(),
        rpassword: $(".rpassword").val(),
      },
      function (data, status) {
        $(".signup_notfication").html(data);
        $(".first_name").val("");
        $(".last_name").val("");
        $(".username_signup").val("");
        $(".email").val("");
        $("#password").val("");
        $(".rpassword").val("");
        $(".signup_notfication").show();
      }
    );
  }

  $(".signin-form").validate({
    rules: {
      username: {
        required: true,
      },
      password: {
        required: true,
      },
    },
    messages: {
      username: {
        required: "هذا الحقل ضروري",
      },
      password: {
        required: "هذا الحقل ضروري",
      },
    },
    submitHandler: submit_signin_form,
  });

  function submit_signin_form() {
    $.post(
      "ajax_signin.php",
      {
        username: $(".username-signin").val(),
        password: $(".password-signin").val(),
      },
      function (data, status) {
        console.log(data);
        if (data == 0) {
          $(".signin-notfaction").html(
            "الرجاء  التاكد من كلمة السر او  اسم المستخدم"
          );
          $(".signin-notfaction").show();
        } else if (data == 1) {
          window.location.replace(host + "dashboard.php");
        }
      }
    );
  }
  $(".home-header .navbar-nav2").height($(".home-header").height());
  $.validator.addMethod(
    "filesize",
    function (value, element, param) {
      return this.optional(element) || element.files[0].size <= param;
    },
    "الحد الاقصى  للصورة هو  2 ميجا بايت "
  );

  $("#upload_form").validate({
    rules: {
      video: {
        required: true,
        extension: "avi,mp4",
        filesize: 10100000,
      },
    },
    messages: {
      video: {
        extension: "<script>window.location.replace('404.php');</script>",
      },
    },
  });

  $(document).on("change", "#video", function () {
    if ($("#upload_form").valid()) {
      var pro = document.getElementById("video").files[0];
      $("#loader-icon").show();
      var form_data = new FormData();
      form_data.append("video", pro);
      $.ajax({
        url: "ajax_addvideo.php",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 11) {
            window.location.replace("404.php?error_ex=1");
          } else {
            $("#loader-icon").hide();
            $(".next").show();
            $(".cancel-button").show();
            $(".a").html(data);
          }
        },
      });
    }
  });
  $(".next").on("click", function () {
    window.location.replace("comvideo.php?id=" + $("#video_key").val());
  });
  $(".span i").click(function () {
    $("#video").click();
  });

  $(".home-addvideo .complete_video").validate({
    rules: {
      title_video: {
        required: true,
      },
      descr_video: {
        maxlength: 500,
      },
      thumbnail_video: {
        extension: "jpg,jpeg,png",
        filesize: 2100000,
      },
    },
    messages: {
      title_video: {
        required: "هذا الحقل ضروري",
      },
      descr_video: {
        maxlength: "الحد الاقصى 500 حرف",
      },
      thumbnail_video: {
        extension: "الصيغ المسموح بها هي  jpg,jpeg,png",
        filesize: "الحد الاقصى هو 2 ميجا بايت",
      },
    },
  });
  $(".upload .btn-success").on("click", function (e) {
    e.preventDefault();

    if ($(".complete_video").valid()) {
      var thumbnail = document.getElementById("thumbnail-video").files[0];

      var form_data_com = new FormData();
      form_data_com.append("thumbnail", thumbnail);
      form_data_com.append("title_video", $("#title-video").val());
      form_data_com.append("descr_video", $("#descr-video").val());
      form_data_com.append("video_key", $(".video-key").val());
      $.ajax({
        url: "ajax_comvideo.php",
        method: "POST",
        data: form_data_com,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 0) {
            window.location.replace("404.php");
          } else if (data == 11) {
            window.location.replace("404.php?error_ex=1");
          } else {
            window.location.replace("pubvideo.php?id=" + data);
          }
        },
        error: function (xhr, status, error) {
          console.log("AJAX Error: " + status + " - " + error);
        },
      });
    }
  });

  $(".publish-video-button").on("click", function (e) {
    e.preventDefault();

    $.post(
      "ajax_pubvideo.php",
      {
        video_key: $(".video-key").val(),
      },
      function (data, status) {
        window.location.replace("watch.php?id=" + data);
      }
    );
  });

  $(".delete-video").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    $.post(
      "ajax_dvideo.php",
      {
        video_key: $(".video-key").val(),
      },
      function (data, status) {
        if (data == 1) window.location.replace("dashboard.php");
      }
    );
  });

  $(".settings-form").validate({
    rules: {
      first_name_settings: {
        required: true,
        maxlength: 12,
      },
      last_name_settings: {
        required: true,
        maxlength: 12,
      },
      user_name_settings: {
        required: true,
        minlength: 4,
        remote: {
          url: "checkuser_settings.php",
          type: "post",
          data: {
            username: function () {
              return $("#user_name_settings").val();
            },
          },
        },
      },
      email_settings: {
        required: true,
        email: true,
        remote: {
          url: "checkemail_settings.php",
          type: "post",
          data: {
            email: function () {
              return $("#email_settings").val();
            },
          },
        },
      },
      password_settings: {
        minlength: 6,
        maxlength: 15,
      },
      re_password_settings: {
        equalTo: "#password_settings",
      },
    },
    messages: {
      first_name_settings: {
        required: "هذا الحقل ضروري",
        maxlength: "اقصى حد 12 حرف",
      },
      last_name_settings: {
        required: "هذا الحقل ضروري",
        maxlength: "اقصى حد 12 حرف",
      },
      user_name_settings: {
        required: "هذا الحقل ضروري",
        minlength: "ادنى حد 4 احرف",
        remote: "يوجد حساب بهذا المستخدم",
      },
      email_settings: {
        required: "هذا الحقل ضروري",
        email: "هذا الايميل غير صحيح",
        remote: "هذا الايميل غير متاح ",
      },
      password_settings: {
        minlength: "ادنى حد 6 احرف",
        maxlength: "اقصى حد 15 حرف",
      },
      re_password_settings: {
        equalTo: "كلمتان السر غير متطابقتان",
      },
    },
  });
  $(".button_submit_settings").on("click", function () {
    if ($(".settings-form").valid()) {
      var email_check_input = $(".email-check-input").val();
      $.post(
        "ajax_settings.php",
        {
          first_name_settings: $("#first_name_settings").val(),
          last_name_settings: $("#last_name_settings").val(),
          user_name_settings: $("#user_name_settings").val(),
          email_settings: $("#email_settings").val(),
          password_settings: $("#password_settings").val(),
          re_password_settings: $("#re_password_settings").val(),
        },
        function (data, status) {
          if (data == 1) {
            $(".alert-success").show();
            $(".alert-danger").hide();
            if (email_check_input != $("#email_settings").val()) {
              $(".active_button").text("تفعيل");
              $(".active_button").removeAttr("disabled");
              $.post(
                "ajax_checkemail_ch.php",
                {
                  email_change: $("#email_settings").val(),
                },
                function (data, status) {}
              );
            }
          } else if (data == 0) {
            $(".alert-danger").show();
            $(".alert-success").hide();
          }
        }
      );
    }
  });

  $(".button-active-sender").on("click", function () {
    if (!$(".alert-success").hasClass("sended")) {
      $.post("ajax_active_sender.php", {}, function (data, status) {
        if (data == 1) {
          $(".alert-success").show();
          $(".alert-success").addClass("sended");
          $(".alert-danger").hide();
        } else {
          $(".alert-success").hide();
          $(".alert-danger").show();
        }
      });
    }
  });

  $(".active_button").click(function () {
    window.location.replace("active_sender.php");
  });

  $(".like-comment-share .fa-heart").on("click", function () {
    if ($(this).hasClass("red-heart")) {
      $.post(
        "ajax_removelike.php",
        {
          video_id: $(".video_id_addlike").val(),
        },
        function (data, status) {
          if (data == 1) {
            var likes_count = parseInt($(".likes-count").html());
            var likes_count2 = likes_count - 1;
            $(".likes-count").html(likes_count2);

            $(".like-comment-share .fa-heart").removeClass("red-heart");
          } else if (data == 0) {
            window.location.replace("index.php");
          }
        }
      );
    } else {
      $.post(
        "ajax_addlike.php",
        {
          video_id: $(".video_id_addlike").val(),
        },
        function (data, status) {
          if (data == 1) {
            var likes_count = parseInt($(".likes-count").html());
            var likes_count2 = likes_count + 1;
            $(".likes-count").html(likes_count2);

            $(".like-comment-share .fa-heart").addClass("red-heart");
          } else if (data == 0) {
            window.location.replace("index.php");
          }
        }
      );
    }
  });
  $(".home-watch .fa-comment").on("click", function () {
    $(".textarea-comment").focus();
  });

  $(".add-comment form").validate({
    rules: {
      textarea_comment: {
        required: true,
        maxlength: 400,
      },
    },
    messages: {
      textarea_comment: {
        required: "هذا الحقل ضروري",
        maxlength: "اقصى حد 400 حرف",
      },
    },
  });
  $(".add-comment-button").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    if ($(".add-comment form").valid()) {
      $.post(
        "ajax_addcomment.php",
        {
          video_id: $(".video_id_addcomment").val(),
          comment_text: $(".textarea-comment").val(),
        },
        function (data, status) {
          console.log("1" + data);
          if (data > 0) {
            var author_comment = $(".comment_author").val();
            var author_comment_pic = $(".img_user_comment").attr("src");
            var comment_text = $(".textarea-comment").val();
            var comment_id = data;
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, "0");
            var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
            var yyyy = today.getFullYear();

            today = mm + "-" + dd + "-" + yyyy;
            $(".textarea-comment").val("");
            $(".comments").prepend(`
						<div class='col-md-12 row comment'>
							<input type="hidden" class="comment_id" value="${comment_id}">
							<div class='col-6' style='color:#777;'>
								<img src='${author_comment_pic}' alt='' width='50' height='50' style='border-radius:50%;'/>
								<span style='color:#000;margin-left:5px;font-size:17px' class='text-right'>
									${author_comment}
								</span>
								<span class='text-left'>${today}</span>
							</div>
							<div class='col-6 d-flex align-items-center' style='justify-content: flex-end;'>
								<div class="dropdown">
								<button class="dropdown-toggle" type="button" data-toggle="dropdown" style='border:none;background:transparent;outline:none;'>
										<i class='fa fa-ellipsis-v'></i>
								</button>
								 <ul class="dropdown-menu text-right">
									<input type='hidden' class='comment-id' value='${comment_id}'/>
									<li class='delete-comment-button dc-${comment_id}'><a href="#"><i class='fa fa-trash'></i>حذف</a></li>
														    
														   
								</ul>
									</div>
									</div>
									<div class='col-md-12'>
									<p style='padding-top:5px;padding-right:50px;'>
										${comment_text}
									</p>
									</div>
										
							</div>
					`);
          } else if (data == 0) {
            console.log("ASDasdasd");
          }
        }
      );
    }
  });

  $(".comments").delegate(".delete-comment-button", "click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    var id_comment = $(this).prev().val();

    $.post(
      "ajax_deletecomment.php",
      {
        comment_id: id_comment,
      },
      function (data, status) {
        if (data == 1) {
          $(".dc-" + id_comment)
            .parent()
            .parent()
            .parent()
            .parent()
            .fadeOut();
        } else if (data == 0) {
          alert(22);
        }
      }
    );
  });

  $(".report-comment-button").on("click", function () {
    $.post(
      "ajax_report.php",
      {
        id_report: $(".id-report").val(),
        report_type: $(".report-type").val(),
        report_link: $(".report-link").val(),
      },
      function (data, status) {
        if (data == 1) {
          alert("نشكرك على ابلاغنا سوف نقوم بتتبع الامر");
        } else if (data == 11) {
          alert("لقد قمت بابلاغنا من قبل");
        } else if (data == 0) {
          window.location.replace("index.php");
        }
      }
    );
  });

  $(".follow-user-button").click(function () {
    if ($(this).hasClass("followed")) {
      $.post(
        "ajax_removefollow.php",
        {
          username: $(".video_username").val(),
        },
        function (data, status) {
          if (data == 1) {
            $(".follow-user-button").html(
              "متابعة <i class='fa fa-user-plus'></i>"
            );
            $(".follow-user-button").removeClass("followed");
          } else if (data == 0) {
            window.location.replace("index.php");
          }
        }
      );
    } else {
      $.post(
        "ajax_addfollow.php",
        {
          username: $(".video_username").val(),
        },
        function (data, status) {
          if (data == 1) {
            $(".follow-user-button").html("الغاء المتابعة");
            $(".follow-user-button").addClass("followed");
          } else if (data == 0) {
            window.location.replace("index.php");
          }
        }
      );
    }
  });

  $(".change-pic i").click(function () {
    $("#user-pic-change-button").click();
  });
  $(".home-user .user-pic").mouseover(function () {
    $(".change-pic").show();
  });
  $(".home-user .user-pic").mouseout(function () {
    $(".change-pic").hide();
  });

  $(".upload_change_pic").validate({
    rules: {
      img_change: {
        required: true,
        extension: "jpg,png,jpeg",
        filesize: 1100000,
      },
    },
    messages: {
      img_change: {
        extension: "<script>window.location.replace('404.php');</script>",
        required: "<script>window.location.replace('404.php');</script>",
        filesize: "<script>window.location.replace('404.php');</script>",
      },
    },
  });
  $(document).on("change", "#user-pic-change-button", function () {
    if ($(".upload_change_pic").valid()) {
      var img_ch = document.getElementById("user-pic-change-button").files[0];
      var form_data = new FormData();
      form_data.append("img_ch", img_ch);
      $.ajax({
        url: "ajax_changepic.php",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 11) {
            window.location.replace("404.php?error_ex=1");
          } else if (data != 0) {
            $(".user-pic img").attr("src", data);
          }
        },
      });
    }
  });

  $(".change-user-glaf").click(function () {
    $("#user-glaf-change-button").click();
  });

  $(".upload_change_glaf").validate({
    rules: {
      glaf_change: {
        required: true,
        extension: "jpg,png,jpeg",
        filesize: 1100000,
      },
    },
    messages: {
      glaf_change: {
        extension: "<script>window.location.replace('404.php');</script>",
        required: "<script>window.location.replace('404.php');</script>",
        filesize: "<script>window.location.replace('404.php');</script>",
      },
    },
  });
  $(document).on("change", "#user-glaf-change-button", function () {
    if ($(".upload_change_glaf").valid()) {
      var glaf_ch = document.getElementById("user-glaf-change-button").files[0];
      var form_data = new FormData();
      form_data.append("glaf_ch", glaf_ch);
      $.ajax({
        url: "ajax_changeglaf.php",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 11) {
            window.location.replace("404.php?error_ex=1");
          } else if (data != 0) {
            $(".user-profile-pic").attr(
              "style",
              'background-image:url("' + data + '")'
            );
          }
        },
      });
    }
  });

  var video = $("#video-thumbnail").get(0);

  var getImage = function () {
    var canvas = document.createElement("canvas");
    canvas.getContext("2d").drawImage(video, 0, 0, canvas.width, canvas.height);

    var img = document.createElement("img");
    img.src = canvas.toDataURL();
    $(".ca").attr("src", img.src);
  };

  if ($("#video-thumbnail").length) {
    window.setInterval(function () {
      getImage();
    }, 100);
  }
  $("#video-thumbnail").error(function () {
    alert(0);
  });
  $(".home-search form .form-group:last-child button").on(
    "click",
    function (e) {
      e.preventDefault();
      e.stopPropagation();

      var s = $(".home-search form .form-group:first-child input").val();
      window.location.replace("search.php?s=" + s);
    }
  );
});

$(window).load(function () {
  $(".body-spinner").css("overflow", "auto");
  $(".spinner-loading").fadeOut(2000, function () {
    $(".spinner-loading").addClass("di-none");
  });
});
