<?php
namespace core;

class ProfitPlot implements Plotter
{
  public function cal(\DateTime $from, \DateTime $to, $time_unit){
    $orderRepo = new EloOrderRepo(new \Order());   
    $orders = $orderRepo->whereBetween('order_time',
    $from->format('Y-m-d'), $to->format('Y-m-d'));
    $result = array();
    switch ($time_unit){
      case TimeUnit::Daily:
        $days = DateHelper::createDateRangeArray($from->format('Y-m-d'),$to->format('Y-m-d'));
        $index=0;
        foreach($days as $day){
          $p = new Point();
          $p->x = $day;
          $p->y = 0;
          array_push($result, $p);
          if($index<sizeof($orders)){
            while(preg_split('/\s+/',$orders[$index]->order_time)[0] == $day){
              //array_push($result, 'day'.$day.'**'.preg_split('/\s+/',$orders[$index]->order_time)[0].'index'.$index.'bool'
              //.(preg_split('/\s+/',$orders[$index]->order_time)[0] == $day));
              //$result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $orders[$index]->total_price;
              $products = $orders[$index]->products()->get();

              for($i=0; $i<sizeof($products); $i++){
                $result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $products[$i]->cost;
              }
              $index = $index+1;
              if($index==sizeof($orders)) break;
            }
          }
        }
        break;

      case TimeUnit::Weekly:
        $weeks = DateHelper::createWeekRangeArray($from->format('Y-m-d'), $to->format('Y-m-d'));
        $index=0;
        foreach($weeks as $week){
          //array_push($result, $week);
          $p = new Point();
          $p->x = $week;
          $p->y = 0;
          array_push($result, $p);
          if($index<sizeof($orders)){
            $d1 = strtotime($week);
            $d2 = strtotime(preg_split('/\s+/',$orders[$index]->order_time)[0]);
            if($d1==-1 || $d2 ==-1){
              die("error creating timestamp");
            }
            $diff = floor(abs($d1-$d2)/(60*60*24));
            while($diff< 7){
              //$result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $orders[$index]->total_price;
              $products = $orders[$index]->products()->get();
              for($i=0; $i<sizeof($products); $i++){
                $result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $products[$i]->cost;
              }

              $index = $index+1;
              if($index==sizeof($orders)) break;
              $d2 = strtotime(preg_split('/\s+/',$orders[$index]->order_time)[0]);
              $diff = floor(abs($d1-$d2)/(60*60*24));
            }
          }
        }
        break;

      case TimeUnit::Monthly:
        $months = DateHelper::createMonthRangeArray($from->format('Y-m-d'), $to->format('Y-m-d'));
        $index=0;
        foreach($months as $month){
          //array_push($result, $month);
          $p = new Point();
          $p->x = $month;
          $p->y = 0;
          array_push($result, $p);
          if($index<sizeof($orders)){
            $d1 = strtotime($month);
            $d2 = strtotime(preg_split('/\s+/',$orders[$index]->order_time)[0]);
            if($d1==-1 || $d2 ==-1){
              die("error creating timestamp");
            }

            $diff = floor(abs($d1-$d2)/(60*60*24));
            while($diff < 30){
              //$result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $orders[$index]->total_price;
              $products = $orders[$index]->products()->get();
              for($i=0; $i<sizeof($products); $i++){
                $result[sizeof($result)-1]->y = $result[sizeof($result)-1]->y + $products[$i]->cost;
              }

              $index = $index+1;
              if($index==sizeof($orders)) break;
              $d2 = strtotime(preg_split('/\s+/',$orders[$index]->order_time)[0]);
              $diff = floor(abs($d1-$d2)/(60*60*24));
            }
          }
        }
        break;
    }
    return json_encode($result);
  }
}