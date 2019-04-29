<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- <div class="container">
              <div class="row">

                  <div class="col-xs-4 aaa">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              <h3 class="panel-title">Donut Chart</h3>
                          </div>
                          <div class="panel-content text-center">
                              <canvas id="myDonutChart" class="chart"></canvas>
                          </div>
                      </div>
                  </div>

                                    <div class="col-xs-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Donut Chart</h3>
                                            </div>
                                            <div class="panel-content text-center">
                                                <canvas id="chartBar1" class="chart"></canvas>
                                            </div>
                                        </div>
                                    </div>

              </div>
          </div> -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">

            </div>
            <div class="row clearfix">
                <!-- Line Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="text-align:center; font-size:20px; margin-top:20px">LINE CHART</h2>
                            <ul class="header-dropdown m-r--5">
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="line_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
                <!-- Bar Chart -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 style="text-align:center; font-size:20px; margin-top:20px">BAR CHART</h2>
                            <ul class="header-dropdown m-r--5">
                            </ul>
                        </div>
                        <div class="body">
                            <canvas id="bar_chart" height="150"></canvas>
                        </div>
                    </div>
                </div>
                <!-- #END# Bar Chart -->
            </div>

        </div>
    </section>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
