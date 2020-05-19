jQuery(function () {
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
      type: jQuery("#lr_type").val()
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
});
