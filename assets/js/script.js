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
});
