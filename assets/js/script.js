jQuery(function () {
  let mediauploader = wp.media({
    title: "Selecione ou Envie uma Foto",
    button: {
      text: "Usar esta foto"
    },
    multiple: false
  });

  jQuery("#lr_img_upload_btn").on("click", function (e) {
    e.preventDefault();
    mediauploader.open();
  });

  mediauploader.on("select", function () {
    let anexo = mediauploader.state().get("selection").first().toJSON();
    jQuery("#lr_img_preview").attr("src", anexo.url);
    jQuery("#lr_img").val(anexo.id);
  });

  // Send Vote
  jQuery("#recipe_vote").bind("rated", function () {
    jQuery(this).rateit("readonly", true);

    let id = jQuery(this).attr("data-id");
    let vote = jQuery(this).rateit("value");

    jQuery.ajax({
      type: "POST",
      url: recipe_obj.ajax_url,
      data: { action: "lr_vote_recipe", id: id, vote: vote },
      success: function (data) {}
    });
  });

  // Send Recipe
  jQuery("#recipes_creator").on("submit", function (e) {
    e.preventDefault();
    jQuery("#recipes_creator_submit").hide();
    jQuery("#recipe_criator_notification").html("Carregando");

    let form = {
      action: "lr_recipes_submit",
      title: jQuery("#lr_title").val(),
      content: tinymce.activeEditor.getContent(),
      ingredients: jQuery("#lr_ingredients").val(),
      time: jQuery("#lr_time").val(),
      utensils: jQuery("#lr_utensils").val(),
      difficulty: jQuery("#lr_difficulty").val(),
      type: jQuery("#lr_type").val(),
      anexo_id: jQuery("#lr_img").val()
    };

    jQuery.ajax({
      type: "POST",
      url: recipe_obj.ajax_url,
      data: form,
      dataType: "json",
      success: function (json) {
        if (json.status == 2) {
          jQuery("#recipe_criator_notification").html(
            "Receita enviada com sucesso"
          );
          jQuery("#recipes_creator").hide();
        } else {
          jQuery("#recipe_criator_notification").html(
            "Não foi possível. Tente novamente mais tarde."
          );
          jQuery("#recipes_creator_submit").show();
        }
      }
    });
  });

  // Sign up
  jQuery("#lr_recipe_signup").on("submit", function (e) {
    e.preventDefault();
    jQuery("#lr_signup_submit").hide();
    jQuery("#lr_signup_notification").html("Carregando");

    let form = {
      action: "lr_recipes_signup",
      name: jQuery("#lr_signup_name").val(),
      email: jQuery("#lr_signup_email").val(),
      password: jQuery("#lr_signup_password").val()
    };

    jQuery.ajax({
      type: "POST",
      url: recipe_obj.ajax_url,
      data: form,
      dataType: "json",
      success: function (json) {
        if (json.status == 2) {
          jQuery("#lr_signup_notification").html("Conta criada com sucesso");
          window.location.href = recipe_obj.home_url;
        } else {
          jQuery("#lr_signup_notification").html(
            "Não foi possível. Tente novamente mais tarde."
          );
          jQuery("#lr_signup_submit").show();
        }
      }
    });
  });

  // Sign in
  jQuery("#lr_recipe_signin").on("submit", function (e) {
    e.preventDefault();
    jQuery("#lr_signin_submit").hide();
    jQuery("#lr_signin_notification").html("Carregando");

    let form = {
      action: "lr_recipes_signin",
      email: jQuery("#lr_signin_email").val(),
      password: jQuery("#lr_signin_password").val()
    };

    jQuery.ajax({
      type: "POST",
      url: recipe_obj.ajax_url,
      data: form,
      dataType: "json",
      success: function (json) {
        if (json.status == 2) {
          jQuery("#lr_signin_notification").html("Logado com sucesso");
          window.location.href = recipe_obj.home_url;
        } else {
          jQuery("#lr_signin_notification").html(
            "Não foi possível logar na conta."
          );
          jQuery("#lr_signin_submit").show();
        }
      }
    });
  });
});
