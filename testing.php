<html>
    <head>     <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
    <body>
<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a href="#events" data-toggle="tab">الفعاليات</a></li>
    <li><a href="#volunteer" data-toggle="tab">المتطوعون لدى الجمعية</a></li>
    <li><a href="#event_volunteers" data-toggle="tab">المتطوعون بالفعالية</a></li>
    <li><a href="#black_list" data-toggle="tab">القائمة السوداء</a></li>
</ul>



<div class="tab-content">
    <div class="tab-pane active" id="events">  <?php include("admin_events_tab.php"); ?></div>
    <div class="tab-pane" id="volunteer">    <?php include("admin_volunteer_tab.php"); ?></div>
    <div class="tab-pane" id="event_volunteers">    <?php include("admin_volunteers_at_events_tab.php"); ?></div>
    <div class="tab-pane" id="black_list"><?php include("admin_blacklist_tab.php"); ?> </div>
</div>

  </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });

// Acá guarda el index al cual corresponde la tab. Lo podés ver en el dev tool de chrome.
    var activeTab = localStorage.getItem('activeTab');

// En la consola te va a mostrar la pestaña donde hiciste el último click y lo
// guarda en "activeTab". Te dejo el console para que lo veas. Y cuando refresques
// el browser, va a quedar activa la última donde hiciste el click.
    console.log(activeTab);

    if (activeTab) {
        $('a[href="' + activeTab + '"]').tab('show');
    }
</script>