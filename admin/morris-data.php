<?php
require_once '../config.php';

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 day)  ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $todays = count($stmt->fetchAll());
   $today =  json_encode($todays);

   // echo $totl_count ;

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN date_add(CURDATE(),INTERVAL -1 DAY) AND CURDATE() ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $yesterday = json_encode(count($stmt->fetchAll()));

    $sql = "SELECT * FROM visit WHERE `date` BETWEEN date_add(CURDATE(),INTERVAL -2 DAY) AND CURDATE() ";
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $yesterday1 = json_encode(count($stmt->fetchAll()));

date_default_timezone_set("Africa/Nairobi");
$d=strtotime("-3 day");
$dd  = json_encode(date('l d', $d));

?>

<script type="text/javascript">

// Morris.js Charts sample data for SB Admin template
$(function() {

        var data = 42; //<?php echo json_encode( "50" ); ?>
    Donut Chart
    Morris.Donut({
        element: 'morris-donut',
        data: [{
            label: "Yesterday",
            value: <?php echo json_encode( $yesterday ); ?> //var div = document.getElementById('Yesterday');
            // var myData = div.
        }, {
            label: "Today",
            value: <?php echo json_encode( $today ); ?>
        }, {
            label: <?php echo json_encode( $dd ); ?>,
            value: <?php echo json_encode( $yesterday1 ); ?>
        }],

        resize: true
    });

    // Line Chart
    Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'morris-line-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [{
            d: '2016',
            visits: <?php echo json_encode( $yr ) ?>
        }, {
            d: '2017',
            visits: <?php echo json_encode( $yrr ) ?>
        }, {
            d: '2018',
            visits: <?php echo json_encode( $yrrr ) ?>
        }, {
            d: '2019',
            visits: <?php echo json_encode( $yrrrr ) ?>
        } ],
        // The name of the data record attribute that contains x-visitss.
        xkey: 'd',
        // A list of names of data record attributes that contain y-visitss.
        ykeys: ['visits'],
        // Labels for the ykeys -- will be displayed when you hover over the
        // chart.
        labels: ['Visits'],
        // Disables line smoothing
        smooth: false,
        resize: true
    });

    // Bar Chart
    Morris.Bar({
        element: 'morris-bar',
        data: [{
            device: 'iPhone',
            geekbench: 136
        }, {
            device: 'iPhone 3G',
            geekbench: 137
        }, {
            device: 'iPhone 3GS',
            geekbench: 275
        }, {
            device: 'iPhone 4',
            geekbench: 380
        }, {
            device: 'iPhone 4S',
            geekbench: 655
        }, {
            device: 'iPhone 5',
            geekbench: 1571
        }],
        xkey: 'device',
        ykeys: ['geekbench'],
        labels: ['Geekbench'],
        barRatio: 0.4,
        xLabelAngle: 35,
        hideHover: 'auto',
        resize: true
    });


});

</script>
