@extends('admin.default')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $familiesCount }}</h3>
                <p>Families</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('admin.families.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $studentCount }}</h3>
                <p>Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('admin.students.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $donorCount }}</h3>
                <p>Donors</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('admin.donors.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $vtcStudentCount }}</h3>
                <p>Vocational Traning Center (VTC) Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('admin.vtc_students.indexV3') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">VTC Student (Genders)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="vtcStudentGenders" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">VTC Student (Marital Status)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="vtcStudentMaritalStatus" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">VTC Student (Courses)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="studentCourses" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">VTC Student (Zakat Eligible)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="vtcStudentZakatStats" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">VTC Stundets (Enrolled)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="vtcStudentTrends" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('js')
    <script type="text/javascript">
    
      var pieOptions     = {
        maintainAspectRatio : false,
        responsive : true,
      }

      var vtcStudentGenders = {
        labels: {!! json_encode($vtcStudentGenderStats["labels"]) !!},
        datasets: [
          {
            data: {!! json_encode($vtcStudentGenderStats["data"]) !!},
            backgroundColor : ['#00c0ef', '#3c8dbc'],
          }
        ]
      }
      var pieChartCanvas = $('#vtcStudentGenders').get(0).getContext('2d')
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: vtcStudentGenders,
        options: pieOptions
      })

      var vtcStudentMaritalStatus = {
        labels: {!! json_encode($vtcMaritalStats["labels"]) !!},
        datasets: [
          {
            data: {!! json_encode($vtcMaritalStats["data"]) !!},
            backgroundColor : ['#00a65a', '#f39c12'],
          }
        ]
      }
      var pieChartCanvas = $('#vtcStudentMaritalStatus').get(0).getContext('2d')
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: vtcStudentMaritalStatus,
        options: pieOptions
      })


      var studentCourses = $('#studentCourses').get(0).getContext('2d');
      var studentCoursesData = {
        labels: {!! json_encode($courseStats["labels"]) !!},
        datasets: [
          {
            data: {!! json_encode($courseStats["data"]) !!},
            backgroundColor: {!! json_encode($courseStats["colors"]) !!},
          }
        ]
      };
      var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
      };
      new Chart(studentCourses, {
        type: 'doughnut',
        data: studentCoursesData,
        options: donutOptions
      });

      var vtcStudentZakatStats = {
        labels: {!! json_encode($vtcZakatStats["labels"]) !!},
        datasets: [
          {
            data: {!! json_encode($vtcZakatStats["data"]) !!},
            backgroundColor : ['#f56954', '#00c0ef'],
          }
        ]
      }
      var pieChartCanvas = $('#vtcStudentZakatStats').get(0).getContext('2d')
      new Chart(pieChartCanvas, {
        type: 'pie',
        data: vtcStudentZakatStats,
        options: pieOptions
      })

      var vtcStudentTrends = @json($vtcStudentTrends);

      new Chart(document.getElementById('vtcStudentTrends'), {
        type: 'line',
        data: vtcStudentTrends,
        options: { responsive: true, maintainAspectRatio: false }
      });

    </script>
@endsection