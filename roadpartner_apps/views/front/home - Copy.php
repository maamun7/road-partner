<label class="error"><?php //if (isset($error_warning)){ echo $error_warning; } ?></label>
<form id="bidfrm" action="{action}" method="post">
    <div class="row">
        <div class="col-sm-4 form-group">
            <label for="pickup">1. Type of Vehicle:</label>
            <select class="form-control" id="carType" name="optradio" required></select>
            <label class="error"><?php if (isset($error_optradio)){ echo $error_optradio; } ?></label>
        </div>
        <div class="col-sm-4 form-group">
            <label for="car">2. Type of Car:</label>
            <select class="form-control" id="car" name="car" required>
                <option value="" selected>Select Car Type</option>
            </select>
            <label class="error"><?php if (isset($error_car)){ echo $error_car; } ?></label>
        </div>
        <div class="col-sm-4 form-group">
            <label for="journey">3. Journey:</label>
            <select class="form-control" id="journey" name="journey" required>
                <option value="1" selected> One Side</option>
                <option value="2">Two Way</option>
            </select>
            <label class="error"><?php if (isset($error_journey)){ echo $error_journey; } ?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="pickup">4. Pickup:</label>
            <input type="text" class="form-control" onfocus="this.placeholder = ''"
                   onblur="this.placeholder = '103 Upper Mall Road, Lahore'" id="txtSource"
                   placeholder="103 Upper Mall Road, Lahore" name="pickup" required>
            <label class="error"><?php if (isset($error_pickup)){ echo $error_pickup; } ?></label>
        </div>
        <div class="col-sm-6 form-group">
            <label for="car">5. Drop:</label>
            <input type="text" class="form-control" id="txtDestination" onfocus="this.placeholder = ''"
                   onblur="this.placeholder = '108 Kashmir Block, Lahore'" placeholder="108 Kashmir Block, Lahore"
                   name="drop" required>
            <label class="error"><?php if (isset($error_drop)){ echo $error_drop; } ?></label>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="Date">6. Date:</label>
            <input type="text" class="form-control optdate" name="date" placeholder="like 2016-03-26"
                   id="datetimepicker" required>
            <label class="error"><?php if (isset($error_date)){ echo $error_date; } ?></label>
        </div>
        <div class="col-sm-6 form-group">
            <label for="Name">7. Name:</label>
            <input type="text" class="form-control" name="name" id="name" required>
            <label class="error"><?php if (isset($error_name)){ echo $error_name; } ?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group">
            <label for="Cell No.">8. Cell No.:</label>
            <input type="text" class="form-control" name="cell" id="cell" required>
            <label class="error"><?php if (isset($error_cell)){ echo $error_cell; } ?></label>
        </div>
        <div class="col-sm-6 form-group">
            <label for="Timer">9. Timer (In Minute):</label>
            <!--<input type="text" onKeyPress="return numbersonly(this, event)" class="form-control" name="timer" id="timer" required>-->
            <select class="form-control" id="timer" name="timer" required>
                <option value="" selected>Select Bidding Timer</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
            </select>
            <label class="error"><?php if (isset($error_timer)){ echo $error_timer; } ?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group"><label for="Total KM">10. Total KM :</label>

            <input type="text" id="distance" class="form-control" name="distance" placeholder="Get the Distance"
                   readonly>
            <label class="error"><?php if (isset($error_distance)){ echo $error_distance; } ?></label>

        </div>
        <div class="col-sm-6 form-group">
            <label for="Cost">11. Cost :</label>
            <input type="text" class="form-control" name="cost" id="cost" required>
            <label class="error"><?php if (isset($error_cost)){ echo $error_cost; } ?></label>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 form-group"></div>
        <div class="col-sm-6 form-group">
            <input type="submit" class="btn btn-success" value="Start Bidding">
            <input type="hidden" id="distancehd" class="form-control" name="distancehd" required>
            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>" >
        </div>
    </div>
</form>
