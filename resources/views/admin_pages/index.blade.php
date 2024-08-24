@extends('admin_layout.layout')
@section('layout')
<main id="main" class="main">
  <div class="pagetitle">
    <h1>@lang('public.Dashboard')</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/admin/index')}}">@lang('public.Home')</a></li>
        <li class="breadcrumb-item active">@lang('public.Dashboard')</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section dashboard">
    <div class="row">
      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">
          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">@lang('public.Orders') <span>| @lang('public.this_Month') </span></h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$customer_this_month}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Sales Card -->
          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">@lang('public.Users')  <span>| @lang('public.this_Month') </span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$user_this_month}}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Revenue Card -->
      <!-- Revenue Card -->
      <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">@lang('public.Visitors') <span>| @lang('public.this_Month') </span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$Visitors_count}}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Revenue Card -->
          <!-- Customers Card -->
          @if(auth()->user()->role_as=='1!_1$')
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">@lang('public.Total_Shipping') <span>| @lang('public.this_Month')</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$total_cost}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Customers Card -->
          @endif
          <!-- Reports -->
          <div class="col-12">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">@lang('public.Reports') <span> | @lang('public.this_Month')</span></h5>

            <!-- Line Chart -->
            <div id="reportsChart"></div>
<script>
            document.addEventListener("DOMContentLoaded", () => {
    const salesData = {!! $salesData !!};
    const salesData2 = {!! $salesData2 !!};
    const maxSalesData2 = Math.max(...salesData2); // Find the maximum value in salesData2

    new ApexCharts(document.querySelector("#reportsChart"), {
        series: [{
            name: 'Tracking Number',
            data: salesData,
        }, {
            name: 'Shipping Cost',
            data: salesData2
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false
            },
        },
        markers: {
            size: 4
        },
        colors: ['#4154f1', '#2eca6a', '#ff771d'],
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.3,
                opacityTo: 0.4,
                stops: [0, 90, 100]
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        xaxis: {
            type: 'datetime',
            categories: {!! json_encode($orderss->pluck('created_at')) !!}
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toFixed(0); // Format the y-axis values as integers
                }
            },
            max: maxSalesData2 // Set the maximum value on the y-axis to the maximum value in salesData2
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        }
    }).render();
});
            </script>
            <!-- End Line Chart -->

        </div>

    </div>
</div>

          <!-- End Reports -->
          <!-- Recent Sales -->
          <div class="col-12" id="today_shipping">
            <div class="card recent-sales overflow-auto">
              <div class="card-body table-responsive">
                <h5 class="card-title">@lang('public.Shippin_Orders') <span>| @lang('public.Today')</span></h5>
                <table class="table table-borderless datatable">
                  <thead>
                    <tr>
                      <th scope="col">@lang('public.Tracking_Number')</th>
                      <th scope="col">@lang('public.Customer')</th>
                      <th scope="col">@lang('public.Phone')</th>
                      <th scope="col">@lang('public.Time')</th>
                      <th scope="col">@lang('public.Status')</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($shippingOrders_today as $item)
                    <tr>
                      <th scope="row"><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{ $item->tracking_no }}</a></th>
                      <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{ $item->name }}</a></td>
                      <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">{{$item->phone}}</a></td>
                      <td>{{ $item->created_at->diffForHumans() }}</td>
                      <td><a href="{{ url('admin/show/shipping/details', ['encrypted_id' => Crypt::encryptString($item->id)]) }}">
                          @if($item->status == 0)
                          <span class="badge bg-danger"><i class="bi bi-arrow-clockwise me-1"></i>@lang('public.Under_Revision')</span>
                          @elseif($item->status == 1)
                          <span class="badge bg-warning text-dark"><i class="bi bi-truck me-1"></i>@lang('public.In_Way')</span>
                          @elseif($item->status == 2)
                          <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>@lang('public.Shipping_Done')</span>
                          @endif
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>

              </div>

            </div>
          </div><!-- End Recent Sales -->

        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-4">


         <!-- Website Traffic -->
         <div class="card">
    <div class="filter">
        <!-- Dropdown code -->
    </div>

    <div class="card-body pb-0">
        <h5 class="card-title">@lang('public.Website_Traffic') <span> | @lang('public.Today')</span></h5>

        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const newCustomers = {!! $newCustomers !!}; // Retrieve the number of new customers
                const emailsSent = {!! $emailsSent !!}; // Retrieve the number of emails sent

                const chartData = [
                   
                    {
                        value: emailsSent, // Use the variable for emails sent
                        name: 'Email'
                    },
                      
               
                  
                ];

                // Add a new data entry for new customers
                chartData.unshift({
                    value: newCustomers,
                    name: 'New Customers'
                });

                echarts.init(document.querySelector("#trafficChart")).setOption({
                    tooltip: {
                        trigger: 'item'
                    },
                    legend: {
                        top: '5%',
                        left: 'center'
                    },
                    series: [
                        {
                            name: 'Access From',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold'
                                }
                            },
                            labelLine: {
                                show: false
                            },
                            data: chartData // Use the modified chart data
                        }
                    ]
                });
            });
        </script>

    </div>
</div>
          <!-- End Website Traffic -->
          <div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">@lang('public.Visitors')</h5>

      <!-- Line Chart -->
      <div id="lineChart" style="min-height: 400px;" class="echart"></div>

      <script>
        document.addEventListener("DOMContentLoaded", () => {
          var days = <?php echo json_encode($days); ?>;
          var visitors = <?php echo json_encode($visitors); ?>;
          
          echarts.init(document.querySelector("#lineChart")).setOption({
            xAxis: {
              type: 'category',
              data: days
            },
            yAxis: {
              type: 'value'
            },
            series: [{
              data: visitors,
              type: 'line',
              smooth: true
            }]
          });
        });
      </script>
      <!-- End Line Chart -->

    </div>
  </div>
</div>

    </div>
  </section>

</main><!-- End #main -->
@endsection