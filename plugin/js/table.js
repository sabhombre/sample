jQuery(document).ready( function ($) {
    $('#filecoin-user-list').DataTable();
    $('#filecoin-user-list tbody tr').click(function(){
        var url = document.location.href+"&user_id="+ $(this).data('id');
        document.location = url;
    });

    $('#user-settings-form').submit(function(event){
        event.preventDefault();

        let searchParams = new URLSearchParams(window.location.search);

        var u_id = searchParams.get('user_id');
        var u_name = $("#user-full-name").val();
        var u_email = $("#user-email").val();
        var mgt_fee = $('#user-mgt-fee').val();

        if(u_id!=''&&u_name!=''&&u_email!=''&&mgt_fee!='')
        {
            var formData = {
               name: u_name,
               email: u_email,
               mgt_fee: mgt_fee,
               user_id: u_id,
               action: 'edit_user'
            };

            $.ajax({
              type: "POST",
              url: "/wp-content/plugins/filecoin/process.php",
              data: formData,
              success: function(response){
                alert(response);
                // location.reload();
              },
              error: function(xhr, status, error){
                alert(error);
              }
            });
        }
    });


    //create user

    $('#create-user-form').submit(function(event){
        
        event.preventDefault();

        var u_name = $("#user-name").val();
        var u_email = $("#user-email").val();
        var u_pass = $('#user-password').val();

        if(u_name!=''&&u_email!=''&&u_pass!='')
        {
            var formData = {
              name: u_name,
              email: u_email,
              password: u_pass,
              action: 'add_user'
            };

            $.ajax({
              type: "POST",
              url: "/wp-content/plugins/filecoin/process.php",
              data: formData,
              success: function(response){
                alert(response);
                location.reload();
              },
              error: function(xhr, status, error){
                alert(error);
              }
            });
        }  
    });


    //create revenue

    $('#revenue-form').submit(function(event){

        event.preventDefault();

        let searchParams = new URLSearchParams(window.location.search);

        var u_id = searchParams.get('user_id');

        var r_id = $('#rev-update-id').html();
        var rev_date = $("#rev-date").val();
        var rev_amt = $('#rev-amt').val();

        if($('#rev-update-id').html()!=''){
          //update
           if(rev_date!=''&&rev_amt!='')
           {
              var formData = {
                revenue_id : r_id,
                revenue_date : rev_date,
                revenue_amt : rev_amt, 
                action: 'update_revenue'
              };

              $.ajax({
                type: "POST",
                url: "/wp-content/plugins/filecoin/process.php",
                data: formData,
                success: function(response){
                  alert(response);
                  location.reload();
                },
                error: function(xhr, status, error){
                  alert(error);
                }
              });
          } 
        }
        else
        {
          //add
          if(u_id!=''&&rev_date!=''&&rev_amt!='')
          {
              var formData = {
                user_id : u_id,
                revenue_date : rev_date,
                revenue_amt : rev_amt, 
                action: 'add_revenue'
              };

              $.ajax({
                type: "POST",
                url: "/wp-content/plugins/filecoin/process.php",
                data: formData,
                success: function(response){
                  alert(response);
                  location.reload();
                },
                error: function(xhr, status, error){
                  alert(error);
                }
              });
          } 
        }
    });

    //edit revenue

    $('.edit-rev').click(function(){

      var id = $(this).parents('tr').data('id');
      var td = $(this).parent('.td-options-rev');

      var rev_date = td.siblings('.td-rev-date').html();
      var rev_amt = td.siblings('.td-rev-amt').find('.span-rev-amt').html();

      $('#rev-update-id').html(id);
      $('#rev-date').val(rev_date);
      $('#rev-amt').val(rev_amt);
      $('#rev-submit').val('更新');


    });


    $('.del-rev').click(function(){

      if (confirm('Are you sure you want to remove this record from the database?')) {
        //delete record

         var id = $(this).parents('tr').data('id');

         if(id!='')
         {
            var formData = {
              revenue_id: id,
              action: 'delete_revenue'
            };

          $.ajax({
            type: "POST",
            url: "/wp-content/plugins/filecoin/process.php",
            data: formData,
            success: function(response){
              alert(response);
              location.reload();
            },
            error: function(xhr, status, error){
              alert(error);
            }
          });
         }

      } else {
        // Do nothing!
      }

    });


    $('.reset').click(function(){
      
     $(this).closest('form').trigger("reset");
     $(this).siblings('.submit-btn').val('+ 新規追加');
     $(this).siblings('.update-id-holder').html('');
    
    });


    //create withdrawal

    $('#withdrawal-form').submit(function(event){
        
        event.preventDefault();

        let searchParams = new URLSearchParams(window.location.search);

        var u_id = searchParams.get('user_id');

        var w_id = $('#wdrw-update-id').html();
        var wdrw_date = $("#wdrw-date").val();
        var wdrw_amt = $('#wdrw-amt').val();


        if($('#wdrw-update-id').html()!=''){
          //update
          if(wdrw_date!=''&&wdrw_amt!='')
          {
              var formData = {
                withdrawal_id : w_id,
                withdrawal_date : wdrw_date,
                withdrawal_amt : wdrw_amt, 
                action: 'update_withdrawal'
              };

              $.ajax({
                type: "POST",
                url: "/wp-content/plugins/filecoin/process.php",
                data: formData,
                success: function(response){
                  alert(response);
                  location.reload();
                },
                error: function(xhr, status, error){
                  alert(error);
                }
              });
          } 
        }
        else
        {
          //add
          if(u_id!=''&&wdrw_date!=''&&wdrw_amt!='')
          {
              var formData = {
                user_id : u_id,
                withdrawal_date : wdrw_date,
                withdrawal_amt : wdrw_amt, 
                action: 'add_withdrawal'
              };

              $.ajax({
                type: "POST",
                url: "/wp-content/plugins/filecoin/process.php",
                data: formData,
                success: function(response){
                  alert(response);
                  location.reload();
                },
                error: function(xhr, status, error){
                  alert(error);
                }
              });
          }  

        }

    });


    //edit withdrawal

    $('.edit-wdrw').click(function(){

      var id = $(this).parents('tr').data('id');
      var td = $(this).parent('.td-options-wdrw');

      var wdrw_date = td.siblings('.td-wdrw-date').html();
      var wdrw_amt = td.siblings('.td-wdrw-amt').find('.span-wdrw-amt').html();

      $('#wdrw-update-id').html(id);
      $('#wdrw-date').val(wdrw_date);
      $('#wdrw-amt').val(wdrw_amt);
      $('#wdrw-submit').val('更新');


    });

    //delete withdrawal

    $('.del-wdrw').click(function(){

      if (confirm('Are you sure you want to remove this record from the database?')) {
        //delete record

         var id = $(this).parents('tr').data('id');

         if(id!='')
         {
            var formData = {
              withdrawal_id: id,
              action: 'delete_withdrawal'
            };

          $.ajax({
            type: "POST",
            url: "/wp-content/plugins/filecoin/process.php",
            data: formData,
            success: function(response){
              alert(response);
              location.reload();
            },
            error: function(xhr, status, error){
              alert(error);
            }
          });
         }

      } else {
        // Do nothing!
      }

    });


    //get cumulative total


    function cumulative_total(){
        let searchParams = new URLSearchParams(window.location.search);

        var u_id = searchParams.get('user_id');

        var formData = {
          user_id : u_id,
          action: 'get_cumulative_revenue'
        };

        $.ajax({
          type: "POST",
          url: "/wp-content/plugins/filecoin/process.php",
          data: formData,
          success: function(response){
            if(response!='')
            {
              var val = Math.round((parseFloat(response) + Number.EPSILON) * 1000) / 1000;
              
            }
            else
            {
              var val = 0;
            }
            $('#user-cum-rev').find('span').html(val.toFixed(3));
          },
          error: function(xhr, status, error){
            $('#user-cum-rev').find('span').html(error);
          }
        });
    }

    cumulative_total();


    //get withdrawal total


    function withdrawal_total(){
        let searchParams = new URLSearchParams(window.location.search);

        var u_id = searchParams.get('user_id');

        var formData = {
          user_id : u_id,
          action: 'get_withdrawal_total'
        };

        $.ajax({
          type: "POST",
          url: "/wp-content/plugins/filecoin/process.php",
          data: formData,
          success: function(response){
            if(response!='')
            {
              var val = Math.round((parseFloat(response) + Number.EPSILON) * 1000) / 1000;
            }
            else
            {
              var val = 0;
            }
            $('#user-wdrw-amt').find('span').html(val.toFixed(3));
          },
          error: function(xhr, status, error){
            $('#user-wdrw-amt').find('span').html(error);
          }
        });
    }

    withdrawal_total();


} );