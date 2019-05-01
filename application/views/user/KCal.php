

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

          <div class="row">
            <div class="col-lg-8">
              <?= form_open_multipart('user/KCal');?>

                <div class="form-group row">
                  <script>
	                   $(document).ready(function(){
			                    var url = "https://foodapi.calorieking.com/v1"+

			                              $.getJSON(url, function(data){
				                                  var html = "";
				                                  $.each(data.items, function(i, item){
					                                html += "<h2>" + item.title + "</h2>";
					                                html += "<p>" + item.date_taken + "</p>";
					                                html += item.description;
                                    });
                                  $("#photos").html(html);
			                                                                });
                                                                    });
                   </script>
                </div>


            </div>

          </div>

          <div id="photos"></div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
