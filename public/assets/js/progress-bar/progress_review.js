// review ajaxs
$(document).ready(function(){
        
  $('#review_form').on('submit', function(event){
    
      event.preventDefault();
      var count_error = 0;

      var user_id = $(this).closest('.review-form').find('#user_id').val();
      var prod_id = $(this).closest('.review-form').find('#prod_id').val();
      var review = $(this).closest('.review-form').find('#review').val();

      // if($('#review').val() == '')
      // {
      //   $('#review_error').text('Enter Review to submit *');
      //   count_error++;
      // }
      // else{
      //   $('#review_error').text('');
      // }
      
      if(count_error == 0)
      {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({

            url:"/store-reviews",
            method:"POST",
            data:{
                'user_id': user_id,
                'prod_id': prod_id,
                'review': review,
            },

            beforeSend:function()
            {
              $('#save').attr('disabled', 'disabled');
              $('#process_review').css('display', 'block');

              $('#review').attr('readonly', true);
              $('#review').css('background-color', 'white');
            },

            success: function (data) {
                var percentage = 0;
                var timer = setInterval(function(){
                percentage = percentage + 20;
                progress_bar_process(percentage, timer);
                }, 1000);

                $('#review-sec').load(location.href + ' .comment-list');
                $('#review_no_load').load(location.href + ' .review_no');

                // var x = document.getElementById("collapseOne");
                // if (x.style.display === "none") {
                //   x.style.display = "block";
                // } else {
                //   x.style.display = "none";
                // }
              },
          })
      }
      else
      {
      return false;
      }
  
  });

  // progress bar
  function progress_bar_process(percentage, timer)
  {
      $('.progress-bar').css('width', percentage + '%');

      if(percentage > 100)
      {
          clearInterval(timer);
          $('#review_form')[0].reset();
          $('#review').attr('readonly', false);
          $('#process_review').css('display', 'none');
          $('.progress-bar').css('width', '0%');
          $('#save').attr('disabled', false);
          $('#success_message_review').html("<div class='alert alert-success'>Thank For your Review</div>");

          setTimeout(function()
          {
          $('#success_message_review').html('');
          }, 5000);

      }
  }



});


// review show more, show less
const Utils = {

  addClass: function (element, theClass) {
    element.classList.add(theClass);
  },

  removeClass: function (element, theClass) {
    element.classList.remove(theClass);
  },

  showMore: function (element, excerpt) {
    element.addEventListener("click", event => {
      const linkText = event.target.textContent.toLowerCase();
      event.preventDefault();

      console.log(this);
      if (linkText == "show more") {
        element.textContent = "Show less";
        this.removeClass(excerpt, "excerpt-hidden");
        this.addClass(excerpt, "excerpt-visible");
      } 
      else {
        element.textContent = "Show more";
        this.removeClass(excerpt, "excerpt-visible");
        this.addClass(excerpt, "excerpt-hidden");
      }
    });
  } 

};

const ExcerptWidget = {
  showMore: function (showMoreLinksTarget, excerptTarget) {
    const showMoreLinks = document.querySelectorAll(showMoreLinksTarget);

    showMoreLinks.forEach(function (link) {
      const excerpt = link.previousElementSibling.querySelector(excerptTarget);
      Utils.showMore(link, excerpt);
    });
  } 
};

ExcerptWidget.showMore('.js-show-more', '.js-excerpt');