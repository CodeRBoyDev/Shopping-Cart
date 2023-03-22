<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Charts\CustomerChart;
use App\Charts\TownChart;
use App\Charts\SalesChart;
class DashboardController extends Controller
{
    public function index(){
        $customer = DB::table('customer')->groupBy('title')
        ->orderBy('total')
        ->pluck('title',DB::raw('count(title) as total'))
        ->all();
      
        $customerChart = new CustomerChart;
        // dd(array_keys($customer));
        $borderColors = [
          "rgba(255, 99, 132, 1.0)",
          "rgba(22,160,133, 1.0)",
          "rgba(255, 205, 86, 1.0)",
          "rgba(51,105,232, 1.0)",
          "rgba(244,67,54, 1.0)",
          "rgba(34,198,246, 1.0)",
          "rgba(153, 102, 255, 1.0)",
          "rgba(255, 159, 64, 1.0)",
          "rgba(233,30,99, 1.0)",
          "rgba(205,220,57, 1.0)"
      ];
      $fillColors = [
          "rgba(255, 99, 132, 0.2)",
          "rgba(22,160,133, 0.2)",
          "rgba(255, 205, 86, 0.2)",
          "rgba(51,105,232, 0.2)",
          "rgba(244,67,54, 0.2)",
          "rgba(34,198,246, 0.2)",
          "rgba(153, 102, 255, 0.2)",
          "rgba(255, 159, 64, 0.2)",
          "rgba(233,30,99, 0.2)",
          "rgba(205,220,57, 0.2)"

      ];
         $dataset = $customerChart->labels(array_values($customer));
           // dd($dataset);
           $dataset= $customerChart->dataset('Customer Demographics', 'bar', array_keys($customer))
           ->color($borderColors)
           ->backgroundcolor($fillColors);;
          
          
           $dataset2= $customerChart->dataset('','line', array_keys($customer))->color("rgb(255, 99, 132)")
           ->backgroundcolor("rgb(255, 99, 132)")
           ->fill(false)
           ->linetension(0.1);

           $customerChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true,
                            'max' => 20],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => true],
                            'display' => true
                          ]],
            ],
        ]);
           
        $town = DB::table('customer')->whereNotNull('town')->groupBy('town')->pluck(DB::raw('count(town) as total'),'town')->all();
        // $town = DB::table('customer')->whereNotNull('town')->get('town');
        // dd($town);
        $townChart = new TownChart;
        // dd(array_values($customer));
      $dataset = $townChart->labels(array_keys($town));
        // dd($dataset);
        $dataset= $townChart->dataset('town Demographics', 'pie', array_values($town));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $townChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => false],
                            'display' => true
                          ]],
            ],
        ]);

        $sales = DB::table('orderinfo AS o')
         ->join('orderline AS ol','o.orderinfo_id','=','ol.orderinfo_id')
         ->join('item AS i','ol.item_id','=','i.item_id')
         ->groupBy('o.date_placed')
         ->pluck(DB::raw('sum(ol.quantity * i.sell_price) AS total'),'o.date_placed')
         ->all();
        // dd($sales);
        $salesChart = new SalesChart;
     // dd(array_values($customer));
     $dataset = $salesChart->labels(array_keys($sales));
        // dd($dataset);
        $dataset= $salesChart->dataset('town Demographics', 'horizontalBar', array_values($sales));
        // dd($customerChart);
        $dataset= $dataset->backgroundColor(collect(['#7158e2','#3ae374', '#ff3838',"#FF851B", "#7FDBFF", "#B10DC9", "#FFDC00", "#001f3f", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));
        // dd($customerChart);
        $salesChart->options([
            'responsive' => true,
            'legend' => ['display' => true],
            'tooltips' => ['enabled'=>true],
            // 'maintainAspectRatio' =>true,
            // 'title' => 'test',
            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> false],
                            // 'min'=> 0,
                            // 'stepSize'=> 1000,
                            'ticks' => [
                 'beginAtZero' => true,
                 // 'steps' => 1000,
                             //'stepValue' => 100,
                            // 'max' => 20000
             ]
                          ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            //'barThickness' => 100,
                            'barPercentage' => 1,
                            'gridLines' => ['display' => false],
                            'display' => true,
                            'ticks' => [
                             'beginAtZero' => true,
                             'min'=> 0,
                             'stepSize'=> 10,
                        ]
                    ]],
            ],
        ]);
     return view('dashboard.index',compact('customerChart','townChart','salesChart'));
    }
}
