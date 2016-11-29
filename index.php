<?php
include 'config/database.php';

use Src\Search;
use Src\Pagination;

$proprieties = (new Search)->getProperties($_REQUEST);

?>


<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(function() {
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
            });
        });
    </script>
    <style>
        .container .jumbotron, .container-fluid .jumbotron {
            padding-right: 60px;
            padding-left: 60px;
        }
        .jumbotron, .container-fluid .jumbotron {
            padding-right: 60px;
            padding-left: 60px;
        }
        .jumbotron {
            padding-top: 10px;
            padding-bottom: 3px;
            margin-bottom: 30px;
            color: inherit;
            background-color: #eee;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <form name="search" method="GET">
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" class="form-control"
                       placeholder="Location"
                       value="<?php echo $_GET['location'] ?>">
            </div>
            <div class="checkbox">
                <label>
                    <input <?php echo isset($_GET['near_beach'])? 'checked':null ?>
                        type="checkbox" name="near_beach">
                    Near the beach
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input  <?php echo isset($_GET['accepet_pets'])? 'checked':null ?>
                        type="checkbox" name="accepet_pets">
                    Accepts Pets
                </label>
            </div>
            <div class="form-group">
                <label>Sleeps</label>
                <input type="number" class="form-control" name="sleeps"
                       placeholder="Sleeps"
                       value="<?php echo $_GET['sleeps'] ?>">
            </div>
            <div class="form-group">
                <label>Beds</label>
                <input type="number" class="form-control" name="beds"
                       placeholder="Beds"
                       value="<?php echo $_GET['beds'] ?>">
            </div>
            <label>Availability</label>
            <div class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control datepicker"
                           name="start" placeholder="start"
                           value="<?php echo $_GET['start'] ?>">
                    <div class="form-group">
                        <input type="text" class="form-control datepicker"
                               name="end" placeholder="end"
                               value="<?php echo $_GET['end'] ?>">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-default"> Search</button>
        </form>
    </div>

    <?php foreach ($proprieties as $value) : ?>
        <div class="media">
            <div class="media-left">
                <a href="#">
                    <img alt="64x64" class="media-object" data-src="holder.js/64x64"
                         src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNThiMDBjMDRkYyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1OGIwMGMwNGRjIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy4wNDY4NzUiIHk9IjM2LjUiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+" data-holder-rendered="true" style="width: 64px; height: 64px;"> </a>
            </div>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $value->property_name ?></h4>
                <?php echo '<b>Location:</b>'.$value->location->location_name ?>
                <?php echo '<b>Near the beach:</b>'. ($value->near_beach == 1? 'Yes':'No') ?>
                <?php echo '<b>Accepts Petss:</b>'.($value->accepet_pets == 1? 'Yes':'No') ?>
                <?php echo '<b>Sleeps:</b>'.$value->sleeps ?>
                <?php echo '<b>Beds:</b>'.$value->beds ?>
            </div> </div>
    <?php endforeach; ?>

    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $proprieties->lastPage(); $i++) : ?>
                <li class="<?php echo (($proprieties->currentPage() == $i) ? 'active': ''); ?>">
                    <a href="<?php echo Pagination::getUrlPage().'&page='.$i?>"> <?php echo $i ?></a>
                </li>
            <?php  endfor;  ?>
        </ul>
    </nav>

</div>
</body>
</html>






